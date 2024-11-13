<?php

namespace App\Http\Controllers;

use App\Models\SavingAccount;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if (in_array($user->role, ['staff', 'admin'])) {
            return $this->dashboardForStaffOrAdmin();
        }

        if ($user->role === 'student') {
            return $this->dashboardForStudent($user->id);
        }

        return view('home');
    }

    private function dashboardForStaffOrAdmin()
    {
        $totals = [
            'totalStaff' => User::where('role', 'staff')->count(),
            'totalStudent' => Student::count(),
            'totalBalance' => SavingAccount::sum('balance'),
            'totalTransaction' => Transaction::count(),
        ];

        $transactions = Transaction::with('savingAccount.student', 'staff')
            ->latest()
            ->limit(5)
            ->get();

        return view('home', array_merge($totals, ['transactions' => $transactions]));
    }

    private function dashboardForStudent($userId)
    {
        $student = Student::where('user_id', $userId)->firstOrFail();

        $totalBalance = SavingAccount::where('student_id', $student->id)->sum('balance');

        $transactions = Transaction::whereHas(
            'savingAccount',
            fn($query) =>
            $query->where('student_id', $student->id)
        )->with('staff')
            ->latest()
            ->limit(5)
            ->get();

        $totalTransaction = Transaction::whereHas(
            'savingAccount',
            fn($query) =>
            $query->where('student_id', $student->id)
        )->count();

        return view('home', compact('totalBalance', 'transactions', 'totalTransaction'));
    }
}

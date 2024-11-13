<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::query()->with('savingAccount.student', 'staff');

        if ($request->filled('start_date')) {
            $transactions->where('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $transactions->where('date', '<=', $request->end_date);
        }

        if ($request->filled('type')) {
            $transactions->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $transactions->whereHas('savingAccount', function ($query) use ($request) {
                $query->whereHas('student', function ($query) use ($request) {
                    $query->where('account_number', 'like', "{$request->search}%");
                });
            });
        }

        $transactions = $transactions->get();

        return view('pages.reports.index', compact('transactions'));
    }
}

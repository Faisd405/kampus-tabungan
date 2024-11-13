<?php

namespace App\Http\Controllers;

use App\Models\SavingAccount;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class SavingAccountController extends Controller
{
    public function index()
    {
        $data['saving_accounts'] = SavingAccount::all();

        return view('pages.saving_accounts.index', compact('data'));
    }

    public function create()
    {
        $data['students'] = Student::query()
            ->select('id', 'name')
            ->get();

        return view('pages.saving_accounts.form', compact('data'));
    }

    public function store(Request $request)
    {
        $inputData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'account_number' => 'required|unique:saving_accounts',
            'balance' => 'required',
        ]);

        SavingAccount::create($inputData);

        return redirect()->route('saving-account.index');
    }

    public function show(SavingAccount $savingAccount)
    {
        $savingAccount = $savingAccount->load('transactions');

        return view('pages.saving_accounts.show', [
            'savingAccount' => $savingAccount,
        ]);
    }

    public function edit(SavingAccount $savingAccount)
    {
        $data['savingaccount'] = $savingAccount;
        $data['students'] = Student::query()
            ->select('id', 'name')
            ->get();

        return view('pages.saving_accounts.form', [
            'savingaccount' => $savingAccount,
            'data' => $data
        ]);
    }

    public function update(Request $request, SavingAccount $savingAccount)
    {
        $inputData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'account_number' => 'required|unique:saving_accounts',
            'balance' => 'required',
        ]);

        $savingAccount->update($inputData);

        return redirect()->route('savingaccounts.index');
    }

    public function destroy(SavingAccount $savingAccount)
    {
        $savingAccount->delete();

        return redirect()->route('savingaccounts.index');
    }
}

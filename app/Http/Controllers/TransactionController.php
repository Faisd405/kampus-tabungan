<?php

namespace App\Http\Controllers;

use App\Models\SavingAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request, SavingAccount $savingAccount)
    {
        $inputData = $this->validateTransaction($request);

        if ($this->isInvalidTransaction($inputData, $savingAccount)) {
            return response()->json(['message' => 'Invalid transaction'], 422);
        }

        $savingAccount->transactions()->create($inputData);
        $savingAccount->recalculateBalance();

        return response()->json(['message' => 'Transaction created successfully']);
    }

    public function update(Request $request, SavingAccount $savingAccount, Transaction $transaction)
    {
        $inputData = $this->validateTransaction($request);

        if ($this->isInvalidTransaction($inputData, $savingAccount)) {
            return response()->json(['message' => 'Invalid transaction'], 422);
        }

        $transaction->update($inputData);
        $savingAccount->recalculateBalance();

        return response()->json(['message' => 'Transaction updated successfully']);
    }

    public function destroy(SavingAccount $savingAccount, Transaction $transaction)
    {
        $transaction->delete();
        $savingAccount->recalculateBalance();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }

    private function validateTransaction(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:deposit,withdraw',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]) + ['staff_id' => auth()->user()->id];
    }

    private function isInvalidTransaction(array $inputData, SavingAccount $savingAccount): bool
    {
        return ($inputData['amount'] <= 0) ||
            ($inputData['type'] === 'withdraw' && $savingAccount->balance < $inputData['amount']);
    }
}

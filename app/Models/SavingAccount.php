<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingAccount extends Model
{
    protected $fillable = [
        'student_id',
        'account_number',
        'balance',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function recalculateBalance()
    {
        $totalDeposits = $this->transactions()->where('type', 'deposit')->sum('amount');
        $totalWithdraws = $this->transactions()->where('type', 'withdraw')->sum('amount');

        $this->update(['balance' => $totalDeposits - $totalWithdraws]);
    }
}

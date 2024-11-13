<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'staff_id',
        'type',
        'amount',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function savingAccount()
    {
        return $this->belongsTo(SavingAccount::class, 'account_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class);
    }
}

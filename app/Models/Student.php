<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'name',
        'class_name',
        'date_of_birth',
        'address',
        'parent_name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savingAccount()
    {
        return $this->hasOne(SavingAccount::class);
    }
}

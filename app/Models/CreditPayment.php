<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CreditPayment extends Model
{
    protected $fillable = [
        'credit_number',
        'monthly_installment',
    ];

    public function credit(): HasOne
    {
        return $this->hasOne(Credit::class, 'credit_number', 'credit_number');
    }
}

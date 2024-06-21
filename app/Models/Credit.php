<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Credit extends Model
{
    protected $fillable = [
        'credit_number',
        'user_id',
        'amount',
        'term',
        'created_at',
        'updated_at',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->credit_number = Credit::max('credit_number') + 1;
        });
    }
}

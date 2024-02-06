<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactions_id',
        'review',
        'rating',
    ];

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}
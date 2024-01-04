<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasCompositeKey, HasFactory;

    protected $primaryKey = [
        'voucher_category_id',
        'user_id',
    ];

    protected $fillable = [
        'voucher_category_id',
        'user_id',
        'qty'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher_category()
    {
        return $this->belongsTo(VoucherCategory::class);
    }
}

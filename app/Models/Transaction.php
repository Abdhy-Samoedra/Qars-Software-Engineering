<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'total_days',
        'extend',
        'penalty',
        'exp_reward',
        'status',
        'payment_method',
        'payment_status',
        'payment_url',
        'total_price',
        'vehicle_id',
        'user_id',
        'driver_id',
        'voucher_category_id',
    ];

    protected $cast = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function voucher_category()
    {
        return $this->belongsTo(VoucherCategory::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class,'id');
    }
}

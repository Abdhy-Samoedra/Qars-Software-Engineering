<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_name',
        'voucher_nominal',
        'voucher_price',
        'expired_date',
        'minimum_spending',
        'voucher_picture',
        'slug',
    ];

    // mendapatkan foto pertama untuk thumbnail
    public function getThumbnailAttribute()
    {
        if ($this->voucher_picture) {
            return Storage::url(json_decode($this->voucher_picture));
        }

        return 'https://via.placeholder.com/800x600';
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
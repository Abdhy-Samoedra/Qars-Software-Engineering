<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_category_name',
        'vehicle_category_capacity',
        'vehicle_category_description',
        'vehicle_category_picture',
        'slug',
    ];

    // mendapatkan foto pertama untuk thumbnail
    public function getThumbnailAttribute()
    {
        if ($this->vehicle_category_picture) {
            return Storage::url(json_decode($this->vehicle_category_picture));
        }

        return 'https://via.placeholder.com/800x600';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'license_plate';
    public $incrementing = false;

    protected $fillable = [
        'license_plate',
        'vehicle_category_id',
        'color',
        'merk',
        'type',
        'year_of_release',
        'fuel',
        'rental_price',
        'car_description',
        'status',
        'car_picture',
        'slug',
    ];

    protected $casts = [
        'car_picture' => 'array'
    ];

    // mendapatkan foto pertama untuk thumbnail
    public function getThumbnailAttribute()
    {
        if ($this->car_picture) {
            return Storage::url(json_decode($this->car_picture)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function vehicleCategories(){
        return $this->belongsTo(VehicleCategory::class);
    }

    public function lostAndFounds(){
        return $this->hasMany(LostAndFound::class);
    }

    // public function transactions(){
    //     return $this->hasMany(Transaction::class);
    // }

}

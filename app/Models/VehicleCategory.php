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
        'slug',
    ];

        public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}

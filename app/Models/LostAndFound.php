<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LostAndFound extends Model
{
    use HasFactory;

    protected $fillable = [
        'found_date',
        'taken_status',
        'taken_date',
        'lost_and_found_picture',
        'description',
        'slug',
        'vehicle_id',
    ];

    // mendapatkan foto pertama untuk thumbnail-
    public function getThumbnailAttribute()
    {
        if ($this->lost_and_found_picture) {
            return Storage::url(json_decode($this->lost_and_found_picture));
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function vehicles(){
        return $this->belongsTo(Vehicle::class);
    }
}

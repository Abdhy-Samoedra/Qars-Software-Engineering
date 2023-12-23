<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'picture',
        'age',
        'slug',
    ];



    // mendapatkan foto pertama untuk thumbnail
    public function getThumbnailAttribute()
    {
        if ($this->picture) {
            return Storage::url(json_decode($this->picture));
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
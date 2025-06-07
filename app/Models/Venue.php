<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'type',
        'deskripsi',
        'harga',
        'portofolio_link',
        'image1',
        'image2',
        'image3',
        'is_active',
    ];

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
}
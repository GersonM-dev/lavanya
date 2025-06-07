<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'venue_id',
        'deskripsi',
        'harga',
        'portofolio_link',
        'image1',
        'image2',
        'image3',
        'is_active',
        'is_mandatory',
        'vendor_category_id',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function category()
    {
        return $this->belongsTo(VendorCategory::class, 'vendor_category_id');
    }
}
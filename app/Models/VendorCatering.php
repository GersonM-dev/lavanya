<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorCatering extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'venue_id',
        'type',
        'deskripsi',
        'portofolio_link',
        'image1',
        'image2',
        'image3',
        'is_active',
        'buffet_price',
        'gubugan_price',
        'dessert_price',
        'base_price',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function weddingTransactions()
    {
        return $this->hasMany(WeddingTransaction::class, 'vendor_catering_id');
    }

    protected $casts = [
        'venue_id' => 'array',
    ];
}

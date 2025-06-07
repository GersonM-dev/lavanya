<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
}
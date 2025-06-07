<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'grooms_name',
        'brides_name',
        'guest_count',
        'wedding_date',
        'refferal_code',
        'phone_number',
    ];
}
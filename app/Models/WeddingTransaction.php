<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingTransaction extends Model
{
    protected $fillable = [
        'customer_id',
        'venue_id',
        'transaction_date',
        'total_estimated_price',
        'status',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function vendors()
    {
        return $this->hasMany(WeddingTransactionVendor::class, 'transaction_id');
    }

}

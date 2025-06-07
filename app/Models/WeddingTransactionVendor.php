<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingTransactionVendor extends Model
{
    protected $fillable = [
        'id',
        'transaction_id',
        'vendor_id',
        'estimated_price',
        'is_mandatory',
        'notes',
    ];

    public function transaction()
    {
        return $this->belongsTo(WeddingTransaction::class, 'transaction_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}

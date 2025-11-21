<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'type',
        'transaction_code',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

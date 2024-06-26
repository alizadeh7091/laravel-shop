<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{
    use HasFactory;
    protected $fillable=
        [
            'cart_id',
            'product_id',
            'price',
            'quantity',
            'amount',
        ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

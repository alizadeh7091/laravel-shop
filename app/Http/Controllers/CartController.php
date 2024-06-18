<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {
        $userId = 1;
        $cart = Cart::query()->where('user_id', $userId)->first();
        if (!$cart) {
            $cart = Cart::query()->create(
                [
                    'user_id' => 1,
                    'discount' => 5,
                    'total_invoice' => null,
                ]
            );
        }
        $cart_detail = new Cart_detailController();
        $cart_detail->createCart_details($request, $id, $cart);
        return redirect()->back();
    }
}

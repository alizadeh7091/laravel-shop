<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {
        $userId = getUserId();
            $cart = Cart::query()->where('user_id', $userId)->first();
            if (!$cart) {
                $cart = Cart::query()->create(
                    [
                        'user_id' => $userId,
                        'discount' => 0,
                        'total_invoice' => null,
                        'total_invoice_discounted' => null,
                    ]
                );
            }
            $cart_detail = new Cart_detailController();
            $cart_detail->createCart_details($request, $id, $cart);
            return redirect()->back();
        }
//    }
}

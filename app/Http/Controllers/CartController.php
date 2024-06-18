<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use mysql_xdevapi\Session;

class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
//        dd($userId);
            $cart = Cart::query()->where('user_id', $userId)->first();
            if (!$cart) {
                $cart = Cart::query()->create(
                    [
                        'user_id' => $userId,
                        'discount' => 5,
                        'total_invoice' => null,
                    ]
                );
            }
            $cart_detail = new Cart_detailController();
            $cart_detail->createCart_details($request, $id, $cart);
            return redirect()->back();
        } else {
            $product = Product::findOrFail($id);
//            dd($product);
            $product_id = $product->id;

        }

    }
}

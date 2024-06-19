<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {
        if (Auth::check()) {
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
        } else {
            $products = Product::query()->findOrFail($id);
//            Cookie::queue(Cookie::forget('newCart'));
//
//            return redirect()->back();
            $cartItems = json_decode(Cookie::get('newCart', '[]'), true);
            $found = false;
            foreach ($cartItems as $_cartItem) {
                if ($_cartItem['product_id'] == $products->id) {
                    $_cartItem['quantity'] += $request['quantity'];
                    $found = true;
                }
                break;
            }
            if (!$found) {
                $cartItems[] =
                    [
                        'product_id' => $products->id,
                        'price' => $products->price,
                        'quantity' => $request['quantity'],
                        'amount' => ($products->price) * ($request['quantity']),
                    ];
            }
            $cartJson = json_encode($cartItems);
            $cookie = Cookie::make('newCart', $cartJson, 60);
//            dd($cookie);
            return redirect()->back()->withCookie($cookie);
        }
    }
//    }
}

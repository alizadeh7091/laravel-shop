<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Cart_detailController extends Controller
{
    public function createCart_details($request, $id, $cart)
    {
        $validated = $request->validate(
            [
                'quantity' => 'required|min:1,max:3'
            ]
        );
        $product = Product::query()->findOrFail($id);
//        dd($product);
        Cart_detail::query()->create(
            [
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->input('quantity'),
                'amount' => ($product->price * $request->input('quantity'))
            ]
        );
    }

    public function allCartItems()
    {
        if (Auth::check()) {
            $user_id = getUserId();
            $cart = Cart::where('user_id', $user_id)->first();
            $cart_items = Cart_detail::where('cart_id', $cart->id)->get();
            $total_price_sum = 0;
            foreach ($cart_items as $cart_item) {
                $total_price_sum += $cart_item->amount;
            }
//        dd($total_price_sum);
            return view('cart.all')->with(
                [
                    'cart_items' => $cart_items,
                    'total_price_sum' => $total_price_sum,
                ]
            );
        } else {
            $cart = Cookie::get('newCart');
//            dd($_COOKIE);
            $cart_items = json_decode($cart);
//            dd($cart_items[0]);
            $total_price_sum = 0;
//            $cart_items['amount'];
            foreach ($cart_items as $_cart_item){
                $total_price_sum += $_cart_item->amount;
            }
            return view('cart.all')->with(
                [
                    'cart_items' => $cart_items,
                    'total_price_sum' => $total_price_sum,
                ]
            );
        }

    }

    public function deleteCartItem(Request $request)
    {
//        dd($request);
        $id = $request->input('id');
        $cart_detail_item = Cart_detail::findOrFail($id);
//        dd($cart_detail_item);
        $cart_detail_item->delete();
        return redirect()->back();
    }
}

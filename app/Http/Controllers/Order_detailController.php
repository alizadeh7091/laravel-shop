<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers;

class Order_detailController extends Controller
{
    public function addOrder_details($id){

        $user_id = getUserId();
        $cart = Cart::where('user_id',$user_id)->first();
        $cart_details = Cart_detail::where('cart_id',$cart->id)->get();
        foreach ($cart_details as $_cart_detail){
            Order_detail::create(
                [
                    'order_id' => $id,
                    'product_id' => $_cart_detail->product_id,
                    'price'=> $_cart_detail->price,
                    'quantity' => $_cart_detail->quantity,
                    'amount' => $_cart_detail->amount,
                ]
            );
        }

    }
}

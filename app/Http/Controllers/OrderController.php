<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addOrder()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::query()->where('user_id', $user_id)->first();
        $total_invoice = $cart->total_invoice;
        $total_invoice_discounted = $cart->total_invoice_discounted;
//        $total_invoice_discounted = $cart->to
//        dd($total_invoice);
//        $order = Order::where('user_id', $user_id)->first();
//        if (!$order) {
        $order = Order::create(
            [
                'user_id' => $user_id,
                'total_invoice' => $total_invoice,
                'total_invoice_discounted' => $total_invoice_discounted,
                'payment' => null,
            ]
        );
//        }
//        dd($order);
//        $order = Order::where('user_id', $user_id)->first();
        $order_detailController = new Order_detailController();
        $order_detailController->addOrder_details($order->id);
        $cart = Cart::where('user_id', $order->user_id)->first();
        $cart_details = Cart_detail::where('cart_id', $cart->id)->get();
        foreach ($cart_details as $_cart_detail) {
            $_cart_detail->delete();
        }
        $cart->delete();
    }
}

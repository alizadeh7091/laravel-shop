<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        $validated = $request->validate([
            'discount_code' => 'required|string|max:255',
        ]);
        $user_id = getUserId();
        $cart = Cart::where('user_id', $user_id)->first();
        $discount_code = $request['discount_code'];
        $discount = Discount::query()->where('code', $discount_code)->first();
//        dd($discount);
        $discount_amount = $discount->discount_amount;
//        return $discount_amount;
        $cart_items = Cart_detail::where('cart_id', $cart->id)->get();
        $total_price_sum = 0;
        foreach ($cart_items as $cart_item) {
            $total_price_sum += $cart_item->amount;
        }
        $total_invoice_discounted = $total_price_sum - ($total_price_sum * ($discount_amount / 100));
//        return $total_invoice;
        $attr =
            [
                'discount' => $discount_amount,
                'total_invoice' => $total_price_sum,
                'total_invoice_discounted' => $total_invoice_discounted
            ];
        $cart->update($attr);
        return response()->json
        ([
            'message' => 'discount code submitted successfully',
            'data' => $validated,
            'total_with_discount' => $total_invoice_discounted
        ]);
    }
}

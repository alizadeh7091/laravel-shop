<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function applyDiscount(Request $request)
    {
        $validated = $request->validate([
            'discount_code' => 'required|string|max:255',
        ]);
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id',$user_id);
        $discount_code = $request->input('discount_code');
        $attr = ['discount'=>$discount_code];
        $cart->update($attr);
        return response()->json(['message' => 'Form submitted successfully', 'data' => $validated]);
    }

}

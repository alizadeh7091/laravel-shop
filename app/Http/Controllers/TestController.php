<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

class TestController extends Controller
{
    public function setCookie($name,$value){
        $cookie = Cookie::make($name,$value,60);
        return response('cookie set')->cookie($cookie);
    }
    public function getCookie($name){
        $value = Cookie::get($name);
        return response($value);
    }
    public function deleteCookie($name){
        $cookie = Cookie::forget($name);
        return response('cookie deleted')->withCookie($name);
    }
}

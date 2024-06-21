<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;


class TestController extends Controller
{
    public function setCookie($name, $value)
    {
        $cookie = Cookie::make($name, $value, 60);
        return response('cookie set')->cookie($cookie);
    }

    public function getCookie($name)
    {
        $value = Cookie::get($name);
        return response($value);
    }

    public function deleteCookie($name)
    {
        $cookie = Cookie::forget($name);
        return response('cookie deleted')->withCookie($name);
    }

    public function testLog(Post $post)
    {
//        try {
//            $post = (Post::query()->where('id', 5000000))->first();
            dd($post);

//        } catch (ModelNotFoundException $ex) {
////            dd($ex);
////            abort(404);
//        };


//        Log::info('massage');
//        echo $name;
//        return view('welcome');
    }
}

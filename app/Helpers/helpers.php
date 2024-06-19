<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

function getUserId()
{
    if (Auth::check()) {
        return Auth::user()->id;
    }
    else {
        return Redirect::route('login')->send();
    }
}

function testHelper(){
    return 'test helpers';
}

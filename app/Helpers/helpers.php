<?php

use Illuminate\Support\Facades\Auth;

function getUserId()
{
    return Auth::user()->id;
}


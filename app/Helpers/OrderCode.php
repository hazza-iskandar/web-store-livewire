<?php

use Illuminate\Support\Str;

if(!function_exists('makeOrderCode')){
    function makeOrderCode(){
        return 'ORD-'  . strtoupper(Str::random(6)) . '-' . rand(10, 999999);
    }
}

if(!function_exists('makeGroupOrderCode')){
    function makeGroupOrderCode(){
        return 'GRP-'  . strtoupper(Str::random(6)) . '-' . rand(10, 999999);
    }
}
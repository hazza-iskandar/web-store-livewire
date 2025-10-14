<?php

if (!function_exists('thumbnailCond')) {
    function thumbnailCond($thumbnail){
        return !empty($thumbnail)
            ? asset("storage/" . $thumbnail)
            : asset('assets/images/images404.png');
    }
}

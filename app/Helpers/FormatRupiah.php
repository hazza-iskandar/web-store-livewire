<?php

if(!function_exists('formatRupiah')){
    function formatRupiah($angka){
        return '<span class="text-[16px]">Rp. </span>' . number_format($angka, 0, ',', '.');
    }
}
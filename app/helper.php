<?php

use App\Models\Shop;

function shop(){
    return Shop::with('pages')->find(session('shop_id'));
}

function shops($limit = 10){
    return Shop::limit($limit)->get();
}

function makeid($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function get_date($date = null, $format = 'M d, Y'){
    try{
        $Date = new \DateTime($date);
    }
    catch(\Exception $e){
        $Date = new \DateTime(null);
    }
    return $Date->format($format);
}
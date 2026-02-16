<?php
$text = 'This is sample Text';
function truncate($text, $length = 10){
    if (strlen($text) <= $length){
        return $text;
    } 
    else {
        return substr($text,0,10);
    }
}

function formatPrice($amount){
    return number_format($amount, 2);
}

function getCurrentYear(){
    return date('Y');
}

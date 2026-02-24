<?php
function formatPhoneNumber($number){
    return "(" . substr($number, 0, 3) . ") ". substr($number, 3 ,3). " " . substr($number, 6) . '<br/>';
}
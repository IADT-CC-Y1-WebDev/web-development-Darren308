<?php
function isValidEmail($email){
    if (str_contains($email, '@')){
        return $email;
    } else {
        echo "Invalid email";
    }
}
<?php

class Student{
    public $name;
    public $number;

    public function __construct($name, $num) {
        $this->name = $name;
        $this->number = $num;
    }
    public function getName(){
        return $this->name;
    }

    public function getNumber(){
        return $this->number;
    }
}


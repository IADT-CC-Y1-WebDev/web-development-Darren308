<?php

class Student{
    protected $name;
    protected $number;

    public function __construct($name, $num) {
        if (!empty($name)) {
            echo "Creating student: $name;<br>";
            $this->name = $name;
        }
        else {
            throw new Exception("Student name cannot be empty");
        }
        $this->name = $name;
        if (empty($num)) {
            throw new Exception("Student number cannot be empty");
        }
        else {
            $this->number = $num;
        }
    }

    public function getName(){
        return $this->name;
    }

    public function getNumber(){
        return $this->number;
    }

    public function __toString() {
        return "Student: {$this->name} ({$this->number})";
    }

    public function __destruct() {
        echo "Destroying student: {$this->name};<br>";
    }
}
<?php
require_once __DIR__ . '/Student.php';

class Undergrad extends Student {
    protected $course;
    protected $year;
    public function __construct($name, $num, $course, $year) {
        parent::__construct($name, $num);
        $this->course = $course;
        $this->year = $year;
    }

    public function tostring() {
        return "Undergrad: {$this->name} ({$this->number}), Course: {$this->course}, Year: {$this->year}";
    }
}
<?php
    class Product {
        private static $products = [];
        public static function findAll() {
            return self::$products;
        }
        public static function findById($id) {
            if (array_key_exists($id, self::$products)) {
                return self::$products[$id];
            }
            return null;
        }
        public $id;
        public $name;
        public $price;
        public $description;
        
        public function __construct($id, $name, $price, $description = '') {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->description = $description;
            self::$products[$id] = $this;
        }
    }
?>
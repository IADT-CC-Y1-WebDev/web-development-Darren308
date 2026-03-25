<?php
    class ShoppingCartItem {
        public $productId;
        public $name;
        public $price;
        public $quantity;

        public function __construct($productId, $name, $price, $quantity = 1) {
            $this->productId = $productId;
            $this->name = $name;
            $this->price = $price;
            $this->quantity = $quantity;
        }

        public function getSubtotal() {
            return $this->price * $this->quantity;
        }
    }
?>
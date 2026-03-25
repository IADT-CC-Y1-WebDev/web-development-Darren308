<?php
class ShoppingCart {
    private const SESSION_KEY = 'cart';
    private $items = [];

    public static function getInstance() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = new ShoppingCart();
        }
        return $_SESSION[self::SESSION_KEY];
    }
    public function getItems() {
        return $this->items;
    }
    public function add(Product $product) {
        if (isset($this->items[$product->id])) {
            $this->items[$product->id]->quantity++;
        } else {
            $this->items[$product->id] = 
                new ShoppingCartItem($product->id, $product->name, $product->price, 1);
        }
    }

    public function remove($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        }
    }

    public function updateQuantity($productId, $quantity) {
        if (isset($this->items[$productId])) {
            if ($quantity > 0) {
                $this->items[$productId]->quantity = $quantity;
            } else {
                $this->remove($productId);
            }
        }
    }

    public function clear() {
        $this->items = [];
    }

    public function isEmpty() {
        return empty($this->items);
    }

    public function getCount() {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->quantity;
        }
        return $count;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }
        return $total;
    }
}
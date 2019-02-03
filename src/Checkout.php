<?php

declare(strict_types=1);

class Checkout {

    private $availableItems = [
        "wine" => 30,
        "soda" => 2,
        "tuna" => 5,
    ];

    private $customerName;

    private $cart = [];

    public function __construct($customerName) {
        $this->customerName = $customerName;
    }

    public function addItem($item, $qty = 1) : void {
        if (!isset($this->availableItems[$item])) {
            throw new InvalidArgumentException("Item not available");
        }

        if (!isset($this->cart[$item])) {
            $this->cart[$item] = 0;
        }

        $this->cart[$item] += $qty;
    }

    public function removeItem($item, $qty = 1) : void {
        if (!isset($this->cart[$item])) {
            throw new InvalidArgumentException("Item not bought");
        }

        $this->cart[$item] -= $qty;

        if ($this->cart[$item] <= 0) {
            unset($this->cart[$item]);
        }
    }

    public function doCheckout() : double {
        if (empty($cart)) {
            throw new Exception("Cart is empty");
        }

        $total = 0.0;
        foreach ($this->cart as $item => $qty) {
            $total += $this->availableItems[$item] * $qty;
        }

        return $total;
    }
}

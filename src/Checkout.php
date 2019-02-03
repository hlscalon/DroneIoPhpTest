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

    public function addItem($item, $quantity = 1) : void {
        if (!isset($this->availableItems[$item])) {
            throw new InvalidArgumentException("Item not available");
        }

        if (!isset($this->cart[$item])) {
            $this->cart[$item] = 0;
        }

        $this->cart[$item] += $quantity;
    }

    public function removeItem($item, $quantity = 1) : void {
        if (!isset($this->cart[$item])) {
            throw new InvalidArgumentException("Item not bought");
        }

        if ($this->cart[$item] - $quantity < 0) {
            throw new InvalidArgumentException("Wrong quantity to remove");
        }

        $this->cart[$item] -= $quantity;

        if ($this->cart[$item] <= 0) {
            unset($this->cart[$item]);
        }
    }

    public function getTotalToPay() : float {
        if (empty($this->cart)) {
            throw new Exception("Cart is empty");
        }

        $total = 0.0;
        foreach ($this->cart as $item => $quantity) {
            $total += $this->availableItems[$item] * $quantity;
        }

        return (float) $total;
    }
}

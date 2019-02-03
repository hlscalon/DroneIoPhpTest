<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase {

    protected $instance;

    public function setUp() : void {
        $this->instance = new Checkout("Henrique L. Scalon");
    }

    public function testCanBeCreatedWithoutName(): void {
        $this->expectException(ArgumentCountError::class);

        new Checkout();
    }

    public function testCanBeCreatedFromName(): void {
        new Checkout("Henrique L. Scalon");

        $this->addToAssertionCount(1);
    }

    public function testAddItemCartCorrectly() : void {
        $this->instance->addItem("tuna", 2);

        $this->addToAssertionCount(1);
    }

    public function testAddItemCartIncorrectly() : void {
        $this->expectException(InvalidArgumentException::class);

        $this->instance->addItem("fish oil", 2);
    }

    public function testRemoveItemCartCorrectly() : void {
        $this->instance->addItem("tuna", 2);
        $this->instance->removeItem("tuna", 2);

        $this->addToAssertionCount(1);
    }

    public function testRemoveItemCartMissingProduct() : void {
        $this->expectException(InvalidArgumentException::class);

        $this->instance->addItem("tuna", 2);
        $this->instance->removeItem("soda", 2);
    }

    public function testRemoveItemCartWrongQuantity() : void {
        $this->expectException(InvalidArgumentException::class);

        $this->instance->addItem("tuna", 2);
        $this->instance->removeItem("tuna", 3);
    }

    public function testGetTotalToPay() : void {
        $this->instance->addItem("tuna", 3);
        $this->instance->addItem("wine", 1);
        $this->instance->removeItem("tuna", 1);

        $total = $this->instance->getTotalToPay();

        $this->assertEquals($total, 40);
    }
}

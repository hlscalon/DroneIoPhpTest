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

}

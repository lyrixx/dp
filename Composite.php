<?php

interface HasPriceInterface
{
    public function getPrice(): int;
}

class Box implements HasPriceInterface
{
    private array $children;

    public function __construct(HasPriceInterface ...$children)
    {
        $this->children = $children;
    }

    public function getPrice(): int
    {
        $total = 0;

        foreach ($this->children as $child) {
            $total += $child->getPrice();
        }

        return $total;
    }
}

class Product implements HasPriceInterface
{
    public function __construct(
        private readonly int $price,
    ) {
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}

$box = new Box(
    new Box(
        new Box(
            new Product(12),
            new Product(12),
        ),
        new Product(12),
    ),
    new Box(),
    new Product(12),
    new Box(
        new Product(0),
    )
);

dump($box->getPrice());

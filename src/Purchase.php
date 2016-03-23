<?php

class Purchase
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var DateTimeImmutable
     */
    private $purchaseDate;

    /**
     * Purchase constructor.
     * @param Product $product
     * @param Price $price
     * @param DateTimeImmutable $purchaseDate
     */
    public function __construct(Product $product, Price $price, \DateTimeImmutable $purchaseDate)
    {
        $this->product = $product;
        $this->price = $price;
        $this->purchaseDate = $purchaseDate;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

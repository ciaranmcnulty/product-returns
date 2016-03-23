<?php

class ProductReturn
{
    /**
     * @var Receipt|null
     */
    private $receipt;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var DateTimeImmutable
     */
    private $returnDate;

    /**
     * @param Product $product
     * @param DateTimeImmutable $returnDate
     */
    public function __construct(Product $product, \DateTimeImmutable $returnDate)
    {
        $this->product = $product;
        $this->returnDate = $returnDate;
    }

    public function provideReceipt(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    public function cashRefund()
    {
        if (is_null($this->receipt)) {
            throw new RuntimeException('No receipt given. Ask PO how to handle');
        }

        return $this->receipt->getPurchasePrice();
    }
}

<?php

class Receipt
{
    /**
     * @var
     */
    private $sequenceNumber;
    /**
     * @var Purchase
     */
    private $purchase;

    private function __construct()
    {
    }

    public static function issue(Purchase $purchase, $sequenceNumber)
    {
        $receipt = new Receipt();

        $receipt->purchase = $purchase;
        $receipt->sequenceNumber = $sequenceNumber;

        return $receipt;
    }

    public function getPurchasePrice()
    {
        return $this->purchase->getPrice();
    }
}

<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Price;
use Product;
use Prophecy\Argument;
use Purchase;
use Receipt;

class ProductReturnSpec extends ObjectBehavior
{
    function let(Product $product, \DateTimeImmutable $returnDate)
    {
        $this->beConstructedWith($product, $returnDate);
    }

    function it_can_be_provided_a_receipt(Receipt $receipt)
    {
        $this->provideReceipt($receipt);
    }

    function it_can_be_refunded_as_cash()
    {
        $price = new Price('123.00');
        $purchase = new Purchase(Product::named('TV'), $price, new \DateTimeImmutable());
        $receipt = Receipt::issue($purchase, '123');
        $this->provideReceipt($receipt);

        $this->cashRefund()->shouldReturn($price);
    }
}

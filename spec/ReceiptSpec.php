<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Price;
use Prophecy\Argument;

class ReceiptSpec extends ObjectBehavior
{
    function let(\Purchase $purchase)
    {
        $purchase->getPrice()->willReturn(new Price('999.99'));
        $sequenceNumber = 200421445;
        $this->beConstructedThrough('issue', [$purchase, $sequenceNumber]);
        $this->shouldHaveType(\Receipt::class);
    }

    function it_has_a_purchase_price()
    {
        $this->getPurchasePrice()->shouldBeLike(new Price('999.99'));
    }
}

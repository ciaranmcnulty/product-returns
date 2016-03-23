<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PurchaseSpec extends ObjectBehavior
{
    function let(\Product $product, \Price $price, \DateTimeImmutable $purchaseDate)
    {
        $this->beConstructedWith($product, $price, $purchaseDate);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Purchase');
    }

    function it_can_get_the_price(\Price $price)
    {
        $this->getPrice()->shouldReturn($price);
    }
}

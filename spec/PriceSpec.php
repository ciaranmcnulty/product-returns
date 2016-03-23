<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('19.50');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Price');
    }
}

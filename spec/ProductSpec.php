<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedNamed('Microwave');
    }

    function it_is_instantiable()
    {
        $this->shouldHaveType(\Product::class);
    }
}

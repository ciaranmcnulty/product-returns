<?php

class Product
{
    private $name;

    private function __construct()
    {
    }

    public static function named($name)
    {
        $product = new Product();

        $product->name = $name;

        return $product;
    }
}

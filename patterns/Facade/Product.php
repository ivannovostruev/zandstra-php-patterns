<?php

namespace patterns\Facade;

class Product
{
    public function __construct(
        public int $id,
        public string $name
    ){}
}

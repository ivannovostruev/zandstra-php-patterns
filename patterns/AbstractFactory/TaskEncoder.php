<?php

namespace patterns\AbstractFactory;

abstract class TaskEncoder
{
    abstract public function encode(): string;
}

<?php

namespace patterns\AbstractFactory;

abstract class AppointmentEncoder
{
    abstract public function encode(): string;
}

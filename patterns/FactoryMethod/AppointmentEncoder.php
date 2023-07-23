<?php

namespace patterns\FactoryMethod;

/**
 * Кодировщик объектов типа "Appointment"
 */
abstract class AppointmentEncoder
{
    abstract public function encode(): string;
}

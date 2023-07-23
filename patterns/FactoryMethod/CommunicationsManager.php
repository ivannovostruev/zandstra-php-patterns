<?php

namespace patterns\FactoryMethod;

abstract class CommunicationsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getAppointmentEncoder(): AppointmentEncoder;
    abstract public function getFooterText(): string;
}

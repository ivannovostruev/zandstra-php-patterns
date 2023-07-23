<?php

namespace patterns\AbstractFactory;

abstract class CommunicationsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getAppointmentEncoder(): AppointmentEncoder;
    abstract public function getTaskEncoder(): TaskEncoder;
    abstract public function getContactEncoder(): ContactEncoder;
    abstract public function getFooterText(): string;
}

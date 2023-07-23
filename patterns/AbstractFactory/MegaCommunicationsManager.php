<?php

namespace patterns\AbstractFactory;

class MegaCommunicationsManager extends CommunicationsManager
{
    public function getHeaderText(): string
    {
        return 'MegaCalendar верхний колонтитул<br>';
    }

    public function getAppointmentEncoder(): AppointmentEncoder
    {
        return new MegaAppointmentEncoder();
    }

    public function getTaskEncoder(): TaskEncoder
    {
        return new MegaTaskEncoder();
    }

    public function getContactEncoder(): ContactEncoder
    {
        return new MegaContactEncoder();
    }

    public function getFooterText(): string
    {
        return 'MegaCalendar нижний колонтитул<br>';
    }
}

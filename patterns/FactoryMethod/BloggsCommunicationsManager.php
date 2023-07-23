<?php

namespace patterns\FactoryMethod;

class BloggsCommunicationsManager extends CommunicationsManager
{
    public function getHeaderText(): string
    {
        return 'BloggsCalendar верхний колонтитул<br>';
    }

    public function getAppointmentEncoder(): AppointmentEncoder
    {
        return new BloggsAppointmentEncoder();
    }

    public function getFooterText(): string
    {
        return 'BloggsCalendar нижний колонтитул<br>';
    }
}

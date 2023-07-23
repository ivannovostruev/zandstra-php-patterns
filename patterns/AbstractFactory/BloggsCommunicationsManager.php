<?php

namespace patterns\AbstractFactory;

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

    public function getTaskEncoder(): TaskEncoder
    {
        return new BloggsTaskEncoder();
    }

    public function getContactEncoder(): ContactEncoder
    {
        return new BloggsContactEncoder();
    }

    public function getFooterText(): string
    {
        return 'BloggsCalendar нижний колонтитул<br>';
    }
}

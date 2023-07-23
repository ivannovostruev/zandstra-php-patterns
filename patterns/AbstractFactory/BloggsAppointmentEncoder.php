<?php

namespace patterns\AbstractFactory;

class BloggsAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string
    {
        return 'Данные о встрече закодированы в формате BloggsCalendar<br>';
    }
}

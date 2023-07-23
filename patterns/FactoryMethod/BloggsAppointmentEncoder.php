<?php

namespace patterns\FactoryMethod;

class BloggsAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string
    {
        return 'Данные о встрече закодированы в формате BloggsCalendar<br>';
    }
}

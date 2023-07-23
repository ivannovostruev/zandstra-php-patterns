<?php

namespace patterns\FactoryMethod;

class MegaAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string
    {
        return 'Данные о встрече закодированы в формате MegaCalendar<br>';
    }
}

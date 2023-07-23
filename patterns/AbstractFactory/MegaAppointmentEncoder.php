<?php

namespace patterns\AbstractFactory;

class MegaAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string
    {
        return 'Данные о встрече закодированы в формате MegaCalendar<br>';
    }
}

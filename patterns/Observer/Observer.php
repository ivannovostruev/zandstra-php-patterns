<?php

namespace patterns\Observer;

interface Observer
{
    public function update(Observable $observable);
}

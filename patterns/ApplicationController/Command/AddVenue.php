<?php

namespace patterns\ApplicationController\Command;

use patterns\ApplicationController\Domain\Venue;
use patterns\ApplicationController\Request\Request;

class AddVenue extends Command
{
    public function doExecute(Request $request)
    {
        $name = $request->getProperty('vanue_name');
        if (is_null($name)) {
            $request->addFeedback('Имя не задано');
            return self::getStatuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venueObj = new Venue(null, $name);
            $request->setObject('venue', $venueObj);
            $request->addFeedback('"' . $name . '" добавлено в ' . $venueObj->getId());
            return self::getStatuses('CMD_OK');
        }
    }
}

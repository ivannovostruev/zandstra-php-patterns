<?php

namespace patterns\PageController;

use Exception;

class AddVenueController extends PageController
{
    public function process()
    {
        try {
            $request = $this->getRequest();
            $name = $request->getProperty('venue_name');
            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback('Выберите имя заведения');
                $this->forward('templates/add_venue.php');
            } else if (is_null($name)) {
                $request->addFeedback('Имя должно быть обязательно задано');
                $this->forward('templates/add_venue.php');
            }
            $venue = new Venue(null, $name);
            $this->forward('list_venues.php');
        } catch (Exception $e) {
            $this->forward('error.php');
        }
    }
}

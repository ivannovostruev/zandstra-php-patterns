<?php

namespace patterns\ApplicationController\Command;

use patterns\ApplicationController\Request\Request;

class DefaultCommand extends Command
{
    public function doExecute(Request $request)
    {
        $request->addFeedback('Добро пожаловать в ApplicationController!');
        include __DIR__ . '/../templates/main.php';
    }
}

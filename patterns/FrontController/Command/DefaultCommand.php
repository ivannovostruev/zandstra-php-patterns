<?php

namespace patterns\FrontController\Command;

use patterns\FrontController\Request\Request;

class DefaultCommand extends Command
{
    public function doExecute(Request $request): bool
    {
        $request->addFeedback('Добро пожаловать в FrontController!');
        include __DIR__ . '/../templates/main.php';
        return true;
    }
}

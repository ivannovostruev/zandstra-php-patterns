<?php

namespace patterns\Command\Commands;

use patterns\Command\Command;
use patterns\Command\CommandContext;

class LoginCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $accessManager = Registry::getAccessManager();
        $user = $context->get('user');
        $password = $context->get('password');
        $userObj = $accessManager->login($user, $password);
        if (is_null($userObj)) {
            $context->setError($accessManager->getError());
            return false;
        }
        $context->addParam('user', $userObj);
        return true;
    }
}

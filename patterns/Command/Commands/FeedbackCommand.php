<?php

namespace patterns\Command\Commands;

use patterns\Command\Command;
use patterns\Command\CommandContext;

class FeedbackCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $messageSystem = Registry::getMessageSystem();
        $email = $context->get('email');
        $message = $context->get('message');
        $topic = $context->get('topic');
        $result = $messageSystem->send($email, $message, $topic);
        if (!$result) {
            $context->setError($messageSystem->getError());
            return false;
        }
        return true;
    }
}

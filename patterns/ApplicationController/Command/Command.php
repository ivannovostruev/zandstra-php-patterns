<?php

namespace patterns\ApplicationController\Command;

use patterns\ApplicationController\AppException;
use patterns\ApplicationController\Request\Request;

abstract class Command
{
    private static array $statuses = [
        'CMD_DEFAULT'           => 0,
        'CMD_OK'                => 1,
        'CMD_ERROR'             => 2,
        'CMD_INSUFFICIENT_DATA' => 3,
    ];

    private int $status = 0;

    final public function __construct(){}

    public function execute(Request $request): bool
    {
        $this->status = $this->doExecute($request);
        $request->setCommand($this);
        return true;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public static function getStatuses(string $statusName): int
    {
        if (isset(self::$statuses[$statusName])) {
            return self::$statuses[$statusName];
        }
        throw new AppException('Неизвестный код состояния: ' . $statusName);
    }

    abstract public function doExecute(Request $request);
}

<?php

namespace patterns\ApplicationController\Controller;

use patterns\ApplicationController\AppException;
use patterns\ApplicationController\Command\Command;
use patterns\ApplicationController\Command\DefaultCommand;
use patterns\ApplicationController\Request\Request;

class AppController
{
    private static ?string $baseCommand = null;
    private static ?Command $defaultCommand = null;
    private ControllerMap $controllerMap;
    private array $invoked = [];

    /**
     * @param ControllerMap $map
     */
    public function __construct(ControllerMap $map)
    {
        $this->controllerMap = $map;
        if (!isset(self::$baseCommand)) {
            self::$baseCommand = new \ReflectionClass(Command::class);
            self::$defaultCommand = new DefaultCommand();
        }
    }

    public function reset(): void
    {
        $this->invoked = [];
    }

    public function getView(Request $request)
    {
        return $this->getResource($request, 'view');
    }

    private function getForward(Request $request)
    {
        $forward = $this->getResource($request, 'forward');
        if ($forward) {
            $request->setProperty('command', $forward);
        }
        return $forward;
    }

    private function getResource(Request $request, string $resourceName)
    {
        $commandStr = $request->getProperty('command');
        $previous = $request->getLastCommand();
        $status = $previous->getStatus();

        if (!isset($status) || !is_int($status)) {
            $status = 0;
        }
        $acquire = 'get' . ucfirst($resourceName);
        $resource = $this->controllerMap->$acquire($commandStr, $status);

        if (!isset($resource)) {
            $resource = $this->controllerMap->$acquire($commandStr, 0);
        }

        if (!isset($resource)) {
            $resource = $this->controllerMap->$acquire('default', $status);
        }

        if (!isset($resource)) {
            $resource = $this->controllerMap->$acquire('default', 0);
        }
        return $resource;
    }

    public function getCommand(Request $request)
    {
        $previous = $request->getLastCommand();
        if (!$previous) {
            $command = $request->getProperty('command');
            if (!isset($command)) {
                $request->setProperty('command', 'default');
                return self::$defaultCommand;
            }
        } else {
            $command = $this->getForward($request);
            if (!isset($command)) {
                return null;
            }
        }

        $commandObj = $this->resolveCommand($command);
        if (!isset($commandObj)) {
            throw new AppException('Команда "' . $command . '" не найдена');
        }
        $commandClass = get_class($commandObj);
        if (isset($this->invoked[$commandClass])) {
            throw new AppException('Циклический вызов');
        }
        $this->invoked[$commandClass] = 1;
        return $commandObj;
    }

    public function resolveCommand(string $command)
    {
        $classRoot = $this->controllerMap->getClassRoot($command);
        $className = '\\patterns\\ApplicationController\\Command\\' . $classRoot;

        $commandClass = new \ReflectionClass($className);
        if ($commandClass->isSubclassOf(self::$baseCommand)) {
            return $commandClass->newInstance();
        }
        return null;
    }
}


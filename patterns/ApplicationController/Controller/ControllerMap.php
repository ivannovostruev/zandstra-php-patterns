<?php

namespace patterns\ApplicationController\Controller;

class ControllerMap
{
    private array $viewMap = [];
    private array $forwardMap = [];
    private array $classRootMap = [];

    public function addClassRoot(string $command, string $classRoot): void
    {
        $this->classRootMap[$command] = $classRoot;
    }

    public function getClassRoot(string $command): ?string
    {
        return $this->classRootMap[$command] ?? null;
    }

    public function addView($view, string $command = 'default', int $status = 0): void
    {
        $this->viewMap[$command][$status] = $view;
    }

    public function getView(string $command, int $status): ?string
    {
        return $this->viewMap[$command][$status] ?? null;
    }

    public function addForward(string $command, int $status = 0, string $newCommand): void
    {
        $this->forwardMap[$command][$status] = $newCommand;
    }

    public function getForward(string $command, int $status): ?string
    {
        return $this->forwardMap[$command][$status] ?? null;
    }
}

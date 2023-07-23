<?php

namespace patterns\ApplicationController\Controller;

class ControllerMap
{
    private array $viewMap = [];
    private array $forwardMap = [];
    private array $classRootMap = [];

    /**
     * @param string $command
     * @param string $classRoot
     */
    public function addClassRoot(string $command, string $classRoot): void
    {
        $this->classRootMap[$command] = $classRoot;
    }

    /**
     * @param string $command
     * @return string|null
     */
    public function getClassRoot(string $command): ?string
    {
        return $this->classRootMap[$command] ?? null;
    }

    /**
     * @param $view
     * @param string $command
     * @param int $status
     */
    public function addView($view, string $command = 'default', int $status = 0): void
    {
        $this->viewMap[$command][$status] = $view;
    }

    /**
     * @param string $command
     * @param int $status
     * @return string|null
     */
    public function getView(string $command, int $status): ?string
    {
        return $this->viewMap[$command][$status] ?? null;
    }

    /**
     * @param string $command
     * @param int $status
     * @param string $newCommand
     */
    public function addForward(string $command, int $status = 0, string $newCommand): void
    {
        $this->forwardMap[$command][$status] = $newCommand;
    }

    /**
     * @param string $command
     * @param int $status
     * @return string|null
     */
    public function getForward(string $command, int $status): ?string
    {
        return $this->forwardMap[$command][$status] ?? null;
    }
}

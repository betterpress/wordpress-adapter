<?php

namespace Betterpress\Wordpress\Adapter\Hooks;

class HookConfiguration
{
    const ACTION = 'action';
    const FILTER = 'filter';

    const DEFAULT_PRIORITY = 10;
    const DEFAULT_ACCEPTED_ARGS = 1;

    private $type;
    private $hookName;
    private $priority;
    private $acceptedArgumentsCount;
    /**
     * @var Hook
     */
    private $hook;

    public function __construct($type, $hookName, Hook $hook, $priority = null, $acceptedArgumentsCount = null)
    {
        $this->type = $type;
        $this->hookName = $hookName;
        $this->hook = $hook;
        $this->priority = $priority;
        $this->acceptedArgumentsCount = $acceptedArgumentsCount;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getHookName()
    {
        return $this->hookName;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return mixed
     */
    public function getAcceptedArgumentsCount()
    {
        return $this->acceptedArgumentsCount;
    }

    /**
     * @return Hook
     */
    public function getHook()
    {
        return $this->hook;
    }

}

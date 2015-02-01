<?php

namespace Betterpress\Wordpress\Adapter\Hooks;

class HookContext
{
    /**
     * @var HookConfiguration
     */
    private $config;

    public function __construct(HookConfiguration $config)
    {
        $this->config = $config;
    }

    /**
     * @return HookConfiguration
     */
    public function getConfig()
    {
        return $this->config;
    }

}
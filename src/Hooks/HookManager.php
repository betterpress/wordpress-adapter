<?php

namespace Betterpress\Wordpress\Adapter\Hooks;

use AdamQuaile\PhpGlobal\Functions\FunctionWrapper;

class HookManager
{
    /**
     * @var HookConfiguration[]
     */
    private $hooks = array();

    /**
     * @var FunctionWrapper
     */
    private $functions;

    public function __construct(FunctionWrapper $functions)
    {
        $this->functions = $functions;
    }

    public function registerHooks()
    {
        foreach ($this->hooks as $config) {
            $this->functions->invoke(
                "add_{$config->getType()}",
                [
                    $config->getHookName(),
                    $this->functions->create(function() use ($config) {
                        $context = new HookContext($config);
                        return $config->getHook()->execute($context);
                    }),
                    $config->getPriority() ?: HookConfiguration::DEFAULT_PRIORITY,
                    $config->getAcceptedArgumentsCount() ?: HookConfiguration::DEFAULT_ACCEPTED_ARGS
                ]
            );
        }
    }

    public function add(HookConfiguration $hookConfiguration)
    {
        $this->hooks[] = $hookConfiguration;
    }
}

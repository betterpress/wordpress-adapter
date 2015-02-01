<?php

namespace Betterpress\Wordpress\Adapter\Hooks;

interface Hook
{
    public function execute(HookContext $context);
}
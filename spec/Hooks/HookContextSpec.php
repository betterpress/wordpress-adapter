<?php

namespace spec\Betterpress\Wordpress\Adapter\Hooks;

use Betterpress\Wordpress\Adapter\Hooks\HookConfiguration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookContextSpec extends ObjectBehavior
{
    function it_holds_config(HookConfiguration $config)
    {
        $this->beConstructedWith($config);
        $this->getConfig()->shouldReturn($config);
    }
}

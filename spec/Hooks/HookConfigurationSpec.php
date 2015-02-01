<?php

namespace spec\Betterpress\Wordpress\Adapter\Hooks;

use Betterpress\Wordpress\Adapter\Hooks\Hook;
use Betterpress\Wordpress\Adapter\Hooks\HookConfiguration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookConfigurationSpec extends ObjectBehavior
{
    function it_accepts_action_config_with_minimal_arguments(Hook $hook)
    {
        $this->beConstructedWith(HookConfiguration::ACTION, 'action_name', $hook);
        $this->getType()->shouldReturn('action');
        $this->getHookName()->shouldReturn('action_name');
        $this->getHook()->shouldReturn($hook);
        $this->getPriority()->shouldReturn(null);
        $this->getAcceptedArgumentsCount()->shouldReturn(null);
    }
    function it_accepts_filter_config_with_all_arguments(Hook $hook)
    {
        $this->beConstructedWith(HookConfiguration::FILTER, 'filter_name', $hook, null, null);
        $this->getType()->shouldReturn('filter');
        $this->getHookName()->shouldReturn('filter_name');
        $this->getHook()->shouldReturn($hook);
        $this->getPriority()->shouldReturn(null);
        $this->getAcceptedArgumentsCount()->shouldReturn(null);
    }
}

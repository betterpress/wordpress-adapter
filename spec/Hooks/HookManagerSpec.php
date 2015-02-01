<?php

namespace spec\Betterpress\Wordpress\Adapter\Hooks;

use AdamQuaile\PhpGlobal\Functions\FunctionWrapper;
use Betterpress\Wordpress\Adapter\Hooks\Hook;
use Betterpress\Wordpress\Adapter\Hooks\HookConfiguration;
use Betterpress\Wordpress\Adapter\Hooks\HookContext;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookManagerSpec extends ObjectBehavior
{
    public function let(FunctionWrapper $functionWrapper)
    {
        $this->beConstructedWith($functionWrapper);
    }

    function it_registers_no_hooks_if_no_hooks_added(FunctionWrapper $functionWrapper)
    {
        $functionWrapper->invoke('add_action', Argument::any())->shouldNotBeCalled();
        $this->registerHooks();
    }

    function it_registers_action_hook_when_added(FunctionWrapper $functionWrapper, HookConfiguration $config, Hook $hook)
    {
        $config->getType()->willReturn(HookConfiguration::ACTION);
        $config->getHook()->willReturn($hook);
        $config->getHookName()->willReturn('hook_name');
        $config->getPriority()->willReturn(null);
        $config->getAcceptedArgumentsCount()->willReturn(null);

        $this->add($config);

        $this->shouldRegisterHookWithFunctionNamePriorityAndAcceptedArgs(
            $functionWrapper,
            $hook,
            $config,
            'add_action',
            'hook_name',
            HookConfiguration::DEFAULT_PRIORITY,
            HookConfiguration::DEFAULT_ACCEPTED_ARGS
        );
    }
    function it_registers_action_hook_with_priority(FunctionWrapper $functionWrapper, HookConfiguration $config, Hook $hook)
    {
        $config->getType()->willReturn(HookConfiguration::ACTION);
        $config->getHook()->willReturn($hook);
        $config->getHookName()->willReturn('hook_name');
        $config->getPriority()->willReturn(5);
        $config->getAcceptedArgumentsCount()->willReturn(null);

        $this->add($config);

        $this->shouldRegisterHookWithFunctionNamePriorityAndAcceptedArgs(
            $functionWrapper,
            $hook,
            $config,
            'add_action',
            'hook_name',
            5,
            HookConfiguration::DEFAULT_ACCEPTED_ARGS
        );
    }

    function it_registers_action_hook_with_accepted_arguments(FunctionWrapper $functionWrapper, HookConfiguration $config, Hook $hook)
    {
        $config->getType()->willReturn(HookConfiguration::ACTION);
        $config->getHook()->willReturn($hook);
        $config->getHookName()->willReturn('hook_name');
        $config->getPriority()->willReturn(null);
        $config->getAcceptedArgumentsCount()->willReturn(2);

        $this->add($config);

        $this->shouldRegisterHookWithFunctionNamePriorityAndAcceptedArgs(
            $functionWrapper,
            $hook,
            $config,
            'add_action',
            'hook_name',
            HookConfiguration::DEFAULT_PRIORITY,
            2
        );
    }

    function it_registers_filter_hook_when_added(FunctionWrapper $functionWrapper, HookConfiguration $config, Hook $hook)
    {

        $config->getType()->willReturn(HookConfiguration::FILTER);
        $config->getHook()->willReturn($hook);
        $config->getHookName()->willReturn('hook_name');
        $config->getPriority()->willReturn(null);
        $config->getAcceptedArgumentsCount()->willReturn(null);

        $this->add($config);

        $this->shouldRegisterHookWithFunctionNamePriorityAndAcceptedArgs(
            $functionWrapper,
            $hook,
            $config,
            'add_filter',
            'hook_name',
            HookConfiguration::DEFAULT_PRIORITY,
            HookConfiguration::DEFAULT_ACCEPTED_ARGS
        );

    }

    private function shouldRegisterHookWithFunctionNamePriorityAndAcceptedArgs(FunctionWrapper $functionWrapper, Hook $hook, HookConfiguration $config, $function, $name, $priority, $args)
    {
        // We're testing that add_action or add_filter will be called with a function that when invoked
        // will execute the hook using the correct context
        $functionWrapper->create(
            Argument::that(
                function($callable) use ($hook, $config) {
                    $callable();
                    $hook->execute(
                        Argument::that(
                            function(HookContext $context) use ($config) {
                                return $context->getConfig() == $config->getWrappedObject();
                            }
                        )
                    )->shouldHaveBeenCalled();
                    return true;
                }
            )
        )->willReturn('imaginary_function_name')->shouldBeCalled();
        $functionWrapper->invoke(
            $function,
            array(
                $name,
                'imaginary_function_name',
                $priority,
                $args
            )
        )->shouldBeCalled();

        $this->registerHooks();

    }

}

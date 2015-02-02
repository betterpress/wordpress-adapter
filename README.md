# Wordpress Adapter

This package is an object-oriented layer around some of Wordpress' low-level API. Hooks are currently implemented.

Although you can use this package directly, it's more likely you'll want to use it as part of [wordpress-symfony-edition](http://www.github.com/betterpress/wordpress-symfony-edition)
as this will allow for much less verbose code.


## Usage

    <?php
    
    class MyHook implements Hook
    {
        public function execute(HookContext $context)
        {
            // your hook code.. 
        }
    }
    
    use Betterpress\Wordpress\Adapter\Hooks\HookManager;
    use Betterpress\Wordpress\Adapter\Hooks\HookConfiguration;
    
    $manager = new HookManager();
    
    $hook = new MyHook();
    
    $manager->add(
        new HookConfiguration(HookConfiguration::ACTION, 'publish_post', $hook)
    );

<?php

namespace Application;

use DevNet\System\Async\Task;
use DevNet\System\Configuration\IConfiguration;
use DevNet\System\Dependency\IServiceCollection;
use DevNet\Web\Dispatcher\IApplicationBuilder;
use DevNet\Web\Extensions\ServiceCollectionExtensions;
use DevNet\Web\Extensions\ApplicationBuilderExtensions;
use DevNet\Web\Http\HttpContext;

class Startup
{
    private IConfiguration $Configuration;

    public function __construct(IConfiguration $configuration)
    {
        $this->Configuration = $configuration;
    }

    public function configureServices(IServiceCollection $services)
    {
        // services
    }

    public function configure(IApplicationBuilder $app)
    {
        $app->UseExceptionHandler();

        $app->useRouter();
        
        $app->useEndpoint(function($routes)
        {
            $routes->mapGet("/", function(HttpContext $context) : Task
            {
               $context->Response->Body->write("Hello World!");
               return Task::completedTask();
            });
         });
    }
}

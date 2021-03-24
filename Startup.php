<?php

namespace Application;

use Artister\System\Async\Task;
use Artister\System\Configuration\IConfiguration;
use Artister\System\Dependency\IServiceCollection;
use Artister\Web\Dispatcher\IApplicationBuilder;
use Artister\Web\Extensions\ServiceCollectionExtensions;
use Artister\Web\Extensions\ApplicationBuilderExtensions;
use Artister\Web\Http\HttpContext;

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

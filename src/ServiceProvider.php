<?php

namespace Serrexlabs\Cqrs;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Serrexlabs\Cqrs\Console\Commands\CommandHandlerMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\CommandMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\InitProjectCommand;
use Serrexlabs\Cqrs\Console\Commands\ModelMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\ModuleMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\QueryHandlerMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\QueryMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\RepositoryInterfaceMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\RepositoryMakeCommand;
use Serrexlabs\Cqrs\Console\Commands\TransformerMakeCommand;
use Serrexlabs\Cqrs\Bus\CommandBus;
use Serrexlabs\Cqrs\Bus\QueryExecutor;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CommandHandlerMakeCommand::class,
                CommandMakeCommand::class,
                InitProjectCommand::class,
                ModelMakeCommand::class,
                ModuleMakeCommand::class,
                QueryHandlerMakeCommand::class,
                QueryMakeCommand::class,
                RepositoryInterfaceMakeCommand::class,
                RepositoryMakeCommand::class,
                TransformerMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $commandNamespace = "Command";
        $commandHandlerNamespace = "Command\Handlers";

        $this->app->singleton(CommandBus::class, function ($app) use ($commandNamespace, $commandHandlerNamespace){
            return new CommandBus($app, $commandNamespace, $commandHandlerNamespace);
        });

        $queryNamespace = "Query";
        $queryHandlerNamespace = "Query\Handlers";

        $this->app->singleton(QueryExecutor::class, function ($app) use ($queryNamespace, $queryHandlerNamespace){
            return new QueryExecutor($app, $queryNamespace, $queryHandlerNamespace);
        });
    }
}

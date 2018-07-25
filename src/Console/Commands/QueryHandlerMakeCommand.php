<?php

namespace  Serrexlabs\Cqrs\Console\Commands;


class QueryHandlerMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:cqrs:query-handler {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query handler';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'QueryHandler';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/queryHandler.stub';
    }

    protected function getEntityNamespace()
    {
        return  '\Query\Handlers';
    }
}

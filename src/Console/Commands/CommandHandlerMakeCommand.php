<?php

namespace Serrexlabs\Cqrs\Console\Commands;


class CommandHandlerMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:cqrs:command-handler {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new command handler';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CommandHandler';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/commandHandler.stub';
    }


    protected function getEntityNamespace()
    {
        return  '\Command\Handlers';
    }
}

<?php

namespace  Serrexlabs\Cqrs\Console\Commands;


class RepositoryInterfaceMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:repository-interface {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'RepositoryInterface';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repositoryInterface.stub';
    }


    protected function getEntityNamespace()
    {
        return  '\Repository\Contracts';
    }
}

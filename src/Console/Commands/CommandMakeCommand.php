<?php

namespace  Serrexlabs\Cqrs\Console\Commands;


class CommandMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:cqrs:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new command';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * @var string
     */
    protected $module;

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        parent::handle();

        $this->call('make:cqrs:command-handler', [
            'name' => $this->argument('name')."Handler",
            '--module' => $this->module
        ]);
    }


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/command.stub';
    }


    protected function getEntityNamespace()
    {
        return  '\Command';
    }

}

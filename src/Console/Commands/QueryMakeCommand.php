<?php

namespace  Serrexlabs\Cqrs\Console\Commands;

class QueryMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:cqrs:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Query';


    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        parent::handle();

        $this->call('make:cqrs:query-handler', [
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
        return __DIR__ . '/stubs/query.stub';
    }

    protected function getEntityNamespace()
    {
        return  '\Query';
    }
}

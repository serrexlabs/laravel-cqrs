<?php

namespace  Serrexlabs\Cqrs\Console\Commands;


use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    public function handle()
    {
        parent::handle();

        if ($this->option('repository')) {
            $this->createRepository();
        }

    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, factory, and resource controller for the model'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model.'],

            ['resource', 'res', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller.'],

            ['repository', 'r', InputOption::VALUE_NONE, 'Create a new repository for the model']
        ];
    }

    private function createRepository()
    {
        $this->call('make:repository', [
            'name' => $this->argument('name').'Repository'
        ]);
    }
}

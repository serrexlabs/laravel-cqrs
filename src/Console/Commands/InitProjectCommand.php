<?php

namespace  Serrexlabs\Cqrs\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class InitProjectCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:project {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating initial project folder structure';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->makeDirectory($path);

        $this->updateComposerJson($name);

        $this->info('Project initiated!');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel['path.base'].'/src/'.$name.'/.gitkeep';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }

    /**
     * @param $rootName
     */
    protected function updateComposerJson($rootName)
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $psr4 = data_get($composer, 'autoload.psr-4');
        $psr4[$rootName . "\\"] = "src". DIRECTORY_SEPARATOR . $rootName;
        array_set($composer, 'autoload.psr-4', $psr4);

        $composer = json_encode($composer, JSON_PRETTY_PRINT);
        $composer = str_replace("\/", DIRECTORY_SEPARATOR, $composer);
        file_put_contents(base_path('composer.json'), $composer);
        shell_exec('composer dumpautoload');
    }
}

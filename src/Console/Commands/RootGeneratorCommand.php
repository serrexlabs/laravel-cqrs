<?php

namespace  Serrexlabs\Cqrs\Console\Commands;

use Illuminate\Console\GeneratorCommand;

abstract class RootGeneratorCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $module;

    public function handle()
    {

        if(!$this->hasOption('module')) {
            $modules = [];

            foreach ($this->files->directories($this->getSrcDir()) as $rootDir) {
                $rootDir = basename($rootDir);

                foreach ($this->files->directories($this->getSrcDir().$rootDir) as $moduleDir) {
                    $moduleDir = basename($moduleDir);
                    $modules[] =
                        $rootDir."\\".$moduleDir;
                }
            }
            $this->module = $this->choice('Under which module?', $modules, 0);
        } else {
            $this->module = $this->option('module');
        }

        parent::handle();

    }

    protected function getPath($name)
    {
        return $this->getSrcDir().str_replace('\\', '/', $name).".php";
    }

    protected function qualifyClass($name)
    {
        return $this->rootNamespace().$this->getEntityNamespace()."\\".$name;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getSrcDir()
    {
        return $this->laravel['path.base'].'/src/';
    }

    abstract protected function getEntityNamespace();
}

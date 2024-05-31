<?php

namespace Raakkan\Yali\Core\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\GeneratorCommand;

class MakeResourceCommand extends GeneratorCommand
{
    protected $signature = 'yali:make-resource {model : The name of the model class}';

    protected $description = 'Create a new Yali resource class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/resource.stub';
    }

    protected function getPath($name)
    {
        $resourceName = Str::studly($name);
        return $this->laravel['path'].'/Yali/Resources/'.$resourceName.'.php';
    }

    protected function buildClass($name)
    {
        $model = $this->argument('model');
        $resourceName = $name;

        $stub = $this->files->get($this->getStub());

        $namespace = $this->rootNamespace() . 'Yali\\Resources';
        
        $stub = str_replace('{{ namespace }}', $namespace, $stub);
        $stub = str_replace('{{ class }}', $resourceName, $stub);

        $modelNamespace = $this->rootNamespace() . 'Models\\' . $model;
        $stub = str_replace('{{ modelNamespace }}', $modelNamespace, $stub);
        $stub = str_replace('{{ model }}', $model, $stub);

        return $stub;
    }

    public function handle()
    {
        $model = $this->argument('model');
        $modelClass = $this->laravel->getNamespace() . 'Models\\' . $model;

        if (!class_exists($modelClass)) {
            $this->error("Model '{$model}' does not exist.");
            return false;
        }

        $resourceName = Str::studly($model) . 'Resource';

        $path = $this->getPath($resourceName);

        if ($this->alreadyExists($resourceName)) {
            $this->error("Resource '{$resourceName}' already exists.");
            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($resourceName));

        $this->info("Resource '{$resourceName}' created successfully.");
    }

    protected function alreadyExists($resourceName)
    {
        return File::exists($this->getResourcePath($resourceName));
    }

    protected function getResourcePath($resourceName)
    {
        return app_path('Yali/Resources/' . $resourceName . '.php');
    }

}

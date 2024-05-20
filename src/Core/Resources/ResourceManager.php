<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Exceptions\PageRegistrationException;

class ResourceManager
{
    protected $resources = [];

    public function loadResources(): void
    {
        $this->loadResourcesFromDirectory('Raakkan\\Yali\\App\\Resources\\', __DIR__ . '/../../App/Resources', 'yali');
        $this->loadResourcesFromDirectory('App\\Yali\\Resources\\', base_path('app/Yali/Resources'), 'app');
    }

    protected function loadResourcesFromDirectory(string $resourcesNamespace, string $resourcesDirectory, string $source): void
    {
        if (!File::isDirectory($resourcesDirectory)) {
            return;
        }

        $files = File::allFiles($resourcesDirectory);

        foreach ($files as $file) {
            $class = $resourcesNamespace . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());
            $this->registerResource($class, $source);
        }
    }

    public function loadPluginResources(array $pluginResources): void
    {
        foreach ($pluginResources as $pluginResource) {
            $this->registerResource($pluginResource, 'plugin');
        }
    }

    protected function registerResource(string $class, string $source): void
    {
        if (!class_exists($class)) {
            throw new PageRegistrationException("Resource Class {$class} not found");
        }

        if (!is_subclass_of($class, YaliResource::class)) {
            throw new PageRegistrationException("Resource Class {$class} is not a subclass of YaliResource");
        }

        $this->resources[$class] = [
            'class' => $class,
            'source' => $source
        ];
    }

    public function getResources(): array
    {
        return $this->resources;
    }
}

<?php

namespace Raakkan\Yali\Core\Resources;

use Raakkan\Yali\App\PageComponent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\Resources\YaliResource;

class ResourceManager
{
    protected $resources = [];

    public function loadAppResources()
    {
        $resourcesNamespace = 'App\\Yali\\Resources\\';
        $resourcesDirectory = base_path('app/Yali/Resources');

        $this->loadResourcesFromDirectory($resourcesNamespace, $resourcesDirectory);
    }

    protected function loadResourcesFromDirectory($resourcesNamespace, $resourcesDirectory)
    {
        if (File::isDirectory($resourcesDirectory)) {
            foreach (File::allFiles($resourcesDirectory) as $file) {
                $class = $resourcesNamespace . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

                if (class_exists($class) && is_subclass_of($class, YaliResource::class)) {
                    $this->registerResource($class);
                }
            }
        }
    }

    public function loadPluginResources(array $pluginResources)
    {
        foreach ($pluginResources as $pluginResource) {
            if (is_string($pluginResource) && class_exists($pluginResource) && is_subclass_of($pluginResource, YaliResource::class)) {
                $this->registerResource($pluginResource);
            }
        }
    }

    protected function registerResource($class)
    {
        $resourceId = $this->generateResourceId($class);
        $resource = new $class();
        $this->resources[$resourceId] = [
            'resourceId' => $resourceId,
            'class' => $class,
            'title' => $resource->getTitle(),
            'navigationTitle' => $resource->getNavigationTitle(),
            'navigationGroup' => $resource->getNavigationGroup(),
            'navigationIcon' => $resource->getNavigationIcon(),
            // TODO: order 1 by default?
            'navigationOrder' => $resource->getNavigationOrder(),
            'slug' => $resource->getSlug(),
        ];
    }

    public function registerReources(){
        $resources = $this->getResources();
        foreach ($resources as $resourceId => $resource) {
            $resourceClass = $resource['class'];
            
            // TODO: if this is actually needed
            $slug = (new $resourceClass)->getSlug();
            Route::prefix('admin')->group(function () use ($slug, $resourceId, $resourceClass) {
                Route::get($slug, PageComponent::class)->name('yali::resources.'.$resourceId);
            });
        }
    }

    /**
     * Generate a unique ID for a resource class.
     *
     * @param class-string<YaliResource> $class The class name of the resource.
     *
     * @return string The unique ID for the resource class.
     */
    protected function generateResourceId(string $class): string
    {
        return md5($class);
    }


    /**
     * Get the resources.
     *
     * @return array<string, array<string, string>> Array of resources, where the key is the resource ID and the value is an array with the resource details.
     */
    public function getResources(): array
    {
        return $this->resources;
    }

    /**
     * @param string $resourceId
     * @return YaliResource
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getResource(string $resourceId): YaliResource
    {
        if (!array_key_exists($resourceId, $this->resources)) {
            throw new \InvalidArgumentException("Resource with ID '{$resourceId}' not found.");
        }

        $resourceClass = $this->resources[$resourceId]['class'];

        if (!class_exists($resourceClass)) {
            throw new \RuntimeException("Resource class '{$resourceClass}' does not exist.");
        }

        if (!is_a($resourceClass, YaliResource::class, true)) {
            throw new \RuntimeException("Resource class '{$resourceClass}' does not extend the YaliResource class.");
        }

        /** @var YaliResource $resource */
        $resource = new $resourceClass();
        return $resource;
    }


}

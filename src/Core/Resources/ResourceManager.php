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
            'navigationOrder' => $resource->getNavigationOrder(),
            'slug' => $resource->getSlug(),
        ];
    }

    public function registerReources(){
        $resources = $this->getResources();
        foreach ($resources as $resourceId => $resource) {
            $resourceClass = $resource['class'];
            
            // Register the route for the page with "admin" prefix
            $slug = (new $resourceClass)->getSlug();
            Route::prefix('admin')->group(function () use ($slug, $resourceId, $resourceClass) {
                Route::get($slug, PageComponent::class)->name('yali::resources.'.$resourceId);
            });
        }
    }

    protected function generateResourceId($class)
    {
        return md5($class);
    }

    /**
     * Get the value of resources
     */
    public function getResources()
    {
        return $this->resources;
    }

     /**
     * Get a specific resource by its ID
     *
     * @param string $resourceId
     * @return array|null
     */
    public function getResource($resourceId)
    {
        return $this->resources[$resourceId] ?? null;
    }
}

<?php

namespace Raakkan\Yali\Core\Resources;

use Raakkan\Yali\App\PageComponent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\Resources\Resource;
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
        if (!class_exists($class) || !is_subclass_of($class, YaliResource::class)) {
            throw new \InvalidArgumentException("Invalid resource class: {$class}");
        }

        $resourceId = $this->generateResourceId($class);
        $resource = new $class();
        $this->resources[$resourceId] = new Resource($resourceId, $class, $resource);
    }

    public function registerResources(){
        $resources = $this->getResources();
        foreach ($resources as $resourceId => $resource) {
            $resourceClass = $resource->class;
            
            $slug = (new $resourceClass)->getSlug();
            $uniqueSlug = $this->generateUniqueSlug($slug);
    
            $routeName = 'yali::resources.'.$resourceId;
            $routeUri = 'admin/'.$uniqueSlug;
    
            if (!$this->routeExists($routeUri, $routeName)) {
                Route::prefix('admin')->group(function () use ($uniqueSlug, $routeName) {
                    Route::get($uniqueSlug, PageComponent::class)->name($routeName);
                });
            }
        }
    }
    
    protected function routeExists($uri, $name)
    {
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            if ($route->uri === $uri || $route->getName() === $name) {
                return true;
            }
        }
        
        return false;
    }
    

    protected function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->routeWithSlugExists($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    protected function routeWithSlugExists($slug)
    {
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            if ($route->uri === 'admin/'.$slug) {
                return true;
            }
        }
        
        return false;
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

        $resourceClass = $this->resources[$resourceId]->class;

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

<?php

namespace Raakkan\Yali\Core\Plugin\Dtos;

//TODO: remove all set methods 
class PluginDto
{
    public $id;
    public $name;
    public $version;
    public $description;
    public $author;
    public $active;
    public $path;
    public $url;
    public $license;
    public $namespace;
    public $screenshot;
    public $logo;
    public $documentation_url;

    public $invalidFields;
    
    public function __construct(
        $id = null,
        $name = null,
        $version = null,
        $description = null,
        $author = null,
        $active = null,
        $path = null,
        $url = null,
        $license = null,
        $namespace = null,
        $screenshot = null,
        $logo = null,
        $documentation_url = null,
        $invalidFields = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->version = $version;
        $this->description = $description;
        $this->author = $author;
        $this->active = $active;
        $this->path = $path;
        $this->url = $url;
        $this->license = $license;
        $this->namespace = $namespace;
        $this->screenshot = $screenshot;
        $this->logo = $logo;
        $this->documentation_url = $documentation_url;
        $this->invalidFields = $invalidFields;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'version' => $this->version,
            'description' => $this->description,
            'author' => $this->author,
            'active' => $this->active,
            'path' => $this->path,
            'url' => $this->url,
            'license' => $this->license,
            'namespace' => $this->namespace,
            'screenshot' => $this->screenshot,
            'logo' => $this->logo,
            'documentation_url' => $this->documentation_url,
        ];
    }

}

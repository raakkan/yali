<?php

namespace Raakkan\Yali\Core\Plugin\Dtos;

use Raakkan\Yali\Core\Plugin\Dtos\PluginDto;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class PluginSynth extends Synth
{
    public static $key = 'plugin-dto';

    public static function match($target)
    {
        return $target instanceof PluginDto;
    }

    public function dehydrate($target)
    {
        return [[
            'id' => $target->id,
            'name' => $target->name,
            'version' => $target->version,
            'description' => $target->description,
            'author' => $target->author,
            'active' => $target->active,
            'path' => $target->path,
            'url' => $target->url,
            'license' => $target->license,
            'namespace' => $target->namespace,
            'screenshot' => $target->screenshot,
            'logo' => $target->logo,
            'documentation_url' => $target->documentation_url,
            'invalidFields' => $target->invalidFields
        ], []];
    }

    public function hydrate($value)
    {
        $instance = new PluginDto();

        $instance->id = $value['id'];
        $instance->name = $value['name'];
        $instance->version = $value['version'];
        $instance->description = $value['description'];
        $instance->author = $value['author'];
        $instance->active = $value['active'];
        $instance->path = $value['path'];
        $instance->url = $value['url'];
        $instance->license = $value['license'];
        $instance->namespace = $value['namespace'];
        $instance->screenshot = $value['screenshot'];
        $instance->logo = $value['logo'];
        $instance->documentation_url = $value['documentation_url'];
        $instance->invalidFields = $value['invalidFields'];

        return $instance;
    }

    public function get(&$target, $key)
    {
        return $target->{$key};
    }

    public function set(&$target, $key, $value)
    {
        $target->{$key} = $value;
    }
}

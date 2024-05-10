<?php

namespace Raakkan\Yali\Core\Plugin\Dtos;

use Raakkan\Yali\Core\Plugin\Dtos\Plugin;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class PluginSynth extends Synth
{
    public static $key = 'plugin';

    public static function match($target)
    {
        return $target instanceof Plugin;
    }

    public function dehydrate($target)
    {
        return [[
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
        ], []];
    }

    public function hydrate($value)
    {
        $instance = new Plugin();

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

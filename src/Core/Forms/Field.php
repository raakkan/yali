<?php

namespace Raakkan\Yali\Core\Forms;

use Illuminate\Contracts\Validation\Rule;

abstract class Field
{
    /**
     * The name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The label of the field.
     *
     * @var string
     */
    public $label;

    /**
     * The validation rules for the field.
     *
     * @var array
     */
    public $rules = [];

    /**
     * The default value for the field.
     *
     * @var mixed
     */
    public $default;

    /**
     * The help text for the field.
     *
     * @var string|null
     */
    public $help;

    /**
     * Create a new field instance.
     *
     * @param  string  $name
     * @param  string  $label
     * @param  array  $rules
     * @param  mixed  $default
     * @param  string|null  $help
     * @return static
     */
    public static function make($name, $label, $rules = [], $default = null, $help = null)
    {
        return new static($name, $label, $rules, $default, $help);
    }

    /**
     * Create a new field instance.
     *
     * @param  string  $name
     * @param  string  $label
     * @param  array  $rules
     * @param  mixed  $default
     * @param  string|null  $help
     */
    public function __construct($name, $label, $rules = [], $default = null, $help = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->rules = $this->parseRules($rules);
        $this->default = $default;
        $this->help = $help;
    }

    /**
     * Parse the validation rules.
     *
     * @param  array  $rules
     * @return array
     */
    protected function parseRules($rules)
    {
        return array_map(function ($rule) {
            if ($rule instanceof Rule) {
                return $rule;
            }

            return $rule;
        }, $rules);
    }
}

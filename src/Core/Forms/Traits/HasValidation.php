<?php

namespace Raakkan\Yali\Core\Forms\Traits;

use Illuminate\Validation\Rules\Password;

trait HasValidation
{
    /**
     * The validation rules for the form.
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * Add the "required" validation rule.
     *
     * @return $this
     */
    public function required()
    {
        return $this->addValidationRule('required');
    }

    /**
     * Add the "url" validation rule.
     *
     * @return $this
     */
    public function url()
    {
        return $this->addValidationRule('url');
    }

    /**
     * Add the "date" validation rule.
     *
     * @return $this
     */
    public function date()
    {
        return $this->addValidationRule('date');
    }

    /**
     * Add the "date_format" validation rule.
     *
     * @param string $format
     * @return $this
     */
    public function dateFormat(string $format)
    {
        return $this->addValidationRule('date_format:' . $format);
    }

    /**
     * Add the "after" validation rule.
     *
     * @param string $date
     * @return $this
     */
    public function after(string $date)
    {
        return $this->addValidationRule('after:' . $date);
    }

    /**
     * Add the "before" validation rule.
     *
     * @param string $date
     * @return $this
     */
    public function before(string $date)
    {
        return $this->addValidationRule('before:' . $date);
    }

    /**
     * Add the "after_or_equal" validation rule.
     *
     * @param string $date
     * @return $this
     */
    public function afterOrEqual(string $date)
    {
        return $this->addValidationRule('after_or_equal:' . $date);
    }

    /**
     * Add the "before_or_equal" validation rule.
     *
     * @param string $date
     * @return $this
     */
    public function beforeOrEqual(string $date)
    {
        return $this->addValidationRule('before_or_equal:' . $date);
    }

    /**
     * Add the "same" validation rule.
     *
     * @param string $field
     * @return $this
     */
    public function same(string $field)
    {
        return $this->addValidationRule('same:' . $field);
    }

    /**
     * Add the "min" validation rule.
     *
     * @param int $value
     * @return $this
     */
    public function min(int $value)
    {
        return $this->addValidationRule('min:' . $value);
    }

    /**
     * Add the "max" validation rule.
     *
     * @param int $value
     * @return $this
     */
    public function max(int $value)
    {
        return $this->addValidationRule('max:' . $value);
    }

    /**
     * Add the "regex" validation rule.
     *
     * @param string $pattern
     * @return $this
     */
    public function regex(string $pattern)
    {
        return $this->addValidationRule('regex:' . $pattern);
    }

    /**
     * Add the "unique" validation rule.
     *
     * @param string $table
     * @param string $column
     * @param int|null $exceptId
     * @return $this
     */
    public function unique(string $table, string $column, int $exceptId = null)
    {
        $rule = 'unique:' . $table . ',' . $column;

        if ($exceptId !== null) {
            $rule .= ',' . $exceptId;
        }

        return $this->addValidationRule($rule);
    }

    /**
     * Add multiple validation rules.
     *
     * @param array $rules
     * @return $this
     */
    public function rules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addValidationRule($rule);
        }

        return $this;
    }

    /**
     * Add a custom validation rule.
     *
     * @param string $rule
     * @return $this
     */
    public function addValidationRule(string | Password $rule)
    {
        $this->validationRules[] = $rule;

        return $this;
    }

    /**
     * Get the validation rules for the form.
     *
     * @return array
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * Reset the validation rules.
     *
     * @return $this
     */
    public function resetValidationRules()
    {
        $this->validationRules = [];

        return $this;
    }

}

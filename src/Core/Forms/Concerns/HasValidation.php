<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Illuminate\Validation\Rules\Password;

// TODO: Add validation attribute name support
trait HasValidation
{
    /**
     * The validation rules for the form.
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * The custom validation messages for the form.
     *
     * @var array
     */
    protected $validationMessages = [];

    /**
     * Add the "required" validation rule.
     *
     * @return $this
     */
    public function required(?string $errorMessage = null)
    {
        return $this->addValidationRule('required', $errorMessage);
    }

    /**
     * Add the "url" validation rule.
     *
     * @return $this
     */
    public function url(?string $errorMessage = null)
    {
        return $this->addValidationRule('url', $errorMessage);
    }

    /**
     * Add the "date" validation rule.
     *
     * @return $this
     */
    public function date(?string $errorMessage = null)
    {
        return $this->addValidationRule('date', $errorMessage);
    }

    /**
     * Add the "date_format" validation rule.
     *
     * @return $this
     */
    public function dateFormat(string $format, ?string $errorMessage = null)
    {
        return $this->addValidationRule('date_format:'.$format, $errorMessage);
    }

    /**
     * Add the "after" validation rule.
     *
     * @return $this
     */
    public function after(string $date, ?string $errorMessage = null)
    {
        return $this->addValidationRule('after:'.$date, $errorMessage);
    }

    /**
     * Add the "before" validation rule.
     *
     * @return $this
     */
    public function before(string $date, ?string $errorMessage = null)
    {
        return $this->addValidationRule('before:'.$date, $errorMessage);
    }

    /**
     * Add the "after_or_equal" validation rule.
     *
     * @return $this
     */
    public function afterOrEqual(string $date, ?string $errorMessage = null)
    {
        return $this->addValidationRule('after_or_equal:'.$date, $errorMessage);
    }

    /**
     * Add the "before_or_equal" validation rule.
     *
     * @return $this
     */
    public function beforeOrEqual(string $date, ?string $errorMessage = null)
    {
        return $this->addValidationRule('before_or_equal:'.$date, $errorMessage);
    }

    /**
     * Add the "same" validation rule.
     *
     * @return $this
     */
    public function same(string $field, ?string $errorMessage = null)
    {
        return $this->addValidationRule('same:'.$field, $errorMessage);
    }

    /**
     * Add the "min" validation rule.
     *
     * @return $this
     */
    public function min(int $value, ?string $errorMessage = null)
    {
        return $this->addValidationRule('min:'.$value, $errorMessage);
    }

    /**
     * Add the "max" validation rule.
     *
     * @return $this
     */
    public function max(int $value, ?string $errorMessage = null)
    {
        return $this->addValidationRule('max:'.$value, $errorMessage);
    }

    /**
     * Add the "regex" validation rule.
     *
     * @return $this
     */
    public function regex(string $pattern, ?string $errorMessage = null)
    {
        return $this->addValidationRule('regex:'.$pattern, $errorMessage);
    }

    /**
     * Add the "unique" validation rule.
     *
     * @return $this
     */
    public function unique(string $table, string $column, ?int $exceptId = null, ?string $errorMessage = null)
    {
        $rule = 'unique:'.$table.','.$column;

        if ($exceptId !== null) {
            $rule .= ','.$exceptId;
        }

        return $this->addValidationRule($rule, $errorMessage);
    }

    /**
     * Add multiple validation rules.
     *
     * @return $this
     */
    public function rules(array $rules)
    {
        foreach ($rules as $rule => $errorMessage) {
            $this->addValidationRule($rule, $errorMessage);
        }

        return $this;
    }

    /**
     * Add a custom validation rule.
     *
     * @return $this
     */
    public function addValidationRule(string|Password $rule, ?string $errorMessage = null)
    {
        if ($rule instanceof Password) {
            $ruleName = 'password';
        } else {
            $ruleName = $rule;
        }

        $this->validationRules[] = $rule;

        if ($errorMessage !== null) {
            $this->validationMessages[$ruleName] = $errorMessage;
        }

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
     * Get the validation messages for the form.
     *
     * @return array
     */
    public function getValidationMessages()
    {
        $messages = [];

        foreach ($this->validationRules as $rule) {

            if ($rule instanceof Password) {
                $ruleName = 'password';
            } else {
                $ruleName = $rule;
            }

            if (isset($this->validationMessages[$ruleName])) {
                $messages[$rule] = $this->validationMessages[$rule];
            }
        }

        return $messages;
    }

    /**
     * Reset the validation rules and messages.
     *
     * @return $this
     */
    public function resetValidation()
    {
        $this->validationRules = [];
        $this->validationMessages = [];

        return $this;
    }
}

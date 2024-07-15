<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Validation\Rules\Password;

class TextField extends Field
{
    protected $view = 'yali::forms.fields.text-field';

    protected $type = 'text';

    protected $isConfirm = false;

    protected $confirmFieldName = '';

    /**
     * Add the "email" validation rule.
     *type = 'text';
     *
     * @return $this
     */
    public function email()
    {
        $this->setType('email');

        return $this->addValidationRule('email');
    }

    public function password(
        int $minLength = 8,
        bool $letters = false,
        bool $numbers = false,
        bool $symbols = false,
        bool $mixed = false,
        bool $uncompromised = false
    ) {
        $this->setType('password');
        $this->required();

        $rule = Password::min($minLength);

        if ($letters) {
            $rule->letters();
        }
        if ($numbers) {
            $rule->numbers();
        }
        if ($symbols) {
            $rule->symbols();
        }
        if ($mixed) {
            $rule->mixedCase();
        }
        if ($uncompromised) {
            $rule->uncompromised();
        }

        $this->addValidationRule($rule);

        return $this;
    }

    /**
     * Add password confirmation validation rule.
     *
     * @return $this
     */
    public function passwordConfirmation(string $confirmField)
    {
        $this->addValidationRule('confirmed:'.$confirmField);

        $this->confirmFieldName = $confirmField;

        $this->isConfirm = true;

        return $this;
    }

    public function isConfirm()
    {
        return $this->isConfirm;
    }

    public function getConfirmFieldName()
    {
        return $this->confirmFieldName;
    }
}

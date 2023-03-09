<?php

namespace components;

class Validator
{
    protected array $data;
    protected array $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate($rules): Validator
    {
        foreach ($rules as $field => $rule) {
            $fieldRules = explode('|', $rule);

            foreach ($fieldRules as $fieldRule) {
                $this->applyRule($field, $fieldRule);
            }
        }

        return $this;
    }

    protected function applyRule($field, $rule): void
    {
        if (!key_exists($field, $this->data)) {
            $this->addError($field, "Field '$field' is not valid.");
            return;
        }
        $value = $this->data[$field];

        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'This field is required.');
                }
                break;
            case 'email':
                if (!$this->checkSingleAtSymbol($value)) {
                    $this->addError($field, 'This field must be a valid email address.');
                }
                break;
            case 'matching_passwords':
                $this->checkMatchingPasswords();
                break;
            default:
                break;
        }
    }

    protected function addError($field, $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = $message;
    }

    protected function checkMatchingPasswords(): void
    {
        $password = $this->data['password'];
        $confirmPassword = $this->data['password_confirm'];

        if ($password !== $confirmPassword) {
            $this->addError('password_confirm', 'Passwords do not match.');
        }
    }

    protected function checkSingleAtSymbol($string): bool
    {
        return (preg_match_all('/\@/', $string, $matches) === 1);
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}

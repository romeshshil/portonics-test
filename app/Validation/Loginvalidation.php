<?php

namespace App\Validation;

class LoginValidation
{

    public static function validate(array $data): bool
    {
        if(!isset($data['email']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return false;
        }

        if(!isset($data['password']) || empty($data['password'])){
            return false;
        }

        return true;
    }
}

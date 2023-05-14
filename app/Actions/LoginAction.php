<?php

namespace App\Actions;

use App\Helper\Redirect;
use App\Services\LoginService;
use App\Validation\LoginValidation;

class LoginAction
{

    public static function verifyUser(array $data)
    {
        $validated = LoginValidation::validate($data);
        if (!$validated) {
            return null;
        }
        $user = LoginService::getUser($data);
        if (is_null($user)) {
            return null;
        }

        if (!LoginService::authenticate($user, $data['password'])) {
            return null;
        }
        return $user['id'];
    }

    public static function logoutUser()
    {
        Redirect::toLogin();
    }
}

<?php

namespace App\Actions;

use App\Services\LoginService;
use App\Services\OrderCreateService;

class OrderCreateAction
{

    public static function create(array $data):?string
    {
        // $validated = LoginValidation::validate($data);
        return OrderCreateService::create($data);

    }
}

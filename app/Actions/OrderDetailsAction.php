<?php

namespace App\Actions;

use App\Services\OrderDetailsService;

class OrderDetailsAction
{

    public static function getDetails(string $orderId):?array
    {
        return OrderDetailsService::get($orderId);
    }

    public static function getOrders():?array
    {
        return OrderDetailsService::getAll();
    }

    
}

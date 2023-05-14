<?php

namespace App\Actions;

use App\Configs\Config;
use App\Helper\Redirect;
use App\Services\OrderCreateService;
use App\Services\OrderDetailsService;
use App\Services\PortposService;

class PaymentAction
{

    public static function create(string $orderId):?string
    {

        $order = OrderDetailsService::get($orderId);
        if(is_null($order)){
            return null;
        }

        $pp = new PortposService();
        list($ok, $res) = $pp->generateInvoice($pp->processPayload($order));

        if ($ok && isset($res['data']['invoice_id'])) {
            $invoice = $res['data']['invoice_id'];

            OrderCreateService::createPaymentHistory($orderId, $invoice);
            $paymentUrl = rtrim(Config::PORTPOS_PAGE_BASE_URL, '/').$invoice;
            Redirect::to($paymentUrl);
        }

        return null;
         
    }

    
}

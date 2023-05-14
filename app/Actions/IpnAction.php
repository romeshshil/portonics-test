<?php

namespace App\Actions;

use App\Services\OrderDetailsService;
use App\Services\OrderUpdateService;
use App\Services\PortposService;

class IpnAction
{

    public static function listen(array $post): void
    {
        $invoice = $post['invoice'];
        $amount = $post['amount'];
        $reference = $post['reference'];

        $orderHistory = OrderDetailsService::getOrderHistoryByInvoice($invoice);

        if (empty($orderHistory)) {
            echo "Order not found {$invoice} {$amount} {$reference}";
            die;
        }

        $o = OrderDetailsService::get($orderHistory['order_id']);

        if (empty($o)) {
            echo "Order not found {$invoice} {$amount} {$reference}";
            die;
        }
        if (intval($o['status']) > 0) {
            echo "Order already paid or processed";
            die;
        }

        $pp = new PortposService();
        list($ok, $res) = $pp->ipnValidate($invoice, $amount);
        if ($ok && isset($res['data']['order']['status'])) {
            $response = [
                'source' => isset($res['data']['billing']['source']) ? $res['data']['billing']['source'] : '',
                'transactions' => isset($res['data']['transactions']) ? $res['data']['transactions'] : ''
            ];
            switch ($res['data']['order']['status']) {
                case "ACCEPTED":
                    OrderUpdateService::afterPaymentUpdate($o['order_id'], $invoice, $response, 1);
                    break;
                case "REJECTED":
                case "CANCELLED":
                default:
                    OrderUpdateService::afterPaymentUpdate($o['order_id'], $invoice, $response, 0);
                    break;
            }

            echo "Order Payment Updated.";
            die;
        }
    }
}

<?php

namespace App\Services;

use App\Helper\Str;
use Exception;

class OrderUpdateService
{

    public static function afterPaymentUpdate(string $orderId, string $invoice, $response = null, string $isPaid): bool
    {
        try {
            $db = new DatabaseService;
            $pdo = $db->getPDO();
            $pdo->beginTransaction();

            $keyValue = "invoice=:invoice,is_paid=:is_paid,status=:status";
            $bind = [
                'invoice' => $invoice,
                'is_paid' => $isPaid,
                'status' => $isPaid === 1 ? 1 : 0,
                'order_id' => $orderId,
            ];

            $query = "UPDATE orders SET {$keyValue} WHERE order_id = :order_id";

            $stmt = $pdo->prepare($query);
            $stmt->execute($bind);

            $bind = [
                'response' => is_object($response) || is_array($response) ? json_encode($response) : $response,
                'invoice' => $invoice,
            ];
            $query = "UPDATE order_history SET response=:response WHERE invoice=:invoice";

            $stmt = $pdo->prepare($query);
            $stmt->execute($bind);
            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollback();
            return false;
        }
    }

    public static function changeStatus(string $orderId, int $status): ?string
    {
        try {
            $db = new DatabaseService;
            $pdo = $db->getPDO();
            $keyValue = "status=:status";
            $bind = [
                'status' => $status,
                'order_id' => $orderId,
            ];
            $query = "UPDATE orders SET {$keyValue} WHERE order_id = :order_id";

            $stmt = $pdo->prepare($query);
            $stmt->execute($bind);

            return $orderId;
        } catch (Exception $e) {
            return null;
        }
    }
}

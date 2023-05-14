<?php

namespace App\Services;

use App\Helper\Str;
use Exception;

class OrderDetailsService
{

    public static function get(string $orderId): ?array
    {

        $db = new DatabaseService;
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE order_id = ?');
        $stmt->execute([$orderId]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return $data;
    }
    public static function getAll(): ?array
    {
        $db = new DatabaseService;
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM orders ORDER BY id DESC');
        $stmt->execute();
        $data = $stmt->fetchAll();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public static function getOrderHistoryByInvoice(string $invoice): ?array
    {
        $db = new DatabaseService;
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM order_history WHERE invoice = ?');
        $stmt->execute([$invoice]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return $data;
    }
}

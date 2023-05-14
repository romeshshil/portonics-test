<?php

namespace App\Services;

use App\Helper\Str;
use Exception;

class OrderCreateService
{

    public static function create(array $data): ?string
    {
        try {
            $db = new DatabaseService;
            $pdo = $db->getPDO();
            $uuid = Str::uuid();
            
            $columns = "order_id,phone,name,email,address,status,is_paid,product,description,amount,currency";
            $values = ":order_id,:phone,:name,:email,:address,:status,:is_paid,:product,:description,:amount,:currency";
            $bind = [
                ':phone' => $data['customer_phone'],
                ':name' => $data['customer_name'],
                ':email' => $data['customer_email'],
                ':address' => $data['customer_address'],
                ':product' => $data['product_name'],
                ':description' => $data['product_details'],
                ':amount' => $data['amount'],
                ':currency' => 'BDT',
                ':status' => 0,
                ':is_paid' => 0,
                ':order_id' => $uuid
            ];

            $query = "INSERT INTO orders ({$columns}) VALUES({$values})";
            $stmt = $pdo->prepare($query);
            $stmt->execute($bind);
            return $uuid;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function createPaymentHistory(string $orderId,string $invoice): ?string
    {
        try {
            $db = new DatabaseService;
            $pdo = $db->getPDO();
            $uuid = Str::uuid();
            
            $columns = "order_id,invoice";
            $values = ":order_id,:invoice";
            $bind = [
                ':order_id' => $orderId,
                ':invoice' => $invoice
            ];

            $query = "INSERT INTO order_history ({$columns}) VALUES({$values})";
            $stmt = $pdo->prepare($query);
            $stmt->execute($bind);
            return $uuid;
        } catch (Exception $e) {
            return null;
        }
    }
}

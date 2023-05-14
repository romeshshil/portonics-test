<?php

namespace App\Helper;

class Str
{
    public static function uuid(): string
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function orderStatus(int $status): string
    {
        $data = [
            0 => 'pending',
            1 => 'paid',
            2 => 'fulfilled',
            3 => 'refund',
        ];

        return isset($data[$status]) ? $data[$status] : 'N/A';
    }
    public static function orderPayStatus(int $status): string
    {
        $data = [
            0 => 'not paid',
            1 => 'paid',
        ];

        return isset($data[$status]) ? $data[$status] : 'N/A';
    }
}

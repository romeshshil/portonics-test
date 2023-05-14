<?php

namespace App\Services;

use App\Configs\Config;

class PortposService
{

    private $appKey = null;

    private $secretKey = null;

    public function __construct(?string $appKey = null, ?string $secretKey = null)
    {
        $this->appKey = $appKey ?? Config::PORTPOS_APP_KEY;
        $this->secretKey = $secretKey ?? Config::PORTPOS_SECRET_KEY;
    }

    public function generateInvoice($data)
    {
        $url = $this->getInvoiceUrl();

        return $this->post($url, json_encode($data), $this->header());
    }

    private function getInvoiceUrl()
    {
        return rtrim(Config::PORTPOS_API_BASE_URL, '/') . '/v2/invoice';
    }

    private function getIpnUrl($invoice, $amount)
    {
        return  rtrim(Config::PORTPOS_API_BASE_URL, '/') . "/v2/invoice/ipn/{$invoice}/{$amount}";
    }

    public function ipnValidate($invoice, $amount)
    {
        $url = $this->getIpnUrl($invoice, $amount);
        return $this->get($url, $this->header());
    }

    public function getInvoiceDetail($invoiceid)
    {
        $url = $this->getInvoiceUrl() . '/' . $invoiceid;
        return $this->get($url, $this->header());
    }

    private function header()
    {
        $options[] = 'Authorization: ' . 'Bearer ' . base64_encode($this->appKey . ":" . md5($this->secretKey . time()));
        $options[] = 'Content-Type: ' . 'application/json';
        return $options;
    }

    private function post($url, $payload, $options = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $options);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        curl_close($ch);
        $success = false;
        if (substr($info['http_code'], 0, 2) == 20 && !empty($response)) {
            $success = true;
        }
        return [$success, json_decode($response, true)];
    }

    private function get($url, $options = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $options);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        curl_close($ch);
        $success = false;
        if (substr($info['http_code'], 0, 2) == 20 && !empty($response)) {
            $success = true;
        }
        return [$success, json_decode($response, true)];
    }

    public function processPayload(array $o): array
    {
        $payload =  [
            'order' => [
                'amount' => floatval($o['amount']),
                'currency' => $o['currency'],
                'redirect_url' => Config::BASE_URL . '/payment-return.php?order=' . $o['order_id'],
                'ipn_url' => Config::BASE_URL . '/ipn.php?order=' . $o['order_id'],
                'reference' => $o['order_id'],
                'validity' => 10000,
            ],

            'product' => [
                'name' => $o['product'],
                'description' => $o['description'],
            ],

            'billing' => [
                'customer' => [
                    'name' => $o['name'],
                    'email' => $o['email'],
                    'phone' => $o['phone'],
                    'address' => [
                        'street' => $o['address'],
                        'city' => 'Dhaka',
                        'state' => 'Dhaka',
                        'zipcode' => 1207,
                        'country' => 'BGD',
                    ],
                ],
            ],
        ];
        return $payload;
    }
}

<?php

namespace App\Service;

use App\Model\Order\OrderAdapter as Order;

class WhatsAppService
{
    const API_URL = 'https://api.whatsapp.com';

    private $endpoint;

    public function __construct()
    {

    }

    public function buildSendEndpoint(String $phone, String $message)
    {
        $query = [
            'phone' => $phone,
            'message' => urlencode($message),
        ];

        $url = self::API_URL;

        $query = http_build_query($query);

        return "$url/send?$query";
    }

    public function greet(Order $order)
    {
        $phone = $order->user->contact->whatsapp;

        $message = "Buen día, en este link puedes encontrar nuestro menú";

        return $this->buildSendEndpoint($phone, $message);
    }
}









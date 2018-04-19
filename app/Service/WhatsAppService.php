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

    public function buildSendEndpoint(Array $params)
    {
        if (array_key_exists('text', $params)) {
            $params['text'] = str_replace(' ', '%20', $params['text']);
            $params['text'] = str_replace('_NL', '%0A', $params['text']);
        }

        $url = self::API_URL;

        $query = '';
        foreach ($params as $param => $value) {
           $query .= "$param=$value&";
        }

        return "$url/send?$query";
    }

    public function greet(Order $order)
    {
        $phone = $order->user->contact->whatsapp;

        $business = $order->business;
        $businessUrl = route('front.menu.index', [
            'businessSlug' => $business->slug,
            'user' => $order->user->id,
        ]);

        $message = "Buen día, en este link puedes encontrar nuestro menú:_NL_NL";
        $message .= $businessUrl;

        $params = [
            'phone' => $phone,
            'text' => $message,
        ];

        return $this->buildSendEndpoint($params);
    }
}









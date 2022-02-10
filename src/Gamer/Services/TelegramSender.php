<?php

namespace Gamer\Services;

use Gamer\Exceptions\TelegramException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class TelegramSender
{
    public static function send($text)
    {
        $client = new Client();

        try {
            $client->post('https://api.telegram.org/bot{BOT_AUTH_TOKEN}/sendMessage',
              [
                RequestOptions::JSON => [
                  'chat_id' => 'your_id',
                  'text' => $text,
                ],

              ]);
        } catch (\Exception $e) {
            throw new TelegramException('Ошибка при отправке сообщения: ' . $e->getMessage());
        }
    }
}
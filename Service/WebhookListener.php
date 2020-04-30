<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Update;

class WebhookListener
{

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function listen():void {
        if ($data = BotApi::jsonValidate($this->client->getRawBody(), true)) {
            $update = Update::fromResponse($data);
            $this->client->handle([$update]);
        }
    }

}
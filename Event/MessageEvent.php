<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use TelegramBot\Api\Types\Message;

class MessageEvent extends Event
{

    const NAME = 'telegram.update.message';
    /**
     * @var Message
     */
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }


}

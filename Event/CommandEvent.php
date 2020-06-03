<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use TelegramBot\Api\Types\Message;

class CommandEvent extends Event
{

    const NAME = 'telegram.update.command';
    const START = 'telegram.update.command.start';
    const MENU = 'telegram.update.command.settings';
    const CHECK = 'telegram.update.command.check';

    /**
     * @var Message
     */
    private $message;
    /**
     * @var string
     */
    private $name;

    public function __construct(Message $message, string $name)
    {
        $this->message = $message;
        $this->name = $name;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}

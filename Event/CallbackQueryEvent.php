<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Event;


use TelegramBot\Api\Types\CallbackQuery;

class CallbackQueryEvent
{
    const NAME = 'telegram.update.callbackQuery';

    /**
     * @var CallbackQuery
     */
    private $callbackQuery;

    public function __construct(CallbackQuery $callbackQuery)
    {
        $this->callbackQuery = $callbackQuery;
    }

    /**
     * @return CallbackQuery
     */
    public function getCallbackQuery(): CallbackQuery
    {
        return $this->callbackQuery;
    }

}

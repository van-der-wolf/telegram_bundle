<?php
declare(strict_types=1);

namespace App\Services\Telegram;

use App\Entity\Telegram\Update;
use App\Event\Telegram\CallbackQueryEvent;
use App\Event\Telegram\CommandEvent;
use App\Event\Telegram\MessageEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\CallbackQuery;
use TelegramBot\Api\Types\Message;
use VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\UpdateRepository;

class UpdateProcessor
{

    private EventDispatcherInterface $dispatcher;
    private \TelegramBot\Api\Client $client;
    private UpdateRepository $updateRepository;
    private UpdateSaver $updateSaver;

    public function __construct(EventDispatcherInterface $dispatcher, Client $client, UpdateSaver $updateSaver, UpdateRepository $updateRepository)
    {
        $this->dispatcher = $dispatcher;
        $this->client = $client;
        $this->updateRepository = $updateRepository;
        $this->updateSaver = $updateSaver;
    }

    public function process() {
        $localUpdates = $this->updateRepository->getLastUpdate();
        if ($localUpdates instanceof Update) {
            $updateId = $localUpdates->getUpdateId() + 1;
        } else {
            $updateId = null;
        }
        $uppdates = $this->client->getUpdates($updateId);
        $that = $this;
        $this->client->command('start', function (Message $message) use ($that) {
            $that->dispatcher->dispatch(new CommandEvent($message, 'start'), CommandEvent::START);
        });
        $this->client->command('add_collection', function (Message $message) use ($that) {
            $that->dispatcher->dispatch(new CommandEvent($message, 'add_collection'), CommandEvent::NAME);
        });
        $this->client->command('menu', function (Message $message) use ($that) {
            $that->dispatcher->dispatch(new CommandEvent($message, 'menu'), CommandEvent::MENU);
        });
        $this->client->callbackQuery(function (CallbackQuery $query) {
            $this->dispatcher->dispatch(new CallbackQueryEvent($query), CallbackQueryEvent::NAME);
        });
        $this->client->message(function (Message $message) use ($that) {
            $that->dispatcher->dispatch(new MessageEvent($message), MessageEvent::NAME);
        });
        foreach ($uppdates as $update) {
            $this->updateSaver->save($update);
        }

        $this->client->handle($uppdates);
    }

}

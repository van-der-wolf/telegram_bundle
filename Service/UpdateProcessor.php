<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use TelegramBot\Api\Client;
use VanDerWolf\Bundle\TelegramBundle\Entity\Update;
use VanDerWolf\Bundle\TelegramBundle\Repository\UpdateRepository;

class UpdateProcessor
{

    private EventDispatcherInterface $dispatcher;
    private Client $client;
    private UpdateRepository $updateRepository;
    private UpdateSaver $updateSaver;

    public function __construct(EventDispatcherInterface $dispatcher, Client $client, UpdateSaver $updateSaver, UpdateRepository $updateRepository)
    {
        $this->dispatcher       = $dispatcher;
        $this->client           = $client;
        $this->updateRepository = $updateRepository;
        $this->updateSaver      = $updateSaver;
    }

    public function process()
    {
        $localUpdates = $this->updateRepository->getLastUpdate();
        if ($localUpdates instanceof Update) {
            $updateId = $localUpdates->getUpdateId() + 1;
        } else {
            $updateId = null;
        }
        $uppdates = $this->client->getUpdates($updateId);
        $that     = $this;
        foreach ($uppdates as $update) {
            $this->updateSaver->save($update);
        }

        $this->client->handle($uppdates);
    }

}

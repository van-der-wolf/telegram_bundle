<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Repository\ChatRepository;
use TelegramBot\Api\Types\Chat as TgChat;

class ChatSaver
{

    /**
     * @var ChatRepository
     */
    private $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function save(TgChat $tgChat): ?Chat
    {
        // TODO: probably I have to update data
        if ($chat = $this->chatRepository->findByChatId($tgChat->getId())) {
            return $chat;
        }
        $chat = new Chat($tgChat->getId(), $tgChat->getType(), (string)$tgChat->getTitle());

        // TODO: finish data mapping
        return $this->chatRepository->save($chat);
    }

}

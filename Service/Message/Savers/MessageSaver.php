<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers;

use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;
use VanDerWolf\Bundle\TelegramBundle\Repository\UserRepository;
use VanDerWolf\Bundle\TelegramBundle\Service\ChatSaver;
use VanDerWolf\Bundle\TelegramBundle\Service\Users\UserCreator;
use TelegramBot\Api\Types\Document;
use TelegramBot\Api\Types\Message as TgMessage;

class MessageSaver
{

    /**
     * @var ChatSaver
     */
    private $chatSaver;
    /**
     * @var TextMessageSaver
     */
    private $textMessageSaver;
    /**
     * @var PhotoMessageSaver
     */
    private $photoMessageSaver;
    /**
     * @var DocumentMessageSaver
     */
    private $documentMessageSaver;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserCreator
     */
    private $userCreator;

    public function __construct(
        TextMessageSaver $textMessageSaver,
        PhotoMessageSaver $photoMessageSaver,
        DocumentMessageSaver $documentMessageSaver,
        ChatSaver $chatSaver,
        UserRepository $userRepository,
        UserCreator $userCreator
    )
    {
        $this->chatSaver = $chatSaver;
        $this->textMessageSaver = $textMessageSaver;
        $this->photoMessageSaver = $photoMessageSaver;
        $this->documentMessageSaver = $documentMessageSaver;
        $this->userRepository = $userRepository;
        $this->userCreator = $userCreator;
    }

    public function save(TgMessage $tgMessage): ?TelegramMessage
    {
        $user = $this->userCreator->create($tgMessage->getFrom());
        $chat = $this->chatSaver->save($tgMessage->getChat());
        if ($tgMessage->getText()) {
            return $this->textMessageSaver->save($tgMessage, $user, $chat);
        }
        if ($tgMessage->getPhoto()) {
            return $this->photoMessageSaver->save($tgMessage, $user, $chat);
        }
        if ($tgMessage->getDocument() instanceof Document) {
            return $this->documentMessageSaver->save($tgMessage, $user, $chat);
        }
        return null;
    }

}

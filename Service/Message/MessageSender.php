<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Message;


use VanDerWolf\Bundle\TelegramBundle\Entity\Message\TelegramMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\TextTelegramMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\User as TelegramUser;
use VanDerWolf\Bundle\TelegramBundle\Repository\ChatRepository;
use VanDerWolf\Bundle\TelegramBundle\Repository\Message\MessageRepository;
use VanDerWolf\Bundle\TelegramBundle\Service\Users\UserCreator;
use DateTime;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\User;

class MessageSender
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var ChatRepository
     */
    private $chatRepository;
    /**
     * @var UserCreator
     */
    private $creator;

    public function __construct(
        Client $client,
        MessageRepository $messageRepository,
        ChatRepository $chatRepository,
        UserCreator $creator
    )
    {
        $this->client            = $client;
        $this->messageRepository = $messageRepository;
        $this->chatRepository    = $chatRepository;
        $this->creator           = $creator;
    }

    public function send(TelegramUser $user, TelegramMessage $message): TelegramMessage
    {
        if ($message instanceof TextTelegramMessage) {
            $response = $this->client->sendMessage(
                $user->getTelegramId(),
                $message->getText(),
                null,
                false,
                null,
                $message->getKeyboard()
            );
            $message->setMessageId($response->getMessageId())
                ->setUser($this->getBotUser($response->getFrom()))
                ->setChat($this->chatRepository->findByChatId($response->getChat()->getId()))
                ->setDate((new DateTime())->setTimestamp($response->getDate()));
            $this->messageRepository->save($message);
        }

        return $message;
    }

    // TODO: implement this method
    public function editMessageText(TelegramMessage $originalMessage, TextTelegramMessage $newMessage): Message {
        return $this->client->editMessageText(
            $originalMessage->getChat()->getChatId(),
            $originalMessage->getMessageId(),
            $newMessage->getText(),
            null,
            false,
            $newMessage->getKeyboard()
        );
    }

    private function getBotUser(User $user): ?TelegramUser
    {
        return $this->creator->create($user);
    }

}

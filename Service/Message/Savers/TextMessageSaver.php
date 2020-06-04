<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers;

use DateTime;
use TelegramBot\Api\Types\Message as TgMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\TextMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use VanDerWolf\Bundle\TelegramBundle\Repository\Message\TextMessageRepository;

class TextMessageSaver
{

    /**
     * @var TextMessageRepository
     */
    private $textMessageRepository;

    public function __construct(TextMessageRepository $textMessageRepository)
    {
        $this->textMessageRepository = $textMessageRepository;
    }

    public function save(TgMessage $tgMessage, User $user, Chat $chat = null): ?Message
    {
        $message = new TextMessage();
        $message->setMessageId($tgMessage->getMessageId())
            ->setUser($user)
            ->setDate((new DateTime())->setTimestamp($tgMessage->getDate()));
        if ($chat instanceof Chat) {
            $message->setChat($chat);
        }
        $message->setText($tgMessage->getText())
            // TODO: this is not a message I look for
            //->setForwardFrom($tgMessage->getForwardFrom())
            ->setMessageId($tgMessage->getMessageId())
            ->setDate((new DateTime())->setTimestamp($tgMessage->getDate()));
        return $this->textMessageRepository->save($message);
    }

}

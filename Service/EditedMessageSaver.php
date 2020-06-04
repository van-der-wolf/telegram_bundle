<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use TelegramBot\Api\Types\Message as TgMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\EditedMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use VanDerWolf\Bundle\TelegramBundle\Repository\Message\EditedMessageRepository;
use VanDerWolf\Bundle\TelegramBundle\Repository\UserRepository;
use VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers\MessageSaver;

class EditedMessageSaver
{

    /**
     * @var EditedMessageRepository
     */
    private $editedMessageRepository;
    /**
     * @var MessageSaver
     */
    private $messageSaver;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        EditedMessageRepository $editedMessageRepository,
        MessageSaver $messageSaver,
        UserRepository $userRepository
    )
    {
        $this->editedMessageRepository = $editedMessageRepository;
        $this->messageSaver = $messageSaver;
        $this->userRepository = $userRepository;
    }

    public function save(TgMessage $tgMessage): ?EditedMessage {
        $editedMessage = new EditedMessage();
        $message = $this->messageSaver->save($tgMessage);
        $editedMessage->setMessage($message)
            ->setCaption($tgMessage->getCaption())
            ->setEditDate((new \DateTime())->setTimestamp($tgMessage->getDate()))
            ->setText($tgMessage->getText())
            ->setUser($this->getUser($tgMessage));
        return $this->editedMessageRepository->save($editedMessage);
    }

    private function getUser(TgMessage $message): ?User {
        return $this->userRepository->findByTelegramId($message->getFrom()->getId());
    }

}

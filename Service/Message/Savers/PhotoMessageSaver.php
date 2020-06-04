<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers;

use VanDerWolf\Bundle\TelegramBundle\Entity\Photo;
use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\PhotoMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use VanDerWolf\Bundle\TelegramBundle\Repository\Message\PhotoMessageRepository;
use DateTime;
use TelegramBot\Api\Types\Message as TgMessage;
use TelegramBot\Api\Types\PhotoSize;

class PhotoMessageSaver
{

    /**
     * @var PhotoMessageRepository
     */
    private $messageRepository;

    public function __construct(PhotoMessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function save(TgMessage $tgMessage, User $user, $chat = null): ?Message
    {
        $message = new PhotoMessage();
        $message
            ->setCaption($tgMessage->getCaption())
            ->setMessageId($tgMessage->getMessageId())
            ->setUser($user)
            ->setDate((new DateTime())->setTimestamp($tgMessage->getDate()));
        if ($chat instanceof Chat) {
            $message->setChat($chat);
        }
        foreach ($tgMessage->getPhoto() as $item) {
            $message->addSize($this->createPhoto($item));
        }
        return $this->messageRepository->save($message);

    }

    public function createPhoto(PhotoSize $photoSize): Photo {
        $photo = new Photo();
        $photo->setFileId($photoSize->getFileId())
            ->setFileSize($photoSize->getFileSize())
            ->setHeight($photoSize->getHeight())
            ->setWidth($photoSize->getWidth());
        return $photo;
    }

}

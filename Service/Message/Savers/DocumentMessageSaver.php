<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers;

use DateTime;
use TelegramBot\Api\Types\Document;
use TelegramBot\Api\Types\PhotoSize;
use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Entity\File;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\DocumentMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;
use VanDerWolf\Bundle\TelegramBundle\Entity\Photo;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\DocumentMessageRepository;
use TelegramBot\Api\Types\Message as TgMessage;

class DocumentMessageSaver
{
    /**
     * @var DocumentMessageRepository
     */
    private $documentMessageRepository;

    public function __construct(DocumentMessageRepository $documentMessageRepository)
    {
        $this->documentMessageRepository = $documentMessageRepository;
    }

    public function save(TgMessage $tgMessage, User $user, Chat $chat = null): ?Message
    {
        $message = new DocumentMessage();
        if ($chat instanceof Chat) {
            $message->setChat($chat);
        }
        $message
            ->setDocument($this->createDocument($tgMessage->getDocument()))
            ->setMessageId($tgMessage->getMessageId())
            ->setUser($user)
            ->setDate((new DateTime())->setTimestamp($tgMessage->getDate()));
        $this->documentMessageRepository->save($message);
        return $message;
    }

    public function createDocument(Document $document): File
    {
        $file = new File();
        $file->setFileId($document->getFileId())
            ->setFileSize($document->getFileSize())
            ->setFileName($document->getFileName())
            ->setMimeType($document->getMimeType());
        if ($document->getThumb() instanceof PhotoSize) {
            $file->setThumb($this->createThumb($document->getThumb()));
        }
        return $file;
    }

    public function createThumb(PhotoSize $photoSize): Photo
    {
        return (new Photo())
            ->setFileId($photoSize->getFileId())
            ->setFileSize($photoSize->getFileSize())
            ->setWidth($photoSize->getWidth())
            ->setHeight($photoSize->getHeight());
    }
}

<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\TextMessageRepository")
 */
class TextMessage extends Message
{
    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $text = '';

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return TextMessage
     */
    public function setText(string $text): TextMessage
    {
        $this->text = $text;
        return $this;
    }

    public static function create(\TelegramBot\Api\Types\Message $tgMessage): self {
        $message = new TextMessage();
        $message->messageId = $tgMessage->getMessageId();
        $message->setMessageId($tgMessage->getMessageId())
            ->setUser($user)
            ->setDate((new DateTime())->setTimestamp($tgMessage->getDate()));
    }
}

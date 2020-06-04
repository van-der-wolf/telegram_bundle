<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use TelegramBot\Api\Types\Message as TgMessage;

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

    public static function create(TgMessage $tgMessage): Message
    {
        $message = new TextMessage();
        $message->messageId = $tgMessage->getMessageId();
        $message->date = (new DateTime())->setTimestamp($tgMessage->getDate());
        $message->text = $tgMessage->getText();
        return $message;
    }
}

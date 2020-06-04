<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use TelegramBot\Api\Types\Message as TgMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\TelegramKeyboard;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\MessageRepository")
 * @ORM\Table(name="telegram_message")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "text" = "VanDerWolf\Bundle\TelegramBundle\Entity\Message\TextMessage",
 *     "photo" = "VanDerWolf\Bundle\TelegramBundle\Entity\Message\PhotoMessage",
 *     "document" = "VanDerWolf\Bundle\TelegramBundle\Entity\Message\DocumentMessage"})
 */
abstract class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(name="from")
     */
    protected User $from;

    /**
     * @ORM\Column(type="bigint", name="message_id")
     */
    protected int $messageId;

    /**
     * @ORM\Column(type="datetime", name="date")
     */
    protected DateTimeInterface $date;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Chat")
     * @ORM\JoinColumn(name="chat", referencedColumnName="id", nullable=false)
     */
    protected Chat $chat;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(name="forward_from", referencedColumnName="id", nullable=true)
     */
    protected ?User $forwardFrom = null;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Chat")
     * @ORM\JoinColumn(name="forward_from_chat", referencedColumnName="id", nullable=true)
     */
    protected ?Chat $forwardFromChat = null;

    /**
     * @ORM\Column(type="integer", name="forward_from_message_id", nullable=true)
     */
    protected ?int $forwardFromMessageId = null;

    /**
     * @ORM\Column(type="string", length=255, name="forward_signature", nullable=true)
     */
    private ?string $forwardSignature = null;
    /**
     * @ORM\Column(type="string", length=255, name="forward_sender_name", nullable=true)
     */
    private ?string $forwardSenderName = null;
    /**
     * @ORM\Column(type="integer", name="forward_date", nullable=true)
     */
    private ?int $forwardDate = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\TelegramKeyboard", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="keyboard", referencedColumnName="id")
     */
    protected ?TelegramKeyboard $keyboard = null;

    public static function create(TgMessage $tgMessage): Message
    {
        switch (true) {
            case !empty($tgMessage->getText()):
                return TextMessage::createMessage($tgMessage);
            case !empty($tgMessage->getPhoto()):
                return PhotoMessage::createMessage($tgMessage);
            case !empty($tgMessage->getDocument()):
                return DocumentMessage::createMessage($tgMessage);
        }
        throw new Exception('Failed to identify message type');
    }

    protected abstract static function createMessage(TgMessage $message): Message;

    public function getId()
    {
        return $this->id;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): self
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessageId(): ?int
    {
        return (int)$this->messageId;
    }

    public function setMessageId(int $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Message
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getForwardFrom(): ?int
    {
        return $this->forwardFrom;
    }

    public function setForwardFrom(?int $forwardFrom): self
    {
        $this->forwardFrom = $forwardFrom;

        return $this;
    }

    public function getForwardFromChat(): ?int
    {
        return $this->forwardFromChat;
    }

    public function setForwardFromChat(?int $forwardFromChat): self
    {
        $this->forwardFromChat = $forwardFromChat;

        return $this;
    }

    public function getKeyboard()
    {
        if ($this->keyboard instanceof TelegramKeyboard) {
            return $this->keyboard->getKeyBoard();
        }

        return null;
    }

    /**
     * @param TelegramKeyboard $keyboard
     * @return Message
     */
    public function setKeyboard(TelegramKeyboard $keyboard): Message
    {
        $this->keyboard = $keyboard;

        return $this;
    }


}

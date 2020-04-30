<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\TelegramKeyboard;
use VanDerWolf\Bundle\TelegramBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\MessageRepository")
 * @ORM\Table(name="telegram_message")
 * @ORM\InheritanceType("SINGLE_TABLE")
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
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Chat")
     * @ORM\JoinColumn(nullable=false)
     */
    private Chat $chat;

    /**
     * @ORM\Column(type="bigint")
     */
    private int $messageId;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $date;

    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\TelegramKeyboard", cascade={"persist", "remove"})
     */
    private ?TelegramKeyboard $keyboard = null;

    public static function create(\TelegramBot\Api\Types\Message $tgMessage): Message
    {

    }

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
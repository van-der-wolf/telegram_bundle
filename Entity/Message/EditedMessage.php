<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_edited_message")
 */
class EditedMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     */
    private ?User $user = null;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message")
     * @ORM\JoinColumn(nullable=false)
     */
    private Message $message;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $editDate = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $text = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $entities = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $caption = null;

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getEditDate(): ?DateTimeInterface
    {
        return $this->editDate;
    }

    public function setEditDate(?DateTimeInterface $editDate): self
    {
        $this->editDate = $editDate;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text = null): self
    {
        $this->text = $text;

        return $this;
    }

    public function getEntities(): ?string
    {
        return $this->entities;
    }

    public function setEntities(string $entities): self
    {
        $this->entities = $entities;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption = null): self
    {
        $this->caption = $caption;

        return $this;
    }
}

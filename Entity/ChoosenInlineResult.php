<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_choosen_inline_query")
 */
class ChoosenInlineResult
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $resultId;

    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?User $user = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $location = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $inlineMessageId = null;

    /**
     * @ORM\Column(type="text")
     */
    private string $query;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $createAt = null;

    public function getId()
    {
        return $this->id;
    }

    public function getResultId(): ?string
    {
        return $this->resultId;
    }

    public function setResultId(string $resultId): self
    {
        $this->resultId = $resultId;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getInlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $inlineMessageId): self
    {
        $this->inlineMessageId = $inlineMessageId;

        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getCreateAt(): ?DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(?DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }
}

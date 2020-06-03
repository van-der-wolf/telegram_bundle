<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use DateTimeInterface;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_callback_query")
 */
class CallbackQuery
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $inlineMessageId = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $data;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $createAt = null;
}

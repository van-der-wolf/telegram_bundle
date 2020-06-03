<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\ChatRepository")
 * @ORM\Table(name="telegram_chat")
 */
class Chat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="bigint", name="chat_id")
     */
    private int $chatId;
    /**
     * @ORM\Column(type="string", length=50, name="type")
     */
    private string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="title", nullable=true)
     */
    private ?string $title = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="username", nullable=true)
     */
    private ?string $username = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="first_name", nullable=true)
     */
    private ?string $firstName = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="last_name", nullable=true)
     */
    private ?string $lastName = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\ChatPermissions", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="chat_photo", referencedColumnName="id", nullable=true)
     */
    private ?ChatPhoto $chatPhoto = null;
    /**
     * @ORM\Column(type="text", name="description", nullable=true)
     */
    private ?string $description = null;
    /**
     * @ORM\Column(type="string", length=1024, name="invite_link", nullable=true)
     */
    private ?string $inviteLink = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message")
     * @ORM\JoinColumn(name="pinned_message", referencedColumnName="id", nullable=true)
     */
    private ?Message $pinnedMessage = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\ChatPermissions", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="permissions_id", referencedColumnName="id", nullable=true)
     */
    private ?ChatPermissions $permissions = null;
    /**
     * @ORM\Column(type="integer", name="slow_mode_delay", nullable=true)
     */
    private ?int $slowModeDelay = null;
    /**
     * @ORM\Column(type="string", length=1024, name="sticker_set_name", nullable=true)
     */
    private ?string $stickerSetName = null;
    /**
     * @ORM\Column(type="boolean", name="can_set_sticker_set", nullable=true)
     */
    private ?bool $canSetStickerSet = null;


    public function __construct(int $chatId, string $type)
    {
        $this->chatId = $chatId;
        $this->type = $type;
    }
}

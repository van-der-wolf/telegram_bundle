<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_user")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="integer", name="user_id")
     */
    private int $userId;
    /**
     * @ORM\Column(type="boolean", name="is_bot")
     */
    private bool $isBot;
    /**
     * @ORM\Column(type="string", name="first_name")
     */
    private string $firstName;
    /**
     * @ORM\Column(type="string", name="last_name", nullable=true)
     */
    private ?string $lastName = null;
    /**
     * @ORM\Column(type="string", name="username", nullable=true)
     */
    private ?string $username = null;
    /**
     * @ORM\Column(type="string", length=10, name="language_code", nullable=true)
     */
    private ?string $languageCode = null;
    /**
     * @ORM\Column(type="boolean", name="can_join_groups", nullable=true)
     */
    private ?bool $canJoinGroups = null;
    /**
     * @ORM\Column(type="boolean", name="can_read_all_group_messages", nullable=true)
     */
    private ?bool $canReadAllGroupMessages = null;
    /**
     * @ORM\Column(type="boolean", name="supports_inline_queries", nullable=true)
     */
    private ?bool $supportsInlineQueries = null;
}
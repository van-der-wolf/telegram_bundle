<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_message_entity")
 */
class MessageEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=100, name="type")
     */
    private string $type;
    /**
     * @ORM\Column(type="integer", name="offset")
     */
    private int $offset;
    /**
     * @ORM\Column(type="integer", name="length")
     */
    private int $length;
    /**
     * @ORM\Column(type="string", nullable=1024, name="url", nullable=true)
     */
    private ?string $url;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=true)
     */
    private ?User $user;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Poll")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id", nullable=false)
     */
    private Poll $poll;
    /**
     * @ORM\Column(type="string", length=10, name="language")
     */
    private string $language;
}
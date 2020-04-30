<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_poll_answer")
 */
class PollAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255, name="poll_id")
     */
    private string $pollId;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private User $user;
    /**
     * @ORM\Column(type="array", name="option_ids")
     */
    private array $optionIds = [];
}
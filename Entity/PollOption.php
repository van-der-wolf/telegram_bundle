<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_poll_options")
 */
class PollOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=100, name="text")
     */
    private string $text;
    /**
     * @ORM\Column(type="integer", name="voter_count")
     */
    private int $voterCount;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Poll")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id", nullable=false)
     */
    private Poll $poll;
}
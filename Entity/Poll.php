<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_poll")
 */
class Poll
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="integer", name="poll_id")
     */
    private int $pollId;
    /**
     * @ORM\Column(type="integer", name="question")
     */
    private string $question;
    /**
     * @ORM\OneToMany(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\PollOption", mappedBy="poll_id")
     */
    private Collection $options;
    /**
     * @ORM\Column(type="integer", name="total_voter_count")
     */
    private int $totalVoterCount;
    /**
     * @ORM\Column(type="boolean", name="is_closed")
     */
    private bool $isClosed;
    /**
     * @ORM\Column(type="boolean", name="is_anonymous")
     */
    private bool $isAnonymous;
    /**
     * @ORM\Column(type="string", length=255, name="type")
     */
    private string $type;
    /**
     * @ORM\Column(type="boolean", name="allows_multiple_answers")
     */
    private bool $allowsMultipleAnswers;
    /**
     * @ORM\Column(type="boolean", name="correct_option_id", nullable=true)
     */
    private ?bool $correctOptionId;
    /**
     * @ORM\Column(type="string", name="explanation", nullable=true)
     */
    private ?string $explanation;
    /**
     * @ORM\OneToMany(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\MessageEntity", mappedBy="poll_id")
     */
    private Collection $explanationEntities;
    /**
     * @ORM\Column(type="integer", name="open_period", nullable=true)
     */
    private ?int $openPeriod;
    /**
     * @ORM\Column(type="integer", name="close_date", nullable=true)
     */
    private ?int $closeDate;
}
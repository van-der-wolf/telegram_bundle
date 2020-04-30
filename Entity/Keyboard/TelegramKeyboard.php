<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_keyboard")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "inline" = "VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\InlineTelegramKeyboard",
 *     "reply" = "VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard\ReplyTelegramKeyboard"
 * })
 */
abstract class TelegramKeyboard
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="array", nullable=false)
     */
    protected array $keyBoard;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    abstract public function getKeyBoard();

}

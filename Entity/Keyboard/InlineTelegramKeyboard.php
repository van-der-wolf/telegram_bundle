<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard;

use Doctrine\ORM\Mapping as ORM;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

/**
 * @ORM\Entity()
 */
class InlineTelegramKeyboard extends TelegramKeyboard
{

    /**
     * @var InlineKeyboardMarkup
     */
    private $inlineKeyboard;

    public function __construct(array $keyboard)
    {
        $this->keyBoard       = $keyboard;
        $this->inlineKeyboard = new InlineKeyboardMarkup($keyboard);
    }

    /*public function addRow(InlineKeyboardRow $inlineKeyboardRow): InlineTelegramKeyboard {

    }*/

    public function getKeyBoard(): InlineKeyboardMarkup
    {
        if ($this->inlineKeyboard instanceof InlineKeyboardMarkup) {
            return $this->inlineKeyboard;
        }

        return $this->initKeyboard()->inlineKeyboard;
    }

    private function initKeyboard(): self
    {
        $this->inlineKeyboard = new InlineKeyboardMarkup($this->keyBoard);

        return $this;
    }

}

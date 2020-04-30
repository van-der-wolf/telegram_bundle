<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Keyboard;

use Doctrine\ORM\Mapping as ORM;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

/**
 * @ORM\Entity()
 */
class ReplyTelegramKeyboard extends TelegramKeyboard
{

    /**
     * @var ReplyKeyboardMarkup
     */
    private $replyKeyboard;

    public function __construct()
    {
        $this->keyboard = new ReplyKeyboardMarkup([['test' => 'test']]);
    }

    public function getKeyBoard()
    {
        // TODO: Implement getKeyBoard() method.
    }

}

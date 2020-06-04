<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TelegramBot\Api\Types\Update as TgUpdate;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\EditedMessage;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\UpdateRepository")
 * @ORM\Table(name="telegram_updates", uniqueConstraints={@ORM\UniqueConstraint(name="update", columns={"update_id"})})
 */
class Update
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="bigint", name="update_id")
     */
    private int $updateId = 0;
    /**
     * @var int
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="chat_id", referencedColumnName="id", nullable=true)
     */
    private User $chat;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message", cascade={"persist", "remove"})
     */
    private ?Message $message = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\EditedMessage", cascade={"persist", "remove"})
     */
    private ?EditedMessage $editedMessage = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message", cascade={"persist", "remove"})
     */
    private ?Message $channelPost = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Message\Message", cascade={"persist", "remove"})
     */
    private ?Message $editedChannelPost = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\InlineQuery", cascade={"persist", "remove"})
     */
    private ?InlineQuery $inlineQuery = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\ChoosenInlineResult", cascade={"persist", "remove"})
     */
    private ?ChoosenInlineResult $choosenInlineResult = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\CallbackQuery", cascade={"persist", "remove"})
     */
    private ?CallbackQuery $calbackQuery = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\ShippingQuery", cascade={"persist", "remove"})
     */
    private ?CallbackQuery $shippingQuery = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\PreCheckoutQuery", cascade={"persist", "remove"})
     */
    private ?Message $preCheckoutQuery = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Poll", cascade={"persist", "remove"})
     */
    private ?Poll $poll = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\PollAnswer", cascade={"persist", "remove"})
     */
    private ?PollAnswer $pollAnswer = null;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    private function getUpdateId(): int
    {
        // TODO: investigate why thefuck here is a string instead of int
        return (int)$this->updateId;
    }

    private function setUpdateId(int $updateId)
    {
        $this->updateId = $updateId;

        return $this;
    }

    public function getChat(): User
    {
        return $this->chat;
    }

    public function setChat(User $chat)
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function setMessage(Message $message)
    {
        $this->message = $message;

        return $this;
    }

    public function getInlineQuery(): InlineQuery
    {
        return $this->inlineQuery;
    }

    public function setInlineQuery(InlineQuery $inlineQuery)
    {
        $this->inlineQuery = $inlineQuery;

        return $this;
    }

    /**
     * @return ChoosenInlineResult
     */
    public function getChoosenInlineResult(): ChoosenInlineResult
    {
        return $this->choosenInlineResult;
    }

    public function setChoosenInlineResult(ChoosenInlineResult $choosenInlineResult)
    {
        $this->choosenInlineResult = $choosenInlineResult;

        return $this;
    }

    /**
     * @return CallbackQuery
     */
    public function getCalbackQuery(): CallbackQuery
    {
        return $this->calbackQuery;
    }

    public function setCalbackQuery(CallbackQuery $calbackQuery): Update
    {
        $this->calbackQuery = $calbackQuery;

        return $this;
    }

    public function isCallbackQuery(): bool
    {
        return $this->calbackQuery instanceof CallbackQuery;
    }

    /**
     * @return EditedMessage
     */
    public function getEditedMessage(): EditedMessage
    {
        return $this->editedMessage;
    }

    public function setEditedMessage(EditedMessage $editedMessage)
    {
        $this->editedMessage = $editedMessage;

        return $this;
    }

    public static function create(TgUpdate $tgUpdate): self {
        $update = new Update;
        /*
         * 'update_id' => true,
        'message' => Message::class,
        'edited_message' => Message::class,
        'channel_post' => Message::class,
        'edited_channel_post' => Message::class,
        'inline_query' => InlineQuery::class,
        'chosen_inline_result' => ChosenInlineResult::class,
        'callback_query' => CallbackQuery::class,
        'shipping_query' => ShippingQuery::class,
        'pre_checkout_query' => PreCheckoutQuery::class,
         */
        $update->updateId = $tgUpdate->getUpdateId();
        if (!empty($tgUpdate->getMessage())) {
            $update->message = Message::create()
        }
    }

}

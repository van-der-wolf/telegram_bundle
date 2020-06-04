<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use VanDerWolf\Bundle\TelegramBundle\Entity\Update;
use VanDerWolf\Bundle\TelegramBundle\Repository\UpdateRepository;
use VanDerWolf\Bundle\TelegramBundle\Service\Message\Savers\MessageSaver;
use TelegramBot\Api\Types\Update as TgUpdate;

class UpdateSaver
{
    /**
     * @var UpdateRepository
     */
    private $updateRepository;
    /**
     * @var MessageSaver
     */
    private $messageSaver;
    /**
     * @var EditedMessageSaver
     */
    private $editedMessageSaver;
    /**
     * @var InlineQuerySaver
     */
    private $inlineQuerySaver;
    /**
     * @var ChoosenInlineSaver
     */
    private $choosenInlineSaver;

    public function __construct(
        UpdateRepository $updateRepository,
        MessageSaver $messageSaver,
        EditedMessageSaver $editedMessageSaver,
        InlineQuerySaver $inlineQuerySaver,
        ChoosenInlineSaver $choosenInlineSaver
    )
    {
        $this->updateRepository = $updateRepository;
        $this->messageSaver = $messageSaver;
        $this->editedMessageSaver = $editedMessageSaver;
        $this->inlineQuerySaver = $inlineQuerySaver;
        $this->choosenInlineSaver = $choosenInlineSaver;
    }

    public function save(TgUpdate $tgUpdate): Update
    {
        if ($update = $this->updateRepository->findByUpdateId($tgUpdate->getUpdateId())) {
            return $update;
        }
        $update = new Update;
        $update->setUpdateId($tgUpdate->getUpdateId());
        if ($tgUpdate->getMessage()) {
            $message = $this->messageSaver->save($tgUpdate->getMessage());
            $update->setMessage($message);
        }
        if ($tgUpdate->getEditedMessage()) {
            $message = $this->editedMessageSaver->save($tgUpdate->getEditedMessage());
            $update->setEditedMessage($message);
        }
        if ($tgUpdate->getInlineQuery()) {
            $inlineQuery = $this->inlineQuerySaver->save($tgUpdate->getInlineQuery());
            $update->setInlineQuery($inlineQuery);
        }
        if ($tgUpdate->getChosenInlineResult()) {
            $result = $this->choosenInlineSaver->save($tgUpdate->getChosenInlineResult());
            $update->setChoosenInlineResult($result);
        }
        if ($tgUpdate->getCallbackQuery()) {

        }
        $this->updateRepository->save($update);

        return $update;
    }

}

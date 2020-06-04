<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;


use VanDerWolf\Bundle\TelegramBundle\Entity\ChoosenInlineResult;
use VanDerWolf\Bundle\TelegramBundle\Repository\ChoosenInlineResultRepository;
use TelegramBot\Api\Types\Inline\ChosenInlineResult as TgChoosenInlineResult;

class ChoosenInlineSaver
{

    private ChoosenInlineResultRepository $choosenInlineResultRepository;

    public function __construct(ChoosenInlineResultRepository $choosenInlineResultRepository)
    {
        $this->choosenInlineResultRepository = $choosenInlineResultRepository;
    }

    public function save(TgChoosenInlineResult $chosenInlineResult): ChoosenInlineResult {
        $result = new ChoosenInlineResult();
        // TODO: map data
        return $this->choosenInlineResultRepository->save($result);
    }

}

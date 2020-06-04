<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service;

use VanDerWolf\Bundle\TelegramBundle\Entity\InlineQuery;
use VanDerWolf\Bundle\TelegramBundle\Repository\InlineQueryRepository;
use TelegramBot\Api\Types\Inline\InlineQuery as TgInlineQuery;

class InlineQuerySaver
{

    /**
     * @var InlineQueryRepository
     */
    private $inlineQueryRepository;

    public function __construct(InlineQueryRepository $inlineQueryRepository)
    {
        $this->inlineQueryRepository = $inlineQueryRepository;
    }

    public function save(TgInlineQuery $tgInlineQuery): ?InlineQuery {
        $query = new InlineQuery();
        $query->setLocation($tgInlineQuery->getLocation()->toJson())
            ->setQuery($tgInlineQuery->getQuery())
            ->setOffset($tgInlineQuery->getOffset())
            ->setCreatedAt(new \DateTime());
        return $this->inlineQueryRepository->save($query);
    }

}

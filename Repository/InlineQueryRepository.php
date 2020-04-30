<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram;

use Exception;
use VanDerWolf\Bundle\TelegramBundle\Entity\InlineQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InlineQuery|null find($id, $lockMode = null, $lockVersion = null)
 * @method InlineQuery|null findOneBy(array $criteria, array $orderBy = null)
 * @method InlineQuery[]    findAll()
 * @method InlineQuery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InlineQueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InlineQuery::class);
    }

    public function save(InlineQuery $inlineQuery): ?InlineQuery
    {
        try {
            $this->_em->persist($inlineQuery);
            $this->_em->flush($inlineQuery);

            return $inlineQuery;
        } catch (Exception $exception) {
            return null;
        }
    }
}

<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram;

use Exception;
use VanDerWolf\Bundle\TelegramBundle\Entity\ChoosenInlineResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChoosenInlineResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoosenInlineResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoosenInlineResult[]    findAll()
 * @method ChoosenInlineResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoosenInlineResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChoosenInlineResult::class);
    }

    public function save(ChoosenInlineResult $choosenInlineResult): ?ChoosenInlineResult
    {
        try {
            $this->_em->persist($choosenInlineResult);
            $this->_em->flush($choosenInlineResult);

            return $choosenInlineResult;
        } catch (Exception $exception) {
            return null;
        }
    }
}

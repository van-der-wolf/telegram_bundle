<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository;

use Exception;
use VanDerWolf\Bundle\TelegramBundle\Entity\Update;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Update|null find($id, $lockMode = null, $lockVersion = null)
 * @method Update|null findOneBy(array $criteria, array $orderBy = null)
 * @method Update[]    findAll()
 * @method Update[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateRepository extends ServiceEntityRepository
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Update::class);
        $this->logger = $logger;
    }

    public function save(Update $update): ?Update
    {
        try {
            $this->_em->persist($update);
            $this->_em->flush($update);

            return $update;
        } catch (Exception $exception) {
            $this->logger->error(sprintf('Update was not saved: %s', $exception->getMessage()));

            return null;
        }
    }

    public function findByUpdateId(int $updateId): ?Update
    {
        $update = $this->findOneBy([
            'updateId' => $updateId
        ]);

        return $update instanceof Update ? $update : null;
    }

    public function getLastUpdate(): ?Update
    {
        $update = $this->findOneBy([], ['id' => 'DESC']);

        return $update instanceof Update ? $update : null;
    }
}

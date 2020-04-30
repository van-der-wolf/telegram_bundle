<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message;

use VanDerWolf\Bundle\TelegramBundle\Entity\Message\PhotoMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoMessage[]    findAll()
 * @method PhotoMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoMessageRepository extends ServiceEntityRepository
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, PhotoMessage::class);
        $this->logger = $logger;
    }

    public function save(PhotoMessage $message): ?PhotoMessage
    {
        try {
            $this->_em->persist($message);
            $this->_em->flush($message);

            return $message;
        } catch (Exception $exception) {
            $this->logger->error(sprintf('Message was not saved: %s', $exception->getMessage()));

            return null;
        }
    }

}

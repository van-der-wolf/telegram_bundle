<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Message;

use VanDerWolf\Bundle\TelegramBundle\Entity\Message\DocumentMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentMessage[]    findAll()
 * @method DocumentMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentMessageRepository extends ServiceEntityRepository
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, DocumentMessage::class);
        $this->logger = $logger;
    }

    public function save(DocumentMessage $message): ?DocumentMessage
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

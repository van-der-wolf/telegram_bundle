<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message;

use VanDerWolf\Bundle\TelegramBundle\Entity\Message\TextMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextMessage[]    findAll()
 * @method TextMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextMessageRepository extends ServiceEntityRepository
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, TextMessage::class);
        $this->logger = $logger;
    }

    public function save(TextMessage $message): ?TextMessage
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

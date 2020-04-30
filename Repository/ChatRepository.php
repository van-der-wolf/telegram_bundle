<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram;

use VanDerWolf\Bundle\TelegramBundle\Entity\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chat[]    findAll()
 * @method Chat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatRepository extends ServiceEntityRepository
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Chat::class);
        $this->logger = $logger;
    }

    public function findByChatId(int $chatId): ?Chat
    {
        $chat = $this->findOneBy([
            'chatId' => $chatId
        ]);

        return $chat instanceof Chat ? $chat : null;
    }

    public function save(Chat $chat): ?Chat
    {
        try {
            $this->_em->persist($chat);
            $this->_em->flush($chat);

            return $chat;
        } catch (Exception $exception) {
            $this->logger->error(sprintf('Conversation was not saved: %s', $exception->getMessage()));

            return null;
        }
    }

}

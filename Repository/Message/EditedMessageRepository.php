<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message;

use Exception;
use VanDerWolf\Bundle\TelegramBundle\Entity\Message\EditedMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EditedMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method EditedMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method EditedMessage[]    findAll()
 * @method EditedMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditedMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EditedMessage::class);
    }

    public function save(EditedMessage $message): ?EditedMessage
    {
        try {
            $this->_em->persist($message);
            $this->_em->flush($message);

            return $message;
        } catch (Exception $exception) {
            return null;
        }
    }
}

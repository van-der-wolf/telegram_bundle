<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Users;

use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use VanDerWolf\Bundle\TelegramBundle\Repository\UserRepository;
use TelegramBot\Api\Types\User as TgUser;

class UserCreator
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(TgUser $chat): ?User {
        $user = $this->userRepository->findByTelegramId($chat->getId());
        if ($user instanceof User) {
            return $user;
        }
        $user = $this->getUser($chat);
        $user->setUsername((string) $chat->getUsername())
            ->setFirstName((string) $chat->getFirstName())
            ->setLastName((string) $chat->getLastName());
        if ($this->userRepository->save($user)) {
            return $user;
        }
        return null;
    }

    private function getUser(User $tgUser): User {
        $user = $this->userRepository->findByTelegramId($tgUser->getId());
        if ($user instanceof User) {
            return $user;
        }
        return new User($tgUser->getId());
    }

}

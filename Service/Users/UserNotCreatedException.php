<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Service\Users;


use VanDerWolf\Bundle\TelegramBundle\Entity\User;
use Throwable;

class UserNotCreatedException extends \Exception
{

    public function __construct(User $user, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('User was not saved: %s', $user->getUsername()), $code, $previous);
    }
}

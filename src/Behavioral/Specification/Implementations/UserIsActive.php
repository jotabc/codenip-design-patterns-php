<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Implementations;

use App\Behavioral\Specification\Interface\UserSpecification;
use App\Behavioral\Specification\Model\User;

class UserIsActive implements UserSpecification
{
    public function isSatisfiedBy(User $user): bool
    {
        return $user->isActive();
    }
}

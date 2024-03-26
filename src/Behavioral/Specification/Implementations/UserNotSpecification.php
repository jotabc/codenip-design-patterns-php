<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Implementations;

use App\Behavioral\Specification\Interface\UserSpecification;
use App\Behavioral\Specification\Model\User;

readonly class UserNotSpecification implements UserSpecification
{
    public function __construct(
        private UserSpecification $specification1,
    ) {}

    public function isSatisfiedBy(User $user): bool
    {
        return false === $this->specification1->isSatisfiedBy($user);
    }
}

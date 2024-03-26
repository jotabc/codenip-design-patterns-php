<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Implementations;

use App\Behavioral\Specification\Interface\UserSpecification;
use App\Behavioral\Specification\Model\User;

readonly class UserAndSpecification implements UserSpecification
{
    public function __construct(
        private UserSpecification $specification1,
        private UserSpecification $specification2,
    ) {}

    public function isSatisfiedBy(User $user): bool
    {
        return $this->specification1->isSatisfiedBy($user) && $this->specification2->isSatisfiedBy($user);
    }
}

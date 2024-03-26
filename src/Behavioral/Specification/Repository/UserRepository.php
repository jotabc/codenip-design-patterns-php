<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Repository;

use App\Behavioral\Specification\Interface\UserQuery;
use App\Behavioral\Specification\Interface\UserSpecification;
use App\Behavioral\Specification\Model\User;

use function array_filter;

class UserRepository implements UserQuery
{
    public function __construct(
        /** @var array<User> */
        private array $users,
    ) {}

    public function applySpecification(UserSpecification $specification): self
    {
        $this->users = array_filter($this->users, function (User $user) use ($specification) {
            return $specification->isSatisfiedBy($user);
        });

        return $this;
    }

    /**
     * @return array<User>
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

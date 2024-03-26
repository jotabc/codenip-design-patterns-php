<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Interface;

use App\Behavioral\Specification\Model\User;

interface UserSpecification
{
    public function isSatisfiedBy(User $user): bool;
}

<?php

declare(strict_types=1);

namespace App\Behavioral\Specification\Interface;

interface UserQuery
{
    public function applySpecification(UserSpecification $specification): self;
}

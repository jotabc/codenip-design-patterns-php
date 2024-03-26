<?php

declare(strict_types=1);

namespace App\Tests\Behavioral\Specification;

use App\Behavioral\Specification\Implementations\UserAgeGreaterThan18;
use App\Behavioral\Specification\Implementations\UserAndSpecification;
use App\Behavioral\Specification\Implementations\UserIsActive;
use App\Behavioral\Specification\Implementations\UserNotSpecification;
use App\Behavioral\Specification\Implementations\UserOrSpecification;
use App\Behavioral\Specification\Model\User;
use App\Behavioral\Specification\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    /**
     * @dataProvider specificationDataProvider
     */
    public function testAgreGreaterThan18(UserRepository $userRepo): void
    {
        $adultUsers =  $userRepo->applySpecification(new UserAgeGreaterThan18())->getUsers();

        self::assertCount(1, $adultUsers);
    }

    /**
     * @dataProvider specificationDataProvider
     */
    public function testIsActive(UserRepository $userRepo): void
    {
        $activeUsers = $userRepo->applySpecification(new UserIsActive())->getUsers();

        self::assertCount(2, $activeUsers);
    }

    /**
     * @dataProvider specificationDataProvider
     */
    public function testUserAndSpecification(UserRepository $userRepo): void
    {
        $users = $userRepo->applySpecification(
            new UserAndSpecification(
                new UserAgeGreaterThan18(),
                new UserIsActive(),
            ),
        )->getUsers();

        self::assertCount(1, $users);
    }

    /**
     * @dataProvider specificationDataProvider
     */
    public function testUserOrSpecification(UserRepository $userRepo): void
    {
        $users = $userRepo->applySpecification(
            new UserOrSpecification(
                new UserAgeGreaterThan18(),
                new UserIsActive(),
            ),
        )->getUsers();

        self::assertCount(2, $users);
    }

    /**
     * @dataProvider specificationDataProvider
     */
    public function testUserNotSpecification(UserRepository $userRepo): void
    {
        $users = $userRepo->applySpecification(
            new UserNotSpecification(new UserIsActive()),
        )->getUsers();

        self::assertCount(0, $users);
    }

    // crear data provider para crear un set de datos y pasarselos a cada test Case
    public static function specificationDataProvider(): iterable
    {
        $users = [
            new User(1, 'Jonnathan', 38, true),
            new User(2, 'Israel', 10, true),
        ];

        $repository = new UserRepository($users);

        yield 'Basic repository' => [
            'repository' => $repository,
        ];
    }
}

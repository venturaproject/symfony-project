<?php

namespace App\Tests\Functional\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\UserFixture;
use App\Users\Application\DTO\UserDTO;
use App\Users\Application\Query\FindUserByEmail\FindUserByEmailQuery;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    private Generator $faker;
    private QueryBusInterface $queryBus;
    private UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->queryBus = static::getContainer()->get(QueryBusInterface::class);
        $this->userRepository = static::getContainer()->get(UserRepositoryInterface::class);
    }

    public function testUserCreatedWhenCommandExecuted(): void
    {
        // arrange
        $email = $this->faker->email(); // Genera un email ficticio
        $user = (new UserFactory())->create($email, 'password123'); // Crear un nuevo usuario
        $this->userRepository->add($user); // Añadir el usuario al repositorio

        $query = new FindUserByEmailQuery($email); // Usar el email generado en la consulta

        // act
        $userDTO = $this->queryBus->execute($query);

        // assert
        $this->assertInstanceOf(UserDTO::class, $userDTO);
        $this->assertEquals($email, $userDTO->email); // Acceder directamente a la propiedad 'email'
    }
}
<?php

namespace App\Users\Application\Command\CreateUser;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommandHandler
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(CreateUserCommand $command): string
    {
        $hashedPassword = $this->passwordHasher->hashPassword(new User($command->getEmail(), ''), $command->getPassword());

        $user = new User($command->getEmail(), $hashedPassword);

        $this->userRepository->add($user); // Llama al método adecuado para guardar la entidad User

        return $user->getUlid();
    }
}

<?php

namespace App\Users\Application\Command\EraseUserCredentials;

use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Domain\Service\UserCredentialsService;
use App\Shared\Application\Command\CommandHandlerInterface;

class EraseUserCredentialsCommandHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $userRepository;
    private UserCredentialsService $userCredentialsService;

    public function __construct(UserRepositoryInterface $userRepository, UserCredentialsService $userCredentialsService)
    {
        $this->userRepository = $userRepository;
        $this->userCredentialsService = $userCredentialsService;
    }

    public function __invoke(EraseUserCredentialsCommand $command): void
    {
        $user = $this->userRepository->findByUlid($command->getUserId());

        if ($user === null) {
            throw new \Exception("User not found");
        }

        $this->userCredentialsService->eraseCredentials($user);

        $this->userRepository->add($user);
    }
}
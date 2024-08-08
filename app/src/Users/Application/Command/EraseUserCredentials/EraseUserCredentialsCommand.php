<?php


namespace App\Users\Application\Command\EraseUserCredentials;

use App\Shared\Application\Command\CommandInterface;

class EraseUserCredentialsCommand implements CommandInterface
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}


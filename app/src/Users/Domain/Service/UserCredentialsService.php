<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\User;

class UserCredentialsService
{
    public function eraseCredentials(User $user): void
    {

        $user->eraseCredentials();  
    }
}

<?php

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\User;

class UserCredentialsService
{
    public function eraseCredentials(User $user): void
    {
        // Aquí puedes implementar la lógica específica para borrar credenciales
        $user->eraseCredentials();  // Esto puede ser una limpieza de tokens temporales, etc.
    }
}

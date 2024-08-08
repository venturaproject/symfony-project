<?php 


namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private string $ulid;
    private string $email;
    private string $password;

    public function __construct(string $email, string $hashedPassword)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
        $this->password = $hashedPassword;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Implementación opcional: borra las credenciales almacenadas temporalmente, si las hay
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}

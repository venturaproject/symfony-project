<?php

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * This class represents a user in the system.
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private string $ulid; 
    private string $email; 
    private string $password; 

    /**
     * User constructor.
     *
     * @param string $email User's email address
     * @param string $hashedPassword User's hashed password
     */
    public function __construct(string $email, string $hashedPassword)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
        $this->password = $hashedPassword;
    }

    /**
     * Get the user's unique identifier.
     *
     * @return string
     */
    public function getUlid(): string
    {
        return $this->ulid;
    }

    /**
     * Get the user's email address.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the user's password.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Get the username (email) for the user.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * Get the roles for the user.
     *
     * @return array
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * Erase sensitive credentials.
     */
    public function eraseCredentials(): void
    {
        // Implement logic to erase credentials if necessary.
    }

    /**
     * Get the user identifier.
     *
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}

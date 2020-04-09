<?php


namespace Service\SocialNetwork;


use Model\Entity\User;
use Service\User\SecurityInterface;

class SocialNetworkAdapter implements SecurityInterface
{
    private $idInSoc;

    private $socialNetwork;

    private $email;

    private $name;

    public function __construct(SocialNetworkInterface $socialNetworkApi, string $idInSoc)
    {
        $this->socialNetwork = $socialNetworkApi;
        $this->idInSoc = $idInSoc;
    }

    /**
     * @inheritDoc
     */
    public function getUser(): ?User
    {
        // TODO: Implement getUser() method.
    }

    /**
     * @inheritDoc
     */
    public function isLogged(): bool
    {
        // TODO: Implement isLogged() method.
    }

    /**
     * @inheritDoc
     */
    public function authentication(string $login, string $password): bool
    {
        // TODO: Implement authentication() method.
    }

    /**
     * @inheritDoc
     */
    public function logout(): void
    {
        // TODO: Implement logout() method.
    }
}
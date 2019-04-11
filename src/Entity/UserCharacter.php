<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharacterRepository")
 */
class UserCharacter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="userCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $charac;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dead = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $whiteWalker = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $throne = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCharac(): ?Character
    {
        return $this->charac;
    }

    public function setCharac(?Character $charac): self
    {
        $this->charac = $charac;

        return $this;
    }

    public function getDead(): ?bool
    {
        return $this->dead;
    }

    public function setDead(bool $dead): self
    {
        $this->dead = $dead;

        return $this;
    }

    public function getWhiteWalker(): ?bool
    {
        return $this->whiteWalker;
    }

    public function setWhiteWalker(bool $whiteWalker): self
    {
        $this->whiteWalker = $whiteWalker;

        return $this;
    }

    public function getThrone(): ?bool
    {
        return $this->throne;
    }

    public function setThrone(bool $throne): self
    {
        $this->throne = $throne;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollRepository")
 */
class Poll
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="poll", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="PollCharacter", mappedBy="poll", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $pollCharacters;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="polls")
     */
    private $throne;

    public function __construct()
    {
        $this->pollCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|PollCharacter[]
     */
    public function getPollCharacters(): Collection
    {
        return $this->pollCharacters;
    }

    public function addPollCharacter(PollCharacter $pollCharacter): self
    {
        if (!$this->pollCharacters->contains($pollCharacter)) {
            $this->pollCharacters[] = $pollCharacter;
            $pollCharacter->setPoll($this);
        }

        return $this;
    }

    public function removePollCharacter(PollCharacter $pollCharacter): self
    {
        if ($this->pollCharacters->contains($pollCharacter)) {
            $this->pollCharacters->removeElement($pollCharacter);
            // set the owning side to null (unless already changed)
            if ($pollCharacter->getPoll() === $this) {
                $pollCharacter->setPoll(null);
            }
        }

        return $this;
    }

    public function getThrone(): ?Character
    {
        return $this->throne;
    }

    public function setThrone(?Character $throne): self
    {
        $this->throne = $throne;

        return $this;
    }
}

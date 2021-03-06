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

    /**
     * @ORM\Column(type="boolean")
     */
    private $bronnCastle = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $whiteWalkerDead = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $wallRebuilt = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $whiteWalkerWin = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aryaKillAll;

    public function getPoints(): int
    {
        $points = 0;

        foreach ($this->getPollCharacters() as $pollCharacter) {
            $points += $pollCharacter->getPoints();
        }

        if ($this->getBronnCastle() === true) { // Bronn aura son château
            $points += 3;
        }

        if ($this->getWhiteWalkerDead() === true) { // Les Marcheurs Blancs seront définitivement détruit
            $points += 3;
        }

        if ($this->getWallRebuilt() === false) { // Le Mur est reconstruit (ou en cours de reconstruction)
            $points += 3;
        }

        if ($this->getWhiteWalkerWin() === false) { // Les Marcheurs Blancs auront pris totalement le controle de Westeros
            $points += 3;
        }

        if ($this->getAryaKillAll() === false) { // Arya arrive à tuer toute sa liste
            $points += 3;
        }

        if ($this->getThrone() && $this->getThrone()->getId() === 3) { // Arya arrive à tuer toute sa liste
            $points += 25;
        }

        return $points;
    }

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
    public function getPollCharacters()
    {
        $pollCharacters =  $this->pollCharacters->toArray();
        $cmp = function (PollCharacter $a, PollCharacter $b)
        {
            return strcmp($a->getCharac()->getName(), $b->getCharac()->getName());
        };
        usort($pollCharacters, $cmp);
        return new ArrayCollection($pollCharacters);
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

    public function getBronnCastle(): ?bool
    {
        return $this->bronnCastle;
    }

    public function setBronnCastle(bool $bronnCastle): self
    {
        $this->bronnCastle = $bronnCastle;

        return $this;
    }

    public function getWhiteWalkerDead(): ?bool
    {
        return $this->whiteWalkerDead;
    }

    public function setWhiteWalkerDead(bool $whiteWalkerDead): self
    {
        $this->whiteWalkerDead = $whiteWalkerDead;

        return $this;
    }

    public function getWallRebuilt(): ?bool
    {
        return $this->wallRebuilt;
    }

    public function setWallRebuilt(bool $wallRebuilt): self
    {
        $this->wallRebuilt = $wallRebuilt;

        return $this;
    }

    public function getWhiteWalkerWin(): ?bool
    {
        return $this->whiteWalkerWin;
    }

    public function setWhiteWalkerWin(bool $whiteWalkerWin): self
    {
        $this->whiteWalkerWin = $whiteWalkerWin;

        return $this;
    }

    public function getAryaKillAll(): ?bool
    {
        return $this->aryaKillAll;
    }

    public function setAryaKillAll(bool $aryaKillAll): self
    {
        $this->aryaKillAll = $aryaKillAll;

        return $this;
    }
}

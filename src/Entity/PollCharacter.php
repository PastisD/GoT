<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollCharacterRepository")
 */
class PollCharacter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="pollCharacters")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Poll", inversedBy="pollCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poll;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(?Poll $poll): self
    {
        $this->poll = $poll;

        return $this;
    }
}

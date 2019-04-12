<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="`character`")
 * @Vich\Uploadable
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="character_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="PollCharacter", mappedBy="charac", orphanRemoval=true)
     */
    private $pollCharacters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Poll", mappedBy="throne")
     */
    private $polls;

    public function __construct()
    {
        $this->pollCharacters = new ArrayCollection();
        $this->polls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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
            $pollCharacter->setCharac($this);
        }

        return $this;
    }

    public function removePollCharacter(PollCharacter $pollCharacter): self
    {
        if ($this->pollCharacters->contains($pollCharacter)) {
            $this->pollCharacters->removeElement($pollCharacter);
            // set the owning side to null (unless already changed)
            if ($pollCharacter->getCharac() === $this) {
                $pollCharacter->setCharac(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Poll[]
     */
    public function getPolls(): Collection
    {
        return $this->polls;
    }

    public function addPoll(Poll $poll): self
    {
        if (!$this->polls->contains($poll)) {
            $this->polls[] = $poll;
            $poll->setThrone($this);
        }

        return $this;
    }

    public function removePoll(Poll $poll): self
    {
        if ($this->polls->contains($poll)) {
            $this->polls->removeElement($poll);
            // set the owning side to null (unless already changed)
            if ($poll->getThrone() === $this) {
                $poll->setThrone(null);
            }
        }

        return $this;
    }
}

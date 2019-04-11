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
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharacter", mappedBy="charac", orphanRemoval=true)
     */
    private $userCharacters;

    public function __construct()
    {
        $this->userCharacters = new ArrayCollection();
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
     * @return Collection|UserCharacter[]
     */
    public function getUserCharacters(): Collection
    {
        return $this->userCharacters;
    }

    public function addUserCharacter(UserCharacter $userCharacter): self
    {
        if (!$this->userCharacters->contains($userCharacter)) {
            $this->userCharacters[] = $userCharacter;
            $userCharacter->setCharac($this);
        }

        return $this;
    }

    public function removeUserCharacter(UserCharacter $userCharacter): self
    {
        if ($this->userCharacters->contains($userCharacter)) {
            $this->userCharacters->removeElement($userCharacter);
            // set the owning side to null (unless already changed)
            if ($userCharacter->getCharac() === $this) {
                $userCharacter->setCharac(null);
            }
        }

        return $this;
    }
}

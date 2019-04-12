<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|UserCharacter[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharacter", mappedBy="user", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $userCharacters;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="blob")
     */
    private $photo;

    public function __construct()
    {
        parent::__construct();
        $this->userCharacters = new ArrayCollection();
        // your own logic
    }

    /**
     * @return ArrayCollection|UserCharacter[]
     */
    public function getUserCharacters(): Collection
    {
        return $this->userCharacters;
    }

    public function addUserCharacter(UserCharacter $userCharacter): self
    {
        if (!$this->userCharacters->contains($userCharacter)) {
            $this->userCharacters[] = $userCharacter;
            $userCharacter->setUser($this);
        }

        return $this;
    }

    public function removeUserCharacter(UserCharacter $userCharacter): self
    {
        if ($this->userCharacters->contains($userCharacter)) {
            $this->userCharacters->removeElement($userCharacter);
            // set the owning side to null (unless already changed)
            if ($userCharacter->getUser() === $this) {
                $userCharacter->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }
}

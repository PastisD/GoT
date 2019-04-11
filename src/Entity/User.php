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
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharacter", mappedBy="user", orphanRemoval=true)
     */
    private $userCharacters;

    public function __construct()
    {
        parent::__construct();
        $this->userCharacters = new ArrayCollection();
        // your own logic
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
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

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
     * @ORM\Column(type="blob", nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Poll", mappedBy="user", cascade={"persist", "remove"})
     */
    private $poll;

    /**
     * @var string
     */
    private $rawPhoto;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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

    /**
     * @return string
     */
    public function displayPhoto()
    {
        if(null === $this->rawPhoto && $this->photo) {
            $this->rawPhoto = "data:image/jpeg;base64," . base64_encode(stream_get_contents($this->getPhoto()));
        }

        return $this->rawPhoto;
    }

    public function getPoll(): Poll
    {
        if(!$this->poll) {
            $this->setPoll(new Poll);
        }
        return $this->poll;
    }

    public function setPoll(Poll $poll): self
    {
        $this->poll = $poll;

        // set the owning side of the relation if necessary
        if ($this !== $poll->getUser()) {
            $poll->setUser($this);
        }

        return $this;
    }
}

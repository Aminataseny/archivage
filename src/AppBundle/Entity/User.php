<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Model\ParticipantInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements ParticipantInterface

{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lastname;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $firstname;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $photo;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $role;


    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Document", inversedBy="users")
     * @ORM\JoinTable(name="users_documents")
     */
    private $documents;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }


    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhot($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add doument
     *
     * @param \AppBundle\Entity\Document $doument
     *
     * @return User
     */
    public function addDoument(\AppBundle\Entity\Document $doument)
    {
        $this->documents[] = $doument;

        return $this;
    }

    /**
     * Remove doument
     *
     * @param \AppBundle\Entity\Document $doument
     */
    public function removeDoument(\AppBundle\Entity\Document $doument)
    {
        $this->documents->removeElement($doument);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}

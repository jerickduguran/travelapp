<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traveler
 */
class Traveler
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Traveler
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Traveler
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Traveler
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Traveler
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Traveler
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Traveler
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $flights;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flights = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add flights
     *
     * @param \AppBundle\Entity\FlightTraveler $flights
     * @return Traveler
     */
    public function addFlight(\AppBundle\Entity\FlightTraveler $flights)
    {
        $this->flights[] = $flights;

        return $this;
    }

    /**
     * Remove flights
     *
     * @param \AppBundle\Entity\FlightTraveler $flights
     */
    public function removeFlight(\AppBundle\Entity\FlightTraveler $flights)
    {
        $this->flights->removeElement($flights);
    }

    /**
     * Get flights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFlights()
    {
        return $this->flights;
    }

    public function __toString()
    {
        return $this->getId() ? $this->getFirstName() . ' '. $this->getLastName() : 'New';
    }
    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $travelAgent;


    /**
     * Set travelAgent
     *
     * @param \Application\Sonata\UserBundle\Entity\User $travelAgent
     * @return Traveler
     */
    public function setTravelAgent(\Application\Sonata\UserBundle\Entity\User $travelAgent = null)
    {
        $this->travelAgent = $travelAgent;

        return $this;
    }

    /**
     * Get travelAgent
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getTravelAgent()
    {
        return $this->travelAgent;
    }
    /**
     * @var string
     */
    private $contactNumber;

    /**
     * @var string
     */
    private $email;


    /**
     * Set contactNumber
     *
     * @param string $contactNumber
     * @return Traveler
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * Get contactNumber
     *
     * @return string 
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Traveler
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @var string
     */
    private $telephoneNumber;


    /**
     * Set telephoneNumber
     *
     * @param string $telephoneNumber
     * @return Traveler
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get telephoneNumber
     *
     * @return string 
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $profilePicture;


    /**
     * Set profilePicture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $profilePicture
     * @return Traveler
     */
    public function setProfilePicture(\Application\Sonata\MediaBundle\Entity\Media $profilePicture = null)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $personalRatings;


    /**
     * Add personalRatings
     *
     * @param \AppBundle\Entity\Rate $personalRatings
     * @return Traveler
     */
    public function addPersonalRating(\AppBundle\Entity\Rate $personalRatings)
    {
        $this->personalRatings[] = $personalRatings;

        return $this;
    }

    /**
     * Remove personalRatings
     *
     * @param \AppBundle\Entity\Rate $personalRatings
     */
    public function removePersonalRating(\AppBundle\Entity\Rate $personalRatings)
    {
        $this->personalRatings->removeElement($personalRatings);
    }

    /**
     * Get personalRatings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonalRatings()
    {
        return $this->personalRatings;
    }
}

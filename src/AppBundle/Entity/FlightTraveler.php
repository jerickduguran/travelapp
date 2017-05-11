<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlightTraveler
 */
class FlightTraveler
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set code
     *
     * @param string $code
     * @return FlightTraveler
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FlightTraveler
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
     * @return FlightTraveler
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @var \AppBundle\Entity\Flight
     */
    private $flight;

    /**
     * @var \AppBundle\Entity\Traveler
     */
    private $traveler;


    /**
     * Set flight
     *
     * @param \AppBundle\Entity\Flight $flight
     * @return FlightTraveler
     */
    public function setFlight(\AppBundle\Entity\Flight $flight = null)
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return \AppBundle\Entity\Flight 
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * Set traveler
     *
     * @param \AppBundle\Entity\Traveler $traveler
     * @return FlightTraveler
     */
    public function setTraveler(\AppBundle\Entity\Traveler $traveler = null)
    {
        $this->traveler = $traveler;

        return $this;
    }

    /**
     * Get traveler
     *
     * @return \AppBundle\Entity\Traveler 
     */
    public function getTraveler()
    {
        return $this->traveler;
    }

    public function __toString()
    {
        return $this->getId() ? $this->getFlight()->getTitle() : 'New';
    }
}

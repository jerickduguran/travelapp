<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlightConnecting
 */
class FlightConnecting
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var \DateTime
     */
    private $arrivalSchedule;

    /**
     * @var string
     */
    private $calendarNote;

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
     * Set destination
     *
     * @param string $destination
     * @return FlightConnecting
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set arrivalSchedule
     *
     * @param \DateTime $arrivalSchedule
     * @return FlightConnecting
     */
    public function setArrivalSchedule($arrivalSchedule)
    {
        $this->arrivalSchedule = $arrivalSchedule;

        return $this;
    }

    /**
     * Get arrivalSchedule
     *
     * @return \DateTime 
     */
    public function getArrivalSchedule()
    {
        return $this->arrivalSchedule;
    }

    /**
     * Set calendarNote
     *
     * @param string $calendarNote
     * @return FlightConnecting
     */
    public function setCalendarNote($calendarNote)
    {
        $this->calendarNote = $calendarNote;

        return $this;
    }

    /**
     * Get calendarNote
     *
     * @return string 
     */
    public function getCalendarNote()
    {
        return $this->calendarNote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FlightConnecting
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
     * @return FlightConnecting
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
     * @var \AppBundle\Entity\Flight
     */
    private $flight;


    /**
     * Set flight
     *
     * @param \AppBundle\Entity\Flight $flight
     * @return FlightConnecting
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

    public function __toString()
    {
        return $this->id ? $this->destination : 'New';
    }
    /**
     * @var string
     */
    private $type;


    /**
     * Set type
     *
     * @param string $type
     * @return FlightConnecting
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var string
     */
    private $timezone;


    /**
     * Set timezone
     *
     * @param string $timezone
     * @return FlightConnecting
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}

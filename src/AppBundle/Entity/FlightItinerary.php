<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlightItinerary
 */
class FlightItinerary
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $schedule;

    /**
     * @var string
     */
    private $activity;

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
     * Set schedule
     *
     * @param \DateTime $schedule
     * @return FlightItinerary
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \DateTime 
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set activity
     *
     * @param string $activity
     * @return FlightItinerary
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set calendarNote
     *
     * @param string $calendarNote
     * @return FlightItinerary
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
     * @return FlightItinerary
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
     * @return FlightItinerary
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
     * @return FlightItinerary
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
     * @var string
     */
    private $title;


    /**
     * Set title
     *
     * @param string $title
     * @return FlightItinerary
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->getId() ? $this->getTitle() : 'New';
    }
    /**
     * @var string
     */
    private $timezone;


    /**
     * Set timezone
     *
     * @param string $timezone
     * @return FlightItinerary
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

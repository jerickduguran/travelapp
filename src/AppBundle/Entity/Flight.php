<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 */
class Flight
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $origin;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var \DateTime
     */
    private $originDepartureSchedule;

    /**
     * @var \DateTime
     */
    private $destinationArrivalSchedule;

    /**
     * @var \DateTime
     */
    private $destinationDepartureSchedule;

    /**
     * @var \DateTime
     */
    private $originArrivalSchedule;

    /**
     * @var string
     */
    private $originDepartureCalendarNote;

    /**
     * @var string
     */
    private $destinationDepartureCalendarNote;

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
     * Set origin
     *
     * @param string $origin
     * @return Flight
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return Flight
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
     * Set originDepartureSchedule
     *
     * @param \DateTime $originDepartureSchedule
     * @return Flight
     */
    public function setOriginDepartureSchedule($originDepartureSchedule)
    {
        $this->originDepartureSchedule = $originDepartureSchedule;

        return $this;
    }

    /**
     * Get originDepartureSchedule
     *
     * @return \DateTime 
     */
    public function getOriginDepartureSchedule()
    {
        return $this->originDepartureSchedule;
    }

    /**
     * Set destinationArrivalSchedule
     *
     * @param \DateTime $destinationArrivalSchedule
     * @return Flight
     */
    public function setDestinationArrivalSchedule($destinationArrivalSchedule)
    {
        $this->destinationArrivalSchedule = $destinationArrivalSchedule;

        return $this;
    }

    /**
     * Get destinationArrivalSchedule
     *
     * @return \DateTime 
     */
    public function getDestinationArrivalSchedule()
    {
        return $this->destinationArrivalSchedule;
    }

    /**
     * Set destinationDepartureSchedule
     *
     * @param \DateTime $destinationDepartureSchedule
     * @return Flight
     */
    public function setDestinationDepartureSchedule($destinationDepartureSchedule)
    {
        $this->destinationDepartureSchedule = $destinationDepartureSchedule;

        return $this;
    }

    /**
     * Get destinationDepartureSchedule
     *
     * @return \DateTime 
     */
    public function getDestinationDepartureSchedule()
    {
        return $this->destinationDepartureSchedule;
    }

    /**
     * Set originArrivalSchedule
     *
     * @param \DateTime $originArrivalSchedule
     * @return Flight
     */
    public function setOriginArrivalSchedule($originArrivalSchedule)
    {
        $this->originArrivalSchedule = $originArrivalSchedule;

        return $this;
    }

    /**
     * Get originArrivalSchedule
     *
     * @return \DateTime 
     */
    public function getOriginArrivalSchedule()
    {
        return $this->originArrivalSchedule;
    }

    /**
     * Set originDepartureCalendarNote
     *
     * @param string $originDepartureCalendarNote
     * @return Flight
     */
    public function setOriginDepartureCalendarNote($originDepartureCalendarNote)
    {
        $this->originDepartureCalendarNote = $originDepartureCalendarNote;

        return $this;
    }

    /**
     * Get originDepartureCalendarNote
     *
     * @return string 
     */
    public function getOriginDepartureCalendarNote()
    {
        return $this->originDepartureCalendarNote;
    }

    /**
     * Set destinationDepartureCalendarNote
     *
     * @param string $destinationDepartureCalendarNote
     * @return Flight
     */
    public function setDestinationDepartureCalendarNote($destinationDepartureCalendarNote)
    {
        $this->destinationDepartureCalendarNote = $destinationDepartureCalendarNote;

        return $this;
    }

    /**
     * Get destinationDepartureCalendarNote
     *
     * @return string 
     */
    public function getDestinationDepartureCalendarNote()
    {
        return $this->destinationDepartureCalendarNote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Flight
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
     * @return Flight
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
     * @var string
     */
    private $title;


    /**
     * Set title
     *
     * @param string $title
     * @return Flight
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $itineraries;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $travelers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itineraries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->travelers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add itineraries
     *
     * @param \AppBundle\Entity\FlightItinerary $itineraries
     * @return Flight
     */
    public function addItinerary(\AppBundle\Entity\FlightItinerary $itineraries)
    {
        $this->itineraries[] = $itineraries;

        return $this;
    }

    /**
     * Remove itineraries
     *
     * @param \AppBundle\Entity\FlightItinerary $itineraries
     */
    public function removeItinerary(\AppBundle\Entity\FlightItinerary $itineraries)
    {
        $this->itineraries->removeElement($itineraries);
    }

    /**
     * Get itineraries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItineraries()
    {
        return $this->itineraries;
    }

    /**
     * Add travelers
     *
     * @param \AppBundle\Entity\FlightTraveler $travelers
     * @return Flight
     */
    public function addTraveler(\AppBundle\Entity\FlightTraveler $travelers)
    {
        $this->travelers[] = $travelers;

        return $this;
    }

    /**
     * Remove travelers
     *
     * @param \AppBundle\Entity\FlightTraveler $travelers
     */
    public function removeTraveler(\AppBundle\Entity\FlightTraveler $travelers)
    {
        $this->travelers->removeElement($travelers);
    }

    /**
     * Get travelers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTravelers()
    {
        return $this->travelers;
    }
    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $travelAgent;


    /**
     * Set travelAgent
     *
     * @param \Application\Sonata\UserBundle\Entity\User $travelAgent
     * @return Flight
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
    private $originTimezone;

    /**
     * @var string
     */
    private $destinationTimezone;


    /**
     * Set originTimezone
     *
     * @param string $originTimezone
     * @return Flight
     */
    public function setOriginTimezone($originTimezone)
    {
        $this->originTimezone = $originTimezone;

        return $this;
    }

    /**
     * Get originTimezone
     *
     * @return string 
     */
    public function getOriginTimezone()
    {
        return $this->originTimezone;
    }

    /**
     * Set destinationTimezone
     *
     * @param string $destinationTimezone
     * @return Flight
     */
    public function setDestinationTimezone($destinationTimezone)
    {
        $this->destinationTimezone = $destinationTimezone;

        return $this;
    }

    /**
     * Get destinationTimezone
     *
     * @return string 
     */
    public function getDestinationTimezone()
    {
        return $this->destinationTimezone;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $connectingFlights;


    /**
     * Add connectingFlights
     *
     * @param \AppBundle\Entity\FlightConnecting $connectingFlights
     * @return Flight
     */
    public function addConnectingFlight(\AppBundle\Entity\FlightConnecting $connectingFlights)
    {
        $this->connectingFlights[] = $connectingFlights;

        return $this;
    }

    /**
     * Remove connectingFlights
     *
     * @param \AppBundle\Entity\FlightConnecting $connectingFlights
     */
    public function removeConnectingFlight(\AppBundle\Entity\FlightConnecting $connectingFlights)
    {
        $this->connectingFlights->removeElement($connectingFlights);
    }

    /**
     * Get connectingFlights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConnectingFlights()
    {
        return $this->connectingFlights;
    }
}

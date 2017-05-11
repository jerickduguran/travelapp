<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 */
class Rate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $ratingDate;

    /**
     * @var float
     */
    private $hotel;

    /**
     * @var float
     */
    private $food;

    /**
     * @var float
     */
    private $tour;

    /**
     * @var float
     */
    private $travelEscort;

    /**
     * @var float
     */
    private $tourGuide;

    /**
     * @var float
     */
    private $localGuide;

    /**
     * @var float
     */
    private $tourBus;

    /**
     * @var float
     */
    private $service;

    /**
     * @var string
     */
    private $travelerName;

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
     * Set ratingDate
     *
     * @param \DateTime $ratingDate
     * @return Rate
     */
    public function setRatingDate($ratingDate)
    {
        $this->ratingDate = $ratingDate;

        return $this;
    }

    /**
     * Get ratingDate
     *
     * @return \DateTime 
     */
    public function getRatingDate()
    {
        return $this->ratingDate;
    }

    /**
     * Set hotel
     *
     * @param float $hotel
     * @return Rate
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return float 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set food
     *
     * @param float $food
     * @return Rate
     */
    public function setFood($food)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get food
     *
     * @return float 
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set tour
     *
     * @param float $tour
     * @return Rate
     */
    public function setTour($tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return float 
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set travelEscort
     *
     * @param float $travelEscort
     * @return Rate
     */
    public function setTravelEscort($travelEscort)
    {
        $this->travelEscort = $travelEscort;

        return $this;
    }

    /**
     * Get travelEscort
     *
     * @return float 
     */
    public function getTravelEscort()
    {
        return $this->travelEscort;
    }

    /**
     * Set tourGuide
     *
     * @param float $tourGuide
     * @return Rate
     */
    public function setTourGuide($tourGuide)
    {
        $this->tourGuide = $tourGuide;

        return $this;
    }

    /**
     * Get tourGuide
     *
     * @return float 
     */
    public function getTourGuide()
    {
        return $this->tourGuide;
    }

    /**
     * Set localGuide
     *
     * @param float $localGuide
     * @return Rate
     */
    public function setLocalGuide($localGuide)
    {
        $this->localGuide = $localGuide;

        return $this;
    }

    /**
     * Get localGuide
     *
     * @return float 
     */
    public function getLocalGuide()
    {
        return $this->localGuide;
    }

    /**
     * Set tourBus
     *
     * @param float $tourBus
     * @return Rate
     */
    public function setTourBus($tourBus)
    {
        $this->tourBus = $tourBus;

        return $this;
    }

    /**
     * Get tourBus
     *
     * @return float 
     */
    public function getTourBus()
    {
        return $this->tourBus;
    }

    /**
     * Set service
     *
     * @param float $service
     * @return Rate
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return float 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set travelerName
     *
     * @param string $travelerName
     * @return Rate
     */
    public function setTravelerName($travelerName)
    {
        $this->travelerName = $travelerName;

        return $this;
    }

    /**
     * Get travelerName
     *
     * @return string 
     */
    public function getTravelerName()
    {
        return $this->travelerName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Rate
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
     * @return Rate
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
     * @var \AppBundle\Entity\Traveler
     */
    private $traveler;


    /**
     * Set traveler
     *
     * @param \AppBundle\Entity\Traveler $traveler
     * @return Rate
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

    public  function __toString()
    {
        return $this->getId() ? $this->getTravelerName() : 'New';
    }
    /**
     * @var string
     */
    private $comment;


    /**
     * Set comment
     *
     * @param string $comment
     * @return Rate
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}

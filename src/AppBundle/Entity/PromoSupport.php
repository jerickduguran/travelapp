<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoSupport
 */
class PromoSupport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $enabled;

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
     * Set title
     *
     * @param string $title
     * @return PromoSupport
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

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return PromoSupport
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PromoSupport
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
     * @return PromoSupport
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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $promoSubImage;


    /**
     * Set promoSubImage
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $promoSubImage
     * @return PromoSupport
     */
    public function setPromoSubImage(\Application\Sonata\MediaBundle\Entity\Media $promoSubImage = null)
    {
        $this->promoSubImage = $promoSubImage;

        return $this;
    }

    /**
     * Get promoSubImage
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getPromoSubImage()
    {
        return $this->promoSubImage;
    }
    public function __toString()
    {
        return $this->id ? $this->getTitle() : 'New';
    }
    /**
     * @var \AppBundle\Entity\Promo
     */
    private $promo;


    /**
     * Set promo
     *
     * @param \AppBundle\Entity\Promo $promo
     * @return PromoSupport
     */
    public function setPromo(\AppBundle\Entity\Promo $promo = null)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \AppBundle\Entity\Promo 
     */
    public function getPromo()
    {
        return $this->promo;
    }
}

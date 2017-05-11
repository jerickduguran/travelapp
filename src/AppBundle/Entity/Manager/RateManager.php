<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Rate;


class RateManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $class
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, $class)
    {
        $this->em     = $em;
        $this->class  = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(Rate $rate)
    {
        $this->em->persist($rate);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    /**

     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return $this->em->getRepository($this->class)->findById($id);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Rate $rate)
    {
        $this->em->remove($rate);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function create()
    {
        return new $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(array $criteria)
    {
        return $this->em->getRepository($this->class)->findAll($criteria);
    }
}

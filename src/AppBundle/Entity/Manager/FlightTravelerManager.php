<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\FlightTraveler;


class FlightTravelerManager
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
    public function save(FlightTraveler $flight)
    {
        $this->em->persist($flight);
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
    public function delete(FlightTraveler $flight)
    {
        $this->em->remove($flight);
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


    public function getActiveAgentFlight($access_code)
    {
        try
        {
            $date_now = new \DateTime('now');

            $query = $this->em->getRepository($this->class)->createQueryBuilder('tf')
                ->leftJoin('tf.flight','f')
                ->where('tf.code = :access_code')
                ->andWhere('f.originArrivalSchedule >= :date_now')
                ->orderBy('f.originDepartureSchedule','ASC')
                ->setMaxResults(1);

            $query->setParameter('access_code',$access_code);
            $query->setParameter('date_now',$date_now->format('Y-m-d H:i:s'));

            return $query->getQuery()->getSingleResult();

        }catch(\Doctrine\ORM\NoResultException $e){
            return false;
        }
    }

}

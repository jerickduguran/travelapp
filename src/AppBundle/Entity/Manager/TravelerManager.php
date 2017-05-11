<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Traveler;


class TravelerManager
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
    public function save(Traveler $traveler)
    {
        $this->em->persist($traveler);
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
    public function delete(Traveler $traveler)
    {
        $this->em->remove($traveler);
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

    public function findByAccessCode($traveler_id, $access_code)
    {
        try
        {
            $query = $this->em->getRepository($this->class)->createQueryBuilder('t')
                ->select('t,f')
                ->leftJoin('t.flights','f')
                ->where('t.id = :traveler_id')
                ->andWhere('f.code = :access_code');

            $query->setParameter('traveler_id',$traveler_id);
            $query->setParameter('access_code',$access_code);

            return $query->getQuery()->getSingleResult();
        }catch(\Doctrine\ORM\NoResultException $e){
            return false;
        }
    }

    public function login($access_code)
    {
        try
        {
            $date_now = new \DateTime('now');
            $query = $this->em->getRepository($this->class)->createQueryBuilder('t')
                ->select('t')
                ->leftJoin('t.flights','tf')
                ->leftJoin('tf.flight','f')
                ->where('tf.code = :access_code')
                ->andWhere('f.originArrivalSchedule >= :date_now')
                ->orderBy('f.originDepartureSchedule','DESC')
                ->setMaxResults(1);

            $query->setParameter('access_code',$access_code);
            $query->setParameter('date_now',$date_now->format('Y-m-d H:i:s'));
            return $query->getQuery()->getSingleResult();
            
        }catch(\Doctrine\ORM\NoResultException $e){
            return false;
        }
    }
}

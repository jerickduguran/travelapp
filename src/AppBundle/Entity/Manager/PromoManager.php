<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Promo;


class PromoManager
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
    public function save(Promo $promo)
    {
        $this->em->persist($promo);
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
    public function delete(Promo $promo)
    {
        $this->em->remove($promo);
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

    public function findByAgent($agent_id)
    {
         //return $this->em->getRepository($this->class)->findBy(array('travelAgent' => $user_id));

        $query = $this->em->getRepository($this->class)->createQueryBuilder('f')
                          ->select('f')
                          ->where('f.travelAgent = :travel_agent');

        $query->setParameter('travel_agent',$agent_id);

        return $query->getQuery()->getResult();
    }

    public function getActiveFlight($agent_id)
    {
        $date_filter = new \DateTime('now');

        $query = $this->em->getRepository($this->class)->createQueryBuilder('f')
                          ->select('f')
                          ->where('f.travelAgent = :travel_agent')
                          //->andWhere('f.originDepartureSchedule <= :now' )
                          ->andWhere('f.originArrivalSchedule >= :now')
                          ->orderBy('f.originDepartureSchedule','ASC')
                          ->setMaxResults(1);

        $query->setParameter('travel_agent',$agent_id);
        $query->setParameter('now',$date_filter->format('Y-m-d H:i:s'));
        $result = $query->getQuery()->getResult();

        return $result;
    }
}

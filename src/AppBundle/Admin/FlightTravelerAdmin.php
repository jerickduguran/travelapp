<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FlightTravelerAdmin extends Admin
{
    protected  $parentAssociationMapping = 'flight';

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('flight')
            ->add('traveler')
            ->add('code')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('flight')
            ->add('traveler')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('traveler')
            ->add('code')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
        ;
    }

    public function prePersist($object)
    {
        if(!$object->getCode())
        {
            $access_code = $this->generateCode($object);
            $object->setCode($access_code);

            $container = $this->getConfigurationPool()->getContainer();
            $message = \Swift_Message::newInstance()
                ->setSubject('TravelAPP Flight  Access Code')
                ->setFrom('admin@binary-digital.com')
                ->setTo($object->getTraveler()->getEmail())
                ->setBody(
                $container->get('templating')->render(
                    'AppBundle:Email:traveler_code.html.twig',
                    array('code' => $access_code)
                ),
                'text/html'
            );

            $container->get('mailer')->send($message);

        }
    }

    public function preUpdate($object)
    {
        if(!$object->getCode())
        {
            $object->setCode($this->generateCode($object));
        }
    }

    protected function generateCode($object)
    {
        $date = new \DateTime("now");

        return $object->getId().$object->getTraveler()->getId(). strtoupper($date->getTimestamp());
    }
    protected function getUser()
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        return $user;
    }
}

<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FlightAdmin extends Admin
{
    public function getNewInstance()
    {
        $object =  parent::getNewInstance();

        if(!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $object->setTravelAgent($this->getUser());
        }

        return $object;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        if($this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $listMapper
                ->add('travelAgent');
        }

        $listMapper
            ->add('title')
            ->add('origin')
            ->add('destination')
            ->add('originDepartureSchedule',null,array('label' => 'Departure'))
            ->add('originArrivalSchedule',null,array('label' => 'Return Schedule'))
            ->add('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'itineraries' => array('template' => 'AppBundle:Admin/List:itineraries.html.twig'),
                    'travelers'   => array('template' => 'AppBundle:Admin/List:travelers.html.twig'),
                    'connecting_flights'   => array('template' => 'AppBundle:Admin/List:connecting_flights.html.twig'),
                    'show' => array('template' => 'AppBundle:Admin/List:list__action_show.html.twig'),
                    'edit' => array('template' => 'AppBundle:Admin/List:list__action_edit.html.twig'),
                    'delete' => array('template' => 'AppBundle:Admin/List:list__action_delete.html.twig'),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if($this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $formMapper
                ->add('travelAgent');
        }

        $formMapper
            ->add('title')
            ->add('origin')
            ->add('destination')
            ->add('originDepartureSchedule','sonata_type_datetime_picker',
                                        array('required'                  => false,
                                              'format'                    => 'yyyy-MM-dd H:m:s',
                                              'dp_side_by_side'           => true,
                                              'dp_min_date'               => '1930-01-01',
                                              'datepicker_use_button'     => false,
                                              'dp_use_seconds'            => false))
            ->add('destinationArrivalSchedule','sonata_type_datetime_picker',
                array('required'                  => false,
                    'format'                    => 'yyyy-MM-dd H:m:s',
                    'dp_side_by_side'           => true,
                    'dp_min_date'               => '1930-01-01',
                    'datepicker_use_button'     => false,
                    'dp_use_seconds'            => false))
            ->add('destinationDepartureSchedule','sonata_type_datetime_picker',
                array('required'                  => false,
                    'format'                    => 'yyyy-MM-dd H:m:s',
                    'dp_side_by_side'           => true,
                    'dp_min_date'               => '1930-01-01',
                    'datepicker_use_button'     => false,
                    'dp_use_seconds'            => false))
            ->add('originArrivalSchedule','sonata_type_datetime_picker',
                array('required'                  => false,
                    'format'                    => 'yyyy-MM-dd H:m:s',
                    'dp_side_by_side'           => true,
                    'dp_min_date'               => '1930-01-01',
                    'datepicker_use_button'     => false,
                    'dp_use_seconds'            => false))
            ->add('originDepartureCalendarNote')
            ->add('destinationDepartureCalendarNote')
            ->add('originTimezone','choice', array('choices' => $this->getTimeZones()))
            ->add('destinationTimezone','choice', array('choices' => $this->getTimeZones()))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        if($this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $showMapper
                  ->add('travelAgent');
        }

        $showMapper
            ->add('title')
            ->add('origin')
            ->add('destination')
            ->add('originDepartureSchedule')
            ->add('destinationArrivalSchedule')
            ->add('destinationDepartureSchedule')
            ->add('originArrivalSchedule')
            ->add('originDepartureCalendarNote')
            ->add('destinationDepartureCalendarNote')
            ->add('originTimezone')
            ->add('destinationTimezone')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
        ;
    }

    protected  function getTimeZones()
    {
        $timezone_abbreviations = \DateTimeZone::listAbbreviations();
        $time_zones             = array();

        foreach($timezone_abbreviations as $details){
            foreach($details as $detail){
                $time_zones[$detail['timezone_id']] = $detail['timezone_id'];
            }
        }

        return $time_zones;
    }

    public function createQuery($context = 'list')
    {
        $query = $this->getModelManager()->createQuery($this->getClass(), 'f');
        $user = $this->getUser();
        if(!$user->hasRole('ROLE_SUPER_ADMIN'))
        $query
            ->where('f.travelAgent = :agent')
            ->setParameter('agent', $user)
        ;

        return $query;
    }

    protected function getUser()
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        return $user;
    }
}

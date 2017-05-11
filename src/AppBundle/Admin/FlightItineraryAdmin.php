<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FlightItineraryAdmin extends Admin
{
    protected  $parentAssociationMapping = 'flight';

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('schedule')
            ->add('timezone')
            ->add('createdAt')
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
            ->add('title')
            ->add('schedule','sonata_type_datetime_picker',
                    array('required'                  => false,
                        'format'                    => 'yyyy-MM-dd H:m:s',
                        'dp_side_by_side'           => true,
                        'dp_min_date'               => '1930-01-01',
                        'datepicker_use_button'     => false,
                        'dp_use_seconds'            => false))
            ->add('activity')
            ->add('calendarNote')
            ->add('timezone','choice', array('choices' => $this->getTimeZones()))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('schedule')
            ->add('activity')
            ->add('calendarNote')
            ->add('timezone')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
        ;
    }
    protected function getUser()
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        return $user;
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
}

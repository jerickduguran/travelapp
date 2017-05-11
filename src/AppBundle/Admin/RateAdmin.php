<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class RateAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ratingDate')
            ->add('hotel')
            ->add('food')
            ->add('tour')
            ->add('travelEscort')
            ->add('tourGuide')
            ->add('localGuide')
            ->add('tourBus')
            ->add('service')
            ->add('travelerName')
            ->add('comment')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('travelerName')
            ->add('ratingDate')
            ->add('hotel')
            ->add('food')
            ->add('tour')
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
            ->add('traveler')
            ->add('travelerName')
            ->add('ratingDate','sonata_type_datetime_picker',
            array('required'                  => false,
                'format'                    => 'yyyy-MM-dd H:m:s',
                'dp_side_by_side'           => true,
                'dp_min_date'               => '1930-01-01',
                'datepicker_use_button'     => false,
                'dp_use_seconds'            => false))
            ->add('hotel')
            ->add('food')
            ->add('tour')
            ->add('travelEscort')
            ->add('tourGuide')
            ->add('localGuide')
            ->add('tourBus')
            ->add('service')
            ->add('comment')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('traveler')
            ->add('travelerName')
            ->add('ratingDate')
            ->add('hotel')
            ->add('food')
            ->add('tour')
            ->add('travelEscort')
            ->add('tourGuide')
            ->add('localGuide')
            ->add('tourBus')
            ->add('service')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
        ;
    }
}

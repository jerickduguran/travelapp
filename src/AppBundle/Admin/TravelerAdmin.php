<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TravelerAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('travelAgent')
            ->add('firstName')
            ->add('lastName')
            ->add('gender')
            ->add('email')
            ->add('contactNumber')
            ->add('telephoneNumber')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('travelAgent')
            ->add('firstName')
            ->add('lastName')
            ->add('gender')
            ->add('email')
            ->add('contactNumber')
            ->add('telephoneNumber')
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
            ->add('travelAgent')
            ->add('firstName')
            ->add('lastName')
            ->add('gender','choice',array('choices' => array('MALE' => 'Male','FEMALE' => 'Female')))
            ->add('birthdate','sonata_type_date_picker',
                    array('required'                  => false,
                        'format'                    => 'yyyy-MM-dd',
                        'dp_side_by_side'           => true,
                        'dp_min_date'               => '1930-01-01',
                        'datepicker_use_button'     => false))
            ->add('email')
            ->add('contactNumber')
            ->add('telephoneNumber')
            ->add('profilePicture', 'sonata_type_model_list', array(), array('link_parameters' => array('context' => 'profile')))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('travelAgent')
            ->add('firstName')
            ->add('lastName')
            ->add('gender')
            ->add('birthdate')
            ->add('email')
            ->add('contactNumber')
            ->add('telephoneNumber')
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

}

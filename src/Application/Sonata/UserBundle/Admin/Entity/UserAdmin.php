<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Admin\Entity;

use  Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

class UserAdmin extends BaseUserAdmin
{

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('accessCode',null,array('label' => 'Access Code'))
            ->add('enabled', null, array('editable' => true))
            ->add('createdAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
            ->with('Profile')
                ->add('dateOfBirth')
                ->add('firstname')
                ->add('lastname')
                ->add('gender')
                ->add('phone')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
            'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
        ))
            ->end()
            ->with('Profile')
            ->add('dateOfBirth','sonata_type_date_picker',
                    array('required'                => false,
                        'format'                    => 'yyyy-MM-dd',
                        'dp_side_by_side'           => true,
                        'dp_min_date'               => '1930-01-01',
                        'datepicker_use_button'     => false))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('gender', 'sonata_user_gender', array(
                    'required' => true,
                    'translation_domain' => $this->getTranslationDomain()
                ))
            ->add('phone', null, array('required' => false,'label' => 'Mobile Number'))
            ->add('telephoneNumber', null, array('required' => false,'label' => 'Telephone Number'))
            ->add('profilePicture', 'sonata_type_model_list', array('label' => 'Profile Pic'), array('link_parameters' => array('context' => 'profile')))
            ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add('realRoles', 'sonata_security_roles', array(
                'label'    => 'form.label_roles',
                'expanded' => true,
                'multiple' => true,
                'required' => false
            ))
                ->add('locked', null, array('required' => false))
                //->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
               // ->add('credentialsExpired', null, array('required' => false))
                ->end()
            ;

        }
        if ($this->getSubject()->getId()) {
            $formMapper
                ->with('API')
                ->add('accessCode',null,array('label' => 'Access Code','attr' => array('readonly' => true)))
                ->end()
            ;

        }

    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $access_code = $this->generateAccessCode($user);
        if(!$user->getAccessCode())
        {
            $user->setAccessCode($access_code);
        }

        parent::preUpdate($user);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($user)
    {
        //notify admin
        $password =  $this->getForm()->get('plainPassword')->getData();
        $container = $this->getConfigurationPool()->getContainer();
        $message = \Swift_Message::newInstance()
            ->setSubject('TravelAPP Portal Acccess')
            ->setFrom('admin@binary-digital.com')
            ->setTo($user->getEmail())
            ->setBody(
            $container->get('templating')->render(
                'AppBundle:Email:agent_access.html.twig',
                array('user' => $user,'password' => $password)
            ),
            'text/html'
        );
        $container->get('mailer')->send($message);

        if(!$user->getAccessCode())
        {
            $access_code = $this->generateAccessCode($user);
            $user->setAccessCode($access_code);

            $container = $this->getConfigurationPool()->getContainer();
            $message = \Swift_Message::newInstance()
                ->setSubject('TravelAPP Access Code')
                ->setFrom('admin@binary-digital.com')
                ->setTo($user->getEmail())
                ->setBody(
                $container->get('templating')->render(
                    'AppBundle:Email:agent_code.html.twig',
                    array('code' => $access_code)
                ),
                'text/html'
            );

            $container->get('mailer')->send($message);
        }
    }

    protected function generateAccessCode($user)
    {
        $date = new \DateTime("now");

        return $user->getId() . strtoupper($date->getTimestamp());
    }

}

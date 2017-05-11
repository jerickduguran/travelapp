<?php

namespace Application\Sonata\UserBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\User;
use Sonata\UserBundle\Entity\UserManager as BaseManager;


class UserManager extends BaseManager
{
    /**
     * {@inheritDoc}
     */
    public function findByAccessCode($user_id, $access_code)
    {
        return $this->repository->findOneBy(array('id' => $user_id, 'accessCode' => $access_code));
    }

    /**
     * {@inheritDoc}
     */
    public function login($access_code)
    {
        return $this->repository->findOneBy(array('accessCode' => $access_code,'enabled' => true));
    }

}

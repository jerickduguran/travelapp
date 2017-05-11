<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;

class PromoController extends FOSRestController
{
    public function getPromosAction()
    {
        $promo_manager = $this->container->get('app.entity_manager.promo');
        $criteria      = array('enabled' => true);
        $promos        = $promo_manager->findBy($criteria);

        $data = array('promo' => array());
        if($promos)
        {
            foreach($promos as $promo)
            {
                $data['promo']['mainimage'][$promo->getId()]['path']  = $this->container->get('request')->getSchemeAndHttpHost().$this->container->get('sonata.media.twig.extension')->path($promo->getPromoMainImage(),'reference');
                $data['promo']['mainimage'][$promo->getId()]['child'] = array();
                if($promo->getChildren())
                {
                    foreach($promo->getChildren() as $child)
                    {
                        $data['promo']['mainimage'][$promo->getId()]['child'][] = $this->container->get('request')->getSchemeAndHttpHost().$this->container->get('sonata.media.twig.extension')->path($child->getPromoSubImage(),'reference');
                    }
                }
            }
        }
        $view = $this->view($data, 200)
            ->setTemplateVar('promos')
            ->setTemplateData($data)
        ;

        return $this->handleView($view);
    }

    public function getPromo($promo_id)
    {
        $view = $this->view(array(), 302)
            ->setTemplateVar('promos')
            ->setTemplateData(array())
        ;

        return $this->handleView($view);
    }

}
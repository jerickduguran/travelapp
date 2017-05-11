<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

class RatingsController extends FOSRestController
{
    public function getRatingsAction($user_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(array(), 401) ;

            return $this->handleView($view);
        }

        $view = $this->view(null, 401) ;
        return $this->handleView($view);
    }

    public function postRatingsAction($user_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(array(), 401) ;

            return $this->handleView($view);
        }

        $api_service->setRatings($request);

        $view = $this->view(array('success' => true), 200) ;
        return $this->handleView($view);
    }

}
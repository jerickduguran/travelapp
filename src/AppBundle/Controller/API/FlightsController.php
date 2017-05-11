<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;

class FlightsController extends FOSRestController
{
    public function getFlightsAction($user_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');


        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(null, 401) ;

            return $this->handleView($view);
        }

        $page  = $request->get('page',1);
        $limit = $request->get('limit',10);

        $criteria = array('page' => $page, 'limit' => $limit);
        $data     = $api_service->getFlightData($criteria);

        $view = $this->view($data, 200)
            ->setTemplateVar('users')
            ->setTemplateData($data)
        ;

        return $this->handleView($view);

    }

    public function getFlightAction($user_id,$flight_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(array(), 401) ;

            return $this->handleView($view);
        }

        $flight = $api_service->getFlight($flight_id);

        if(!$flight)
        {
            $view = $this->view($flight,404 );

        }else{

            $view = $this->view($flight, 200);

        }

        return $this->handleView($view);

    }

    public function getFlightsCurrentActiveAction($user_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(array(), 401) ;

            return $this->handleView($view);
        }

        $active_flight = $api_service->getActiveFlight();

        if(!$active_flight)
        {
            $view = $this->view($active_flight,404 );

        }else{

            $view = $this->view($active_flight, 200);

        }

        return $this->handleView($view);

    }
}
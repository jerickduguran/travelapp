<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;

class ItinerariesController extends FOSRestController
{
    public function getItinerariesAction($user_id,$flight_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(null, 401) ;

            return $this->handleView($view);
        }

        $page  = $request->get('page',1);
        $limit = $request->get('limit',10000);

        $criteria = array('page' => $page, 'limit' => $limit);
        $data     = $api_service->getFlightItineraryData($flight_id,$criteria);

        $view = $this->view($data, 200);

        return $this->handleView($view);

    }

    public function getItineraryAction($user_id,$flight_id,$itinerary_id)
    {
        $data = array('id' => $id, 'name' => 'Jerick Duguran');
        $view = $this->view($data, 200)
        //->setTemplate("AppBundle:Users:getUsers.html.twig")
            ->setTemplateVar('users')
            ->setTemplateData($data)
        ;

        return $this->handleView($view);

    }
	
 
}
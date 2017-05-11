<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;

class FlightTravelersController extends FOSRestController
{
    public function getTravelersAction($user_id, $flight_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(null, 401);

            return $this->handleView($view);
        }

        $data = $api_service->getFlightTravelers($flight_id);
        $view = $this->view($data, 200);

        return $this->handleView($view);

    }

    public function getTravelerAction($user_id, $flight_id,$traveler_id)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->isValidAccessCode($user_id, $request->get('access_code')))
        {
            $view = $this->view(null, 401) ;

            return $this->handleView($view);
        }

        $data = $api_service->getUserInfo();
        $view = $this->view($data, 200);

        return $this->handleView($view);

    }

}
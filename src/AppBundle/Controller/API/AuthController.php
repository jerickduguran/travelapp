<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;

class AuthController extends FOSRestController
{
    public function getAuthAction($access_code)
    {
        $request     = $this->container->get('request');
        $api_service = $this->container->get('app.api.service');

        if(!$user = $api_service->login($request->get('access_code')))
        {
            $view = $this->view(array('status'=> 0), 200) ;

            return $this->handleView($view);
        }

        $data = $api_service->getUserInfo();

        $view = $this->view($data, 200);

        return $this->handleView($view);

    }
   
   public function getUserAuth()
{

}

 
}
<?php

namespace AppBundle\Services;

use Application\Sonata\UserBundle\Entity\Manager\UserManager;
use Application\Sonata\UserBundle\Entity\User;
use AppBundle\Entity\Traveler;
use AppBundle\Entity\Flight;
use AppBundle\Entity\Manager\FlightManager;
use AppBundle\Entity\Manager\FlightTravelerManager;
use AppBundle\Entity\Manager\TravelerManager;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use AppBundle\Entity\Manager\RateManager;

class API
{
    protected $access_code    = null;
    protected $user           = null;
    protected $user_manager   = null;
    protected $flight_manager = null;
    protected $flight_traveler_manager = null;
    protected $traveler_manager        = null;
    protected $rate_manager            = null;
    protected $container               = null;

    public function __construct(UserManager $user_manager,FlightManager $flight_manager,FlightTravelerManager $flight_traveler_manager,
                                TravelerManager $traveler_manager,$container,RateManager $rate_manager)
    {
        $this->user_manager              = $user_manager;
        $this->flight_manager            = $flight_manager;
        $this->flight_traveler_manager   = $flight_traveler_manager;
        $this->traveler_manager          = $traveler_manager;
        $this->rate_manager              = $rate_manager;
        $this->container                 = $container;
    }

    public function isValidAccessCode($user_id, $access_code)
    {
        $this->access_code = $access_code;
        $this->user = $this->user_manager->findByAccessCode($user_id,$access_code);

        if($this->user)
        {
            return $this->user;
        }

        //check if traveler
        $this->user = $this->traveler_manager->findByAccessCode($user_id,$access_code);
        if($this->user)
        {
            return $this->user;
        }

        return false;
    }

    public function login( $access_code)
    {
        $this->access_code = $access_code;

        $this->user = $this->user_manager->login($access_code);

        if($this->user)
        {
            return $this->user;
        }

        //check if traveler
        $this->user = $this->traveler_manager->login($access_code);
        if($this->user)
        {
            return $this->user;
        }

        return false;
    }

    public function getUserInfo()
    {
        $data = array();

        if($this->user instanceof User)
        {
            $data = array('status'           => 1,
                          'type'             => 'agent',
                          'id'               => $this->user->getId(),
                          'first_name'       => $this->user->getFirstName(),
                          'last_name'        => $this->user->getLastName(),
                          'birth_date'       => $this->toTimeStamp($this->user->getDateOfBirth()),
                          'contact_number'   => $this->user->getPhone(),
                          'telephone_number' => $this->user->getTelephoneNumber(),
                          'profile_pic'       => $this->getProfilePic($this->user->getProfilePicture()));

        }elseif($this->user instanceof Traveler)
        {
            $agent = $this->getTravelerAgent();
            $data = array('status'            => 1,
                          'type'              => 'traveler',
                          'id'                => $this->user->getId(),
                          'first_name'        => $this->user->getFirstName(),
                          'last_name'         => $this->user->getLastName(),
                          'birth_date'        => $this->toTimeStamp($this->user->getBirthdate()),
                          'mobile_number'     => $this->user->getContactNumber(),
                          'telephone_number'  => $this->user->getTelephoneNumber()?:'',
                          'agent'             => $agent,
                          'profile_pic'       => $this->getProfilePic($this->user->getProfilePicture()),
                          'expiry'            => $this->getCodeExpiry());
            }

        return $data;
    }

    public function getFlightData($criteria = array())
    {
        $flights  = $this->flight_manager->findByAgent($this->user->getId());

        $flight_data = $this->normalizeFields($flights);

        $adapter  = new ArrayAdapter($flight_data);
        $pager    = new Pagerfanta($adapter);
        $pager->setMaxPerPage($criteria['limit'] ? $criteria['limit'] : 5); // 5 by default

        $pager->setCurrentPage($criteria['page'] ? $criteria['page'] : 1); // 1 by default
        $nbResults          = $pager->getNbResults();
        $currentPageResults = $pager->getCurrentPageResults();
        
        return array('flights' => $currentPageResults,'total_result' => $nbResults, 'has_next' => $pager->hasNextPage());
    }

    protected function normalizeFields($data)
    {
        $formatted_api_data = array();

        foreach($data as $flight_data)
        {
            $api_data = array();
            $api_data['id']                                 = $flight_data->getId();
            $api_data['title']                              = $flight_data->getTitle();
            $api_data['origin']                             = $flight_data->getOrigin();
            $api_data['destination']                        = $flight_data->getDestination();
            $api_data['departure_schedule']                 = $this->toTimeStamp($flight_data->getOriginDepartureSchedule());
            $api_data['arrival_schedule']                   = $this->toTimeStamp($flight_data->getDestinationArrivalSchedule());
            $api_data['origin_departure_calendar_note']     = $flight_data->getOriginDepartureCalendarNote();
            $api_data['destination_departure_calendar_note']= $flight_data->getDestinationDepartureCalendarNote();
            $api_data['origin_timezone']                    = $flight_data->getOriginTimezone();
            $api_data['destination_timezone']               = $flight_data->getDestinationTimezone();

            $formatted_api_data[] = $api_data;
        }

        return $formatted_api_data;
    }


    public function getFlightItineraryData($flight_id, $criteria = array())
    {
        $flight                     =  $this->flight_manager->findOneBy(array('id' => $flight_id));
        $itineraries                = $flight->getItineraries();
        $api_data_itineraries       = $this->normalizeFlightItineraryFields($itineraries);

        $adapter  = new ArrayAdapter($api_data_itineraries);
        $pager    = new Pagerfanta($adapter);
        $pager->setMaxPerPage($criteria['limit'] ? $criteria['limit'] : 5); // 5 by default

        $pager->setCurrentPage($criteria['page'] ? $criteria['page'] : 1); // 1 by default
        $nbResults          = $pager->getNbResults();
        $currentPageResults = $pager->getCurrentPageResults();

        return array('itineraries' => $currentPageResults,'total_result' => $nbResults, 'has_next' => $pager->hasNextPage());
    }

    protected function normalizeFlightItineraryFields($itineraries)
    {
        $data =  array();
        if($itineraries)
        {
            foreach($itineraries as $itinerary)
            {
                $_itinerary = array();
                $_itinerary['title']          =  $itinerary->getTitle();
                $_itinerary['schedule']       =  $this->toTimeStamp($itinerary->getSchedule());
                $_itinerary['activity']       =  $itinerary->getActivity();
                $_itinerary['calendar_note']  =  $itinerary->getCalendarNote();
                $_itinerary['timezone']       =  $itinerary->getTimezone();

                $data[] = $_itinerary;
            }
        }

        return $data;
    }

    public function getActiveFlight()
    {
        if($this->user instanceof User)
        {
            $result =  $this->flight_manager->getActiveFlight($this->user->getId());
        }else{
            $traveler_flight = $this->flight_traveler_manager->getActiveAgentFlight($this->access_code);
            $result          =  $traveler_flight->getFlight();
            return $this->normalizeActiveFlight($result,false);
        }

        return $this->normalizeActiveFlight($result);
    }

    protected function normalizeActiveFlight($result,$array = true)
    {
        $data = array();
        if($array){
            if(isset($result[0]))
            {
                $data['id']                                     = $result[0]->getId();
                $data['title']                                  = $result[0]->getTitle();
                $data['origin']                                 = $result[0]->getOrigin();
                $data['destination']                            = $result[0]->getDestination();
                $data['origin_departure_schedule']              = $this->toTimeStamp($result[0]->getOriginDepartureSchedule());
                $data['destination_arrival_schedule']           = $this->toTimeStamp($result[0]->getDestinationArrivalSchedule());
                $data['destination_departure_schedule']         = $this->toTimeStamp($result[0]->getDestinationDepartureSchedule());
                $data['origin_arrival_schedule']                = $this->toTimeStamp($result[0]->getOriginArrivalSchedule());
                $data['origin_departure_calendar_note']         = $result[0]->getOriginDepartureCalendarNote();
                $data['destination_departure_calendar_note']    = $result[0]->getDestinationDepartureCalendarNote();
                $data['origin_timezone']                        = $result[0]->getOriginTimezone();
                $data['destination_timezone']                   = $result[0]->getDestinationTimezone();
                $data['connecting_flights']                     = $this->getConnectingFlights($result[0]);

            }
        }else{
            $data['id']                                     = $result->getId();
            $data['title']                                  = $result->getTitle();
            $data['origin']                                 = $result->getOrigin();
            $data['destination']                            = $result->getDestination();
            $data['origin_departure_schedule']              = $this->toTimeStamp($result->getOriginDepartureSchedule());
            $data['destination_arrival_schedule']           = $this->toTimeStamp($result->getDestinationArrivalSchedule());
            $data['destination_departure_schedule']         = $this->toTimeStamp($result->getDestinationDepartureSchedule());
            $data['origin_arrival_schedule']                = $this->toTimeStamp($result->getOriginArrivalSchedule());
            $data['origin_departure_calendar_note']         = $result->getOriginDepartureCalendarNote();
            $data['destination_departure_calendar_note']    = $result->getDestinationDepartureCalendarNote();
            $data['origin_timezone']                        = $result->getOriginTimezone();
            $data['destination_timezone']                   = $result->getDestinationTimezone();
            $data['connecting_flights']                     = $this->getConnectingFlights($result);

        }

        return $data;
    }

    public function getFlight($flight_id)
    {
        $flight =  $this->flight_manager->findOneBy(array('id' => $flight_id));
        $data   = array();

        if($flight)
        {
            $data['title']                                  = $flight->getTitle();
            $data['origin']                                 = $flight->getOrigin();
            $data['destination']                            = $flight->getDestination();
            $data['origin_departure_schedule']              = $this->toTimeStamp($flight->getOriginDepartureSchedule());
            $data['destination_arrival_schedule']           = $this->toTimeStamp($flight->getDestinationArrivalSchedule());
            $data['destination_departure_schedule']         = $this->toTimeStamp($flight->getDestinationDepartureSchedule());
            $data['origin_arrival_schedule']                = $this->toTimeStamp($flight->getOriginArrivalSchedule());
            $data['origin_departure_calendar_note']         = $flight->getOriginDepartureCalendarNote();
            $data['destination_departure_calendar_note']    = $flight->getDestinationDepartureCalendarNote();
            $data['origin_timezone']                        = $flight->getOriginTimezone();
            $data['destination_timezone']                   = $flight->getDestinationTimezone();
            $data['connecting_flights']                     = $this->getConnectingFlights($flight);
        }

        return $data;
    }

    public function getFlightTravelers($flight_id)
    {
        $flight      =  $this->flight_manager->findOneBy(array('id' => $flight_id));
        $travelers   = array();

        if($flight)
        {
             foreach($flight->getTravelers() as $flight_traveler)
             {
                 $traveler_info = array();
                 $traveler      = $flight_traveler->getTraveler();
                 $traveler_info['first_name']       = $traveler->getFirstName();
                 $traveler_info['last_name']        = $traveler->getLastName();
                 $traveler_info['last_name']        = $traveler->getLastName();
                 $traveler_info['email']            = $traveler->getEmail();
                 $traveler_info['contact_number']   = $traveler->getContactNumber();
                 $travelers[] = $traveler_info;
             }
        }

        return $travelers;
    }

    protected function toTimeStamp($date)
    {
        if(is_object($date))
        {
            $raw_date = $date->getTimestamp();
        }else{
            $raw_date = strtotime($date);
        }

        return $raw_date;
    }

    protected function getTravelerAgent()
    {
        $access_code     = $this->access_code;
        $flight_traveler = $this->flight_traveler_manager->findOneBy(array('code' => $access_code));
        $flight          = $flight_traveler->getFlight();
        $agent           = $flight->getTravelAgent();

        $data   = array();
        $data['first_name']         = $agent->getFirstname();
        $data['last_name']          = $agent->getLastname();
        $data['contact_number']     = $agent->getPhone();
        $data['telephone_number']    = $agent->getTelephoneNumber();
        $data['email']              = $agent->getEmail();
        $data['profile_pic']        = $this->getProfilePic($agent->getProfilePicture());

        return $data;
    }

    protected  function getProfilePic($pic)
    {
        if(!$pic)
        {
            return '';
        }

        $image =  $this->container->get('request')->getSchemeAndHttpHost().$this->container->get('sonata.media.twig.extension')->path($pic, 'small');

        $type  = pathinfo($image, PATHINFO_EXTENSION);
        $data  = file_get_contents($image);
        $image = base64_encode(base64_encode($data));
        return $image;
    }

    protected function getCodeExpiry()
    {
        $traveler_flight = $this->flight_traveler_manager->getActiveAgentFlight($this->access_code);
        $expiry_date   = '';
        if($traveler_flight)
        {
            $active_flight = $traveler_flight->getFlight();
            $expiry_date   = $this->toTimeStamp($active_flight->getOriginArrivalSchedule());
        }
        return  $expiry_date;
    }

    protected function getConnectingFlights($flight)
    {
        $connecting_flights = $flight->getConnectingFlights();
        $data    = array();
        if($connecting_flights)
        {
           foreach($connecting_flights as $connecting_flight)
           {
               if($connecting_flight->getType() == 'TO')
               {
                    if(!isset($data['TO']))
                    {
                        $data['TO'] = array();
                    }

                    $data['TO'][] = array('destination'      => $connecting_flight->getDestination(),
                                         'arrival_schedule'  => $this->toTimeStamp($connecting_flight->getArrivalSchedule()),
                                         'calendar_note'     => $connecting_flight->getCalendarNote(),
                                         'timezone'          => $connecting_flight->getTimezone());
               }else{
                   if(!isset($data['FROM']))
                   {
                       $data['FROM'] = array();
                   }

                   $data['FROM'][] = array('destination'      => $connecting_flight->getDestination(),
                                           'arrival_schedule'  => $this->toTimeStamp($connecting_flight->getArrivalSchedule()),
                                           'calendar_note'     => $connecting_flight->getCalendarNote(),
                                           'timezone'          => $connecting_flight->getTimezone());
               }
           }
        }

        return $data;
    }

    public function setRatings(\Symfony\Component\HttpFoundation\Request $request)
    {
        $hotel           = $request->get("hotel",0);
        $food            = $request->get("food",0);
        $tour            = $request->get("tour",0);
        $travelEscort    = $request->get("travelEscort",0);
        $tourGuide       = $request->get("tourGuide",0);
        $localGuide      = $request->get("localGuide",0);
        $tourBus         = $request->get("tourBus",0);
        $service         = $request->get("service",0);
        $travelerName    = $request->get("travelerName",0);
        $rating_date     = $request->get("date",0);
        $comment         = $request->get("comment",'');

        $traveler_name = $this->user->getFirstName() ." " . $this->user->getLastName();

        $rate =  $this->rate_manager->create();
        $rate->setHotel($hotel);
        $rate->setFood($food);
        $rate->setTour($tour);
        $rate->setTravelEscort($travelEscort);
        $rate->setTourGuide($tourGuide);
        $rate->setLocalGuide($localGuide);
        $rate->setTourBus($tourBus);
        $rate->setService($service);
        $rate->setRatingDate(new \DateTime($rating_date));
        $rate->setTravelerName($traveler_name);
        $rate->setTraveler($this->user);
        $rate->setComment($comment);

        $this->rate_manager->save($rate);
    }

}
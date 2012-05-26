<?php
/*
 * The web services for the javascript client
 * http://www.coasterq.com/index/services/
 */
class Services extends Controller
{
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------

    /**
     * The contructor for the web services
     * 
     * This loads all the models needed for all the services
     */
	function Services()
	{
		parent::Controller();
		
		$this->load->model('ride_model');
		$this->load->model('parkclock_model');
		$this->load->model('itinerary_model');
		$this->load->model('rideWait_model');
		$this->load->helper('cookie');
		$this->load->model('user_model');
		$this->load->model('users_online_model');
		$this->load->model('property_model');
		$this->load->model('friendstatus_model');
	}

	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------

	/**
	 * The default web services page
	 */
	public function index()
	{
		//
		// Do nothing
		//
	}

	public function logOutUser()
	{
		$this->user_model->logOutUser();
		
		echo "Success";
	}
	
	public function logInUser()
	{
		$facebookUserId = $this->input->post('facebookuserid');

		if($this->user_model->logInUser($facebookUserId))
		{
			echo "new user";
		}
		else
		{
			echo "returning user";
		}
	}
	
	public function getUserFriendsRideStatus()
	{
		$friendStatuses = 
			$this->friendstatus_model->getUserFriendsRideStatus();
		
		echo $this->createJsonArray($friendStatuses);
	}
	
	/**
	 * Update the server with the current rides in the itinerary
	 *
	 * itineraryRides - variable pasted in the post method that contains
	 * all the current rides and priorities
	 * 
	 * The accepted formate is:
	 * [ride priority]-[ride id],[ride priority]-[ride id], ....
	 * 
	 */
	public function updateItinerary()
	{
		$user = $this->user_model->getUser();

		if($user)
		{
			$updatedItineraryRidesText = $this->input->post('itineraryRides');
			
			if(!$updatedItineraryRidesText)
			{
				$updatedItineraryRidesText = $this->input->get('itineraryRides');
			}
			
			$updatedItineraryRides = $this->readItineraryRidesText(
				$updatedItineraryRidesText);

			$currentItineraryRides =
				$this->itinerary_model->getItineraryRides($user);

			foreach($currentItineraryRides as $itineraryRide)
			{
				$matchingItineraryRide = $this->getMatchingItineraryRide(
					$updatedItineraryRides, $itineraryRide);

				if($matchingItineraryRide !== null)
				{
					if($itineraryRide->getPriority() !=
					$matchingItineraryRide->getPriority())
					{
						$itineraryRide->setPriority(
						$matchingItineraryRide->getPriority());

						$itineraryRide->save();
					}
				}
				else
				{
					$itineraryRide->delete();
				}
			}

			foreach($updatedItineraryRides as $itineraryRide)
			{
				if(!$this->getMatchingItineraryRide(
					$currentItineraryRides, $itineraryRide))
				{
					$rideIdToAdd = $itineraryRide->getRideId();
					$priority = $itineraryRide->getPriority();

					$ride = RidePeer::retrieveByPK($rideIdToAdd);
					$this->itinerary_model->addItineraryRide(
					$user, $ride, $priority);
				}
			}

			echo "success";
		}
		else
		{
			$this->load->view('forbidden');
		}
	}

	/**
	 * The web service method to enter ride times
	 * All inputs are from the post method
	 * 
	 * The post label are:
	 * rideId - the id of the ride
	 * waitmin - the total time of the ride wait in minutues 
	 * timehour - the time of the day's hour of the wait time entered
	 * timemin - the time of the day's minutues of the wait time entered
	 * dayofmonth - the day of the month of the wait time entered 
	 * month - the month of the year of the wait time entered
	 * year - the year of the wait time entered
	 * 
	 * This method does validate if the ride time is allowed. 
	 * 
	 */
	public function enterTimeForRide()
	{
		$user = $this->user_model->getUser();

		if($user)
		{
			$rideId = $this->input->post('rideId');
			$waitMin = $this->input->post('waitmin');
			$timeHour = $this->input->post('timehour');
			$timeMin = $this->input->post('timemin');
			$dayOfMonth = $this->input->post('dayofmonth');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$isInsidePark = $this->input->post('isinsidepark');
			$latitude = $this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			
			$dayOfMonth = (int) $dayOfMonth;

			if($this->rideWait_model->isRideWaitValid($user, $rideId, $waitMin,
				$timeMin, $timeHour, $dayOfMonth, $month, $year))
			{
				$date = mktime($timeHour, $timeMin, 0, 
					$month, $dayOfMonth, $year);

				$this->rideWait_model->addRideWait(
					$user, $rideId, $date, $waitMin, 
					$isInsidePark, $latitude, $longitude);

				echo "success";
			}
			else
			{
				echo "invalid";		
			}
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	
	public function getParkInformation()
	{
		$output = "[";
		
		$array_store = array ();
    
        $array_store["parkName"] = $this->property_model->getParkName();
        $array_store["isFasspassAvailable"] = $this->property_model->getIsFasspassAvailable();
    	$array_store["latitude"] = $this->property_model->getLatitude();
    	$array_store["longitude"] = $this->property_model->getLongitude();
        
        $output .= json_encode($array_store);
		
		$output .= "]";
				
		echo $output;
	}

	/**
	 * Get an update of the park clock from the server to the client
	 * 
	 * The format that is 
	 * minutes '-' hours '-' the day of the month '-' month '-' year  
	 * 
	 */
	public function getClockUpdate()
	{
		$parkClock = $this->parkclock_model->getParkClock();

		$output = "[";

		$output .= $parkClock->toJson();
		
		$output .= "]";
				
		echo $output;
	}

	/**
	 * Get an update of the ride time from the server to the client
	 * 
	 * The format that is ride id '-' current wait in minutes '-' 
	 * average wait in minutes '-' shortest wait time of day hour '-' 
	 * shortest wait time of day min '-' next shortest wait time in minutes
	 * 
	 * The ride are seperated by a comma ','
	 */
	public function getRidesUpdate()
	{
		$rides = $this->ride_model->getRides();
		$output = "";
		foreach($rides as $ride)
		{
			//$dateTime = $ride->getNextshortestdatetime($ride);
			$hour = 2;//date("G",$dateTime);
			$min = 2;//date("i",$dateTime);

			$output .= $ride->getId() . "-" . 
				$ride->getCurrentwaittime() .
            	"-" . $ride->getAverageWaitTime() . "-" . $hour . 
            	"-" . $min . "-" . 
				$ride->getNextshortestwaittime() . ",";
		}
		echo substr($output, 0, -1);
	}
	
	 /**
     * 
	 */
	public function getParkOpenRanges()
	{
		$parkClock = $this->parkclock_model->getParkClock();

		echo $this->createJsonArray($parkClock->getParkOpenRanges());
	}
	
    /**
     * 
	 */
	public function getInitialRides()
	{
		$rides = $this->ride_model->getRides();
		
		echo $this->createJsonArray($rides);
	}
	
	/**
     * 
	 */
    public function getInitialItineraryRides()
    {
        $user = $this->user_model->getUser();
    
        $itineraryRides =
        	$this->itinerary_model->getItineraryRidesSortedByPriority($user);
    
        echo $this->createJsonArray($itineraryRides);
	}
	
	/*
	 * Get the number of users online
	 */
	public function getUsersOnline()
	{
		echo $this->users_online_model->getNumberOfUsersOnline();
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------

	private function createJsonArray($jsonArray)
	{
		$output = "[";

		foreach($jsonArray as $jsonObject)
		{
			$output .= $jsonObject->toJson() . ",";
		}

		if(strlen($output) > 1)
		{
			$output = substr($output, 0, strlen($output) - 1);
		}

		$output .= "]";
		
		return $output;
	}
	
	private function readItineraryRidesText($updatedItineraryRidesText)
	{
		$itineraryRides = array();
		if($updatedItineraryRidesText != "")
		{
			foreach(explode(",", $updatedItineraryRidesText) as $itineraryRideItem)
			{
				$item = explode("-", $itineraryRideItem);
	
				$itineraryRide = new ItineraryRide();
	
				$itineraryRide->setPriority($item[0]);
	
				$itineraryRide->setRideId($item[1]);
	
				$itineraryRides[] = $itineraryRide;
			}
		}

		return $itineraryRides;
	}

	private function getMatchingItineraryRide($itineraryRides,
		$lookForItineraryRide)
	{
		$matchingItineraryRide = null;

		foreach($itineraryRides as $itineraryRide)
		{
			if($itineraryRide->getRideId() ==
			$lookForItineraryRide->getRideId())
			{
				$matchingItineraryRide = $itineraryRide;
			}
		}

		return $matchingItineraryRide;
	}
}

?>

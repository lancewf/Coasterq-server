<?php


/**
 * This class handels all the user interaction from the ride list page. 
 */
class EnterRideTimeServices extends Controller
{
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------

    /**
     * The contructor for the web services
     * 
     * This loads all the models needed for all the services
     */
	function EnterRideTimeServices()
	{
		parent::Controller();
		
		$this->load->model('ride_model');
		$this->load->model('parkclock_model');
		$this->load->model('itinerary_model');
		$this->load->model('rideWait_model');
		$this->load->helper('cookie');
		$this->load->model('user_model');
		$this->load->model('users_online_model');
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
	
	/**
	 * Add a ride to the user's itinerary
	 */
	public function addRideWaitTime()
	{
		$user = $this->user_model->getUser();

		if($user)
		{
			$rideId = $this->input->post('rideId');
			$waitMin = $this->input->post('wait_min');
			$waitHour = $this->input->post('wait_hour');
			$timeHour = $this->input->post('time_hour');
			$timeMin = $this->input->post('time_min');
			$amPm = $this->input->post('am_pm');

			$waitMin += $waitHour * 60;
			
			$parkClock = $this->parkclock_model->getParkClock();
			
            if ($amPm == "pm")
            {
                if ($timeHour != 12)
                {
                    $timeHour = $timeHour + 12;
                }
            }
            else
            {
                if ($timeHour == 12)
                {
                    $timeHour = 0;
                }
            }

			if($this->rideWait_model->isRideWaitValid($user, $rideId, $waitMin,
				$timeMin, $timeHour, $parkClock->getDayOfMonth(), 
				$parkClock->getMonth(), $parkClock->getYear()))
			{
				$date = mktime($timeHour, $timeMin, 0, 
					$parkClock->getMonth(), $parkClock->getDayOfMonth(), 
					$parkClock->getYear());

				$this->rideWait_model->addRideWait(
					$user, $rideId, $date,  $waitMin);
			}
			
			redirect('/main/myq', 'refresh');
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------

	private function doesContainItineraryRide($rideId, $user, $itineraryRides)
	{
		foreach($itineraryRides as $itineraryRide)
		{
			if($itineraryRide->getRide()->getId() == $rideId)
			{
				return true;
			}
		}
		
		return false;
	}
}

?>
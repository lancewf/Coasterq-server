<?php


/**
 * This class handels all the user interaction from the ride list page. 
 */
class RideListServices extends Controller
{
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------

    /**
     * The contructor for the web services
     * 
     * This loads all the models needed for all the services
     */
	function RideListServices()
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
	public function addItineraryRide()
	{
		$user = $this->user_model->getUser();
		if($user)
		{
			$rideId = $this->input->post('rideid');

			$itineraryRides =
				$this->itinerary_model->getItineraryRides($user);
				
			if(!$this->doesContainItineraryRide($rideId, $user, $itineraryRides))
			{
				$ride = RidePeer::retrieveByPK($rideId);
				$this->itinerary_model->addItineraryRide(
					$user, $ride, count($itineraryRides) + 1);	
			}
		}
		
		redirect('/main/rides', 'refresh');
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
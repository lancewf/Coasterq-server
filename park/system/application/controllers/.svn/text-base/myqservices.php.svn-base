<?php



class MyQServices extends Controller
{
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------

    /**
     */
	function MyQServices()
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

	 */
	public function updateItinerary()
	{
		$user = $this->user_model->getUser();
		if($user)
		{
			$itineraryRides =
				$this->itinerary_model->getItineraryRides($user);

			$changedPriorityList = array();
			$notChangedPriorityList = array();
			
			for($index = 1; $index <= count($itineraryRides); $index++)
			{
				$needsRemoved = $this->input->post('remove' . $index);
				
				$itineraryRide = 
						$this->getItineraryRideFromPriority(
						$itineraryRides, $index);
				if($needsRemoved)
				{
					$itineraryRide->delete();
				}
				else
				{
					$pagePriority = $this->input->post('Priority' . $index);
					
					if($pagePriority != $index)
					{
						$clone = clone $itineraryRide;
						$clone->setPriority($pagePriority);
						array_push($changedPriorityList, $clone);
					}
					else
					{
						array_push($notChangedPriorityList, $itineraryRide);
					}
				}
			}
			
			usort($changedPriorityList, array("MyQServices", "itineraryCompare"));
			usort($notChangedPriorityList, array("MyQServices", "itineraryCompare"));
			
			$finialPriorityListing = array();
			
			$index = 1;
			while(true)
			{
				if(count($changedPriorityList) == 0)
				{
	                while(count($notChangedPriorityList) > 0)
	                {
	                	$itineraryRide = array_shift($notChangedPriorityList);
	                	
						$itineraryRide->setPriority($index);
							
	                    array_push($finialPriorityListing, $itineraryRide);
	                    $index++;
	                }
					break;
				}
				if(count($notChangedPriorityList) == 0)
				{
	                while(count($changedPriorityList) > 0)
	                {
	                	$itineraryRide = array_shift($changedPriorityList);
	                	
						$itineraryRide->setPriority($index);
							
	                    array_push($finialPriorityListing, $itineraryRide);
	                    $index++;
	                }
					break;
				}
				
				if($index >= $changedPriorityList[0]->getPriority())
				{
					$itineraryRide = array_shift($changedPriorityList);
					
					$itineraryRide->setPriority($index);
					
					array_push($finialPriorityListing, $itineraryRide);
				}
				else
				{
					$itineraryRide = array_shift($notChangedPriorityList);
					
					$itineraryRide->setPriority($index);
					
					array_push($finialPriorityListing, $itineraryRide);
					
				}
				$index++;
			}
		}
		
		foreach($finialPriorityListing as $itineraryRide)
		{
			$itineraryRide->save();
		}
		redirect('/main/myq', 'refresh');
	}
	
	
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	static function itineraryCompare($itinerary1, $itinerary2)
	{
		if($itinerary1->getPriority() > $itinerary2->getPriority())
		{
			return 1;
		}
		else if($itinerary1->getPriority() > $itinerary2->getPriority())
		{
			return -1;
		}
		else
		{
			return 0;
		}
	}
	
	private function getItineraryRideFromPriority($itineraryRides, $priority)
	{
		foreach($itineraryRides as $itineraryRide)
		{
			if($itineraryRide->getPriority() == $priority)
			{
				return $itineraryRide;
			}
		}
		
		return null;
	}
	
}

?>
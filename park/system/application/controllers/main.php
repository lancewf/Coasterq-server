<?php

/*
 * The main controller page of the park. 
 * 
 * This page allows the user to come in with 
 * 
 * www.[park name].coasterq.com/index.php/myq
 * www.[park name].coasterq.com/index.php/enterridetime
 * www.[park name].coasterq.com/index.php/rides
 * 
 * for the www.[park name].coasterq.com/index.php/myq URL the user's opening page
 * starts with the user's que of rides. 
 * 
 * for the www.[park name].coasterq.com/index.php/enterridetime URL the user's
 * opening page starts with the enter ride wait times view. 
 * 
 * for the www.[park name].coasterq.com/index.php/rides URL the opening page
 * starts with the ride search page. 
 * 
 */
class Main extends Controller
{
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	function Main()
	{
		parent::Controller();
		
		$this->load->model('parkclock_model');
		$this->load->model('ride_model');
		$this->load->model('user_model');
		$this->load->model('itinerary_model');
		$this->load->model('users_online_model');
		$this->load->model('property_model');
	}

	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	/**
	 * The default page for the park page
	 * www.[park name].coasterq.com/
	 * www.[park name].coasterq.com/index.php/
	 */
	public function index()
	{
		$this->myq();
	}

	/**
	 * The web address that starts the advanced ride page 
	 * www.[park name].coasterq.com/index.php/rides
	 */
	public function rides()
	{
		$this->loadPage('rides');
	}

	/**
	 * The web address that starts the enter ride time page
	 * www.[park name].coasterq.com/index.php/enterridetime
	 */
	public function enterridetime()
	{
		$this->loadPage('enterridetime');
	}
	
	/**
	 * The web address that starts the user in their queue 
	 * www.[park name].coasterq.com/index.php/myq
	 */
	public function myq()
	{
		$this->loadPage('myq');
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------

	/**
	 * Load the client javascript page
	 * 
	 * @param $startPage The page that is loaded to start
	 */
	private function loadPage($startPage)
	{
	   $data = $this->getData();
  	   $data['startPage'] = $startPage;
  	   
	   $this->load->view('index', $data);
	}
	
	/**
	 * Get the data for the javascript client
	 */
	private function getData()
	{
		$user = $this->user_model->getOrCreateUser();
		$data['rides'] = $this->ride_model->getRides();
		$data['itineraryRides'] = 
			$this->itinerary_model->getItineraryRidesSortedByPriority($user);
		$data['usersOnline'] = $this->users_online_model->getNumberOfUsersOnline();
	    $data['parkClock'] = $this->parkclock_model->getParkClock();
		$data['parkName'] = $this->property_model->getParkName();
		$data['homeUrl'] = $this->property_model->getHomeURL();
		$data['isFasspassAvailable'] = $this->property_model->getIsFasspassAvailable();
		
		return $data;	
	}
	
	/**
	 * Is the client using an iphone
	 */
	private function isIPhone()
	{
	   $browserInfo = $_SERVER['HTTP_USER_AGENT'];
	   
	   return strstr(strtolower($browserInfo), 'iphone'); 
	}
	
	/**
	 * Is the client using a Microsoft mobile browser
	 *
	 * @return true if the client is using a mobile browser, false otherwise. 
	 */
	private function isMobile()
	{
	   $browserInfo = $_SERVER['HTTP_USER_AGENT'];
	   return strstr(strtolower($browserInfo), "mobile");
	}
}
?>

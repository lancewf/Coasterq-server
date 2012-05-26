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
		
		$this->load->model('facebook_model');
		$this->load->model('park_model');
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
	
	public function getAllEnteredRideWaits()
	{
		$enteredRideWaits = $this->facebook_model->getAllEnteredRideWaits();
		
		echo $this->createJsonArray($enteredRideWaits);
	}
	
	public function getParkInfoAddress()
	{
		$parks = $this->park_model->getParks();
		
		echo $this->createJsonArray($parks);
	}
	
	public function getNumberOfUsersOnline()
	{
		$original =  (int)$this->users_online_model->getNumberOfUsersOnline();
		
		$original += 6;
		$original *= 6;
		
		echo $original;
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
}

?>

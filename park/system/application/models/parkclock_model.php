<?php

require_once('calculator/ParkClock.php');

/**
 * This park clock model manages the current time at the park and when the park
 * is close and open. 
 */
class Parkclock_model extends Model 
{	
	// -------------------------------------------------------------------------
	// Data
	// -------------------------------------------------------------------------
	
	private $parkClock;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getParkClock()
	{
		if($this->parkClock == null)
		{
			$this->parkClock = new ParkClock();
		}
		
		return $this->parkClock;
	}
}

?>
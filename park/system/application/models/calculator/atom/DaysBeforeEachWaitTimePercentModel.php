<?php


/**
 * This class represents the model of what percentage of the base should be
 * adjusted base off of how many days back the day is from the current day. 

 1 | *                     *  
.9 |                              
.8 |     *                     
.7 |                    *                   
.6 |         *       *                              *     
.5 |             *            *                 *               
.4 |                             *          *                 
.3 |                                *   *                         
.2 |                                                      
.1 |                                                      
 0 |                                                        
 -----------------------------------------------------
     1   2   3   4   5  6  7  8  9  10  11  12  13  14
 
 */
class DaysBeforeEachWaitTimePercentModel
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $model = array();
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct()
	{
		$this->model[1] = 1; // one day before the current day
		$this->model[2] = .8;
		$this->model[3] =.6;
		$this->model[4] =.5;
		$this->model[5] =.6;
		$this->model[6] =.75;
		$this->model[7] = 1; // One week before the current day
		$this->model[8] = .5;
		$this->model[9] =.35;
		$this->model[10] =.3;
		$this->model[11] =.3;
		$this->model[12] =.35;
		$this->model[13] =.5;
		$this->model[14] =.6; // Two weeks before the current day. 
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getPercentage($daysBackFromCurrent)
	{
		return $this->model[$daysBackFromCurrent];
	}
}

?>
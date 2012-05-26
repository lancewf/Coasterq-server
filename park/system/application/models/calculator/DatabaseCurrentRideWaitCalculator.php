<?php

require_once('atom/WeightingAverage.php');

class DatabaseCurrentRideWaitCalculator
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $calcAtomBuilder;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
 	function __construct($rideWaitRetriever, $parkClock, 
		$crowdLevelCalculator, $calcAtomBuilder)
	{	
		$this->calcAtomBuilder = $calcAtomBuilder;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function calculateCurrentWaitTime($ride)
	{
		$weightingAverage = new WeightingAverage(0, 0);
		
		$calcAtoms = $this->calcAtomBuilder->build();
        foreach ($calcAtoms as $atom)
        {
            $newWeightingAverage = $atom->getCalc($ride);
    
			$weightingAverage = $weightingAverage->merge($newWeightingAverage);
			
			if($weightingAverage->isComplete())
			{
				break;
			}
        }
    
        return $weightingAverage;
	}
}

?>
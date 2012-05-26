<?php

class CurrentRideWaitCalculator
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $currentRideWaitModel;
	private $databaseCurrentRideWaitCalculator;
 	private $parkClock;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
 	function CurrentRideWaitCalculator($rideWaitRetriever, $parkClock, 
		$currentRideWaitModel, $crowdLevelCalculator, 
		$databaseCurrentRideWaitCalculator)
	{
		$this->parkClock = $parkClock;
		$this->currentRideWaitModel = $currentRideWaitModel;
		$this->databaseCurrentRideWaitCalculator = 
			$databaseCurrentRideWaitCalculator;
	}
	
 	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	/**
	 * This method first uses the database's user entered time and predicts the 
	 * wait time and averages it with the model wait time.  
	 * 
	 * @return 
	 * @param object $ride
	 */
	public function calculateCurrentWaitTime($ride)
	{
        if ($this->parkClock->isOpen())
        {
            $databaseWeightingAverage = 
            	$this->databaseCurrentRideWaitCalculator->
				calculateCurrentWaitTime($ride);

			$modelWeightingAverage = $this->getModelCurrentWait($ride);
			
			$finalWeightingAverage = 
				$databaseWeightingAverage->merge($modelWeightingAverage);
			
			$finalAverageTime = $finalWeightingAverage->getAverageWaitTime();
			
			//round to the nearest integer
			return round($finalAverageTime, 0);
        }
		else
		{
			return -1;	
		}
	}
	
	private function getModelCurrentWait($ride)
	{
		$modelWaitTime = 
			$this->currentRideWaitModel->getCurrentWait($ride);
			
		// putting the weighting at 1 allows the left over weighting from 
		// the database calculation to be filled in by the model calculation
		$modelWeightingAverage = new WeightingAverage($modelWaitTime, 1);
		
		return $modelWeightingAverage;
	}
}
	
?>
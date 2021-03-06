<?php

require_once('FuzzySet.php');
		
class CurrentRideWaitModel
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $crowdLevelCalculator;
	private $parkClock;
	private $waitTimesHighFromTimeOfDayfuzzySet;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
 	function CurrentRideWaitModel($crowdLevelCalculator, $parkClock)
	{		
		$this->crowdLevelCalculator = $crowdLevelCalculator;
		$this->parkClock = $parkClock;
		$this->waitTimesHighFromTimeOfDayfuzzySet = new FuzzySet();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
 	
 	/**
 	 * 
 	 * @return WeightingAverage with 100% of the weighting
 	 * 
 	 * @param object $ride
 	 */
	public function getCurrentWait($ride)
	{	
		$baseNumber = $this->getResearchedAverageTime($ride);
		
		return $baseNumber;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function getResearchedAverageTime($ride) 
    { 
        $crowdLevel = $this->crowdLevelCalculator->getCrowdLevelFromParkClock( 
            $this->parkClock); 
		
        if($crowdLevel == CrowdLevelCalculator::CROWD_LEVEL_1)  
        {
            if($ride->getPopularitylevel() == 1)  
            {  
                return $this->adjustForTimeOfDay(10, 5);  
            }  
            else if($ride->getPopularitylevel() == 2)  
            {  
                return $this->adjustForTimeOfDay(15, 5);  
            }  
            else if($ride->getPopularitylevel() == 3)  
            {  
                return $this->adjustForTimeOfDay(20, 5);  
            }  
            else if($ride->getPopularitylevel() == 4)  
            {  
                return $this->adjustForTimeOfDay(30, 5);  
            }  
            else if($ride->getPopularitylevel() == 5)  
            {  
                return $this->adjustForTimeOfDay(45, 5);  
            }  
        } 
        else if($crowdLevel == CrowdLevelCalculator::CROWD_LEVEL_2)  
        {  
            if($ride->getPopularitylevel() == 1)  
            {  
                return $this->adjustForTimeOfDay(15, 5);  
            }  
            else if($ride->getPopularitylevel() == 2)  
            {  
                return $this->adjustForTimeOfDay(20, 5);  
            }  
            else if($ride->getPopularitylevel() == 3)  
            {  
                return $this->adjustForTimeOfDay(30, 5);  
            }  
            else if($ride->getPopularitylevel() == 4)  
            {  
                return $this->adjustForTimeOfDay(45, 5);  
            }  
            else if($ride->getPopularitylevel() == 5)  
            {  
                return $this->adjustForTimeOfDay(55, 5);  
            }  
        }  
        else if($crowdLevel == CrowdLevelCalculator::CROWD_LEVEL_3)  
        {  
            if($ride->getPopularitylevel() == 1)  
            {  
                return $this->adjustForTimeOfDay(20, 5);  
            }  
            else if($ride->getPopularitylevel() == 2)  
            {  
                return $this->adjustForTimeOfDay(30, 5);  
            }  
            else if($ride->getPopularitylevel() == 3)  
            {  
                return $this->adjustForTimeOfDay(45, 5);  
            }  
            else if($ride->getPopularitylevel() == 4)  
            {  
                return $this->adjustForTimeOfDay(65, 10);  
            }  
            else if($ride->getPopularitylevel() == 5)  
            {  
                return $this->adjustForTimeOfDay(75, 15);  
            }  
        }  
        else if($crowdLevel == CrowdLevelCalculator::CROWD_LEVEL_4)  
        {  
            if($ride->getPopularitylevel() == 1)  
            {  
                return $this->adjustForTimeOfDay(30, 5);  
            }  
            else if($ride->getPopularitylevel() == 2)  
            {  
                return $this->adjustForTimeOfDay(45, 10);  
            }  
            else if($ride->getPopularitylevel() == 3)  
            {  
                return $this->adjustForTimeOfDay(75, 15);  
            }  
            else if($ride->getPopularitylevel() == 4)  
            {  
                return $this->adjustForTimeOfDay(90, 15);  
            }  
            else if($ride->getPopularitylevel() == 5)  
            {  
                return  $this->adjustForTimeOfDay(120, 20);  
            }  
        }  
    }
	
	private function adjustForTimeOfDay($highWaitTimeOfDay, $lowWaitTimeOfDay)
	{		
		$secondsInToday = $this->getSecondsInToday();
		
		$memberValue = 
			$this->waitTimesHighFromTimeOfDayfuzzySet->getMemberValue(
			$secondsInToday);
		
		$waitTimeRange = $highWaitTimeOfDay - $lowWaitTimeOfDay;
		
		$additionToLow = $memberValue * $waitTimeRange;
		
		$adjustedWaitTime = $lowWaitTimeOfDay + $additionToLow;
		 
		return $adjustedWaitTime;
	}
	
	/**
	 * Get the number of seconds up to the start of today. 
	 * 
	 * @return 
	 */
	private function getSecondsInToday()
	{
		$timestamp = $this->parkClock->getTime();
		
		$secondsUpToToday = mktime(0, 0, 0, date("m",$timestamp), 
			date("d",$timestamp), date("y",$timestamp));
			
		$secondsInToday = $timestamp - $secondsUpToToday;
		
		return $secondsInToday;
	}
}

?>
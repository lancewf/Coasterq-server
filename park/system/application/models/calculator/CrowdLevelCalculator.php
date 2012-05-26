<?php



class CrowdLevelCalculator
{
	// -------------------------------------------------------------------------
	// Constants
	// -------------------------------------------------------------------------
	
	const CROWD_LEVEL_1 = 1;//lowest level
	const CROWD_LEVEL_2 = 2;
 	const CROWD_LEVEL_3 = 3;
 	const CROWD_LEVEL_4 = 4;//highest level
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
 	
 	public function getCrowdLevelFromParkClock($parkClock)
	{
		$day = $parkClock->getDayOfMonth();
		$month = $parkClock->getMonth();
		$year = $parkClock->getYear();
		
		return $this->getCrowdLevel($day, $month, $year);
	}
	
	public function getCrowdLevelFromTimestamp($timestamp)
	{
		$day = $this->getDayOfMonth($timestamp);
		$month = $this->getMonth($timestamp);
		$year = $this->getYear($timestamp);
		
		return $this->getCrowdLevel($day, $month, $year);
	}
 	
	private function getCrowdLevel($day, $month, $year)
	{
		$date = mktime(0, 0, 0, $month, $day, $year);
		
		$c = new Criteria();
		
		$c->add(ParkDayPeer::DATE, $date);
		
		$parkDays = ParkDayPeer::doSelect($c);
		
		if(count($parkDays) == 1)
		{
			return $parkDays[0]->getCrowdLevel();
		}
		else
		{
			//echo "Error - Geting crowd level ";
			return CrowdLevelCalculator::CROWD_LEVEL_1;
		}
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
 		
	/**
	 * Get the day of the month
	 * @return 
	 */
	private function getDayOfMonth($timestamp)
	{
		return date("j",$timestamp);
	}

	/**
	 * Get the month of the park
	 * @return 
	 */
	private function getMonth($timestamp)
	{
		return date("n",$timestamp);
	}
	
	/**
	 * Get the year of the park
	 * @return 
	 */
	private function getYear($timestamp)
	{
		return date("Y",$timestamp);
	}
}

?>
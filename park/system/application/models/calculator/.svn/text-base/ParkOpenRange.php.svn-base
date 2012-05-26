<?php

/**
 * This object represents a day of the park's open and close time. 
 */
class ParkOpenRange
{
	// -------------------------------------------------------------------------
	// Private Data
	// -------------------------------------------------------------------------
	
	private $openHour;
	private $openMin;
	private $closeHour;
	private $closeMin;
	private $day;
	private $month;
	private $year;
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	/**
	 * Set the hour that the park opens 
	 * @parma 
	 */
	public function setOpenHour($openHour)
	{
		$this->openHour = $openHour;
	}
	
	/**
	 * Sets the minutes in the hour that the park opens
	 * @return 
	 * @param $openMin - the minutes to set. 
	 */
	public function setOpenMin($openMin)
	{
		$this->openMin = $openMin;
	}
	
	/**
	 * Sets the closed hour for the park
	 * @return void 
	 * @param $closeHour - the hour to the park closed
	 */
	public function setCloseHour($closeHour)
	{
		$this->closeHour = $closeHour;
	}
	
	/**
	 * Sets the closed minutes of the hour
	 * 
	 * @return void
	 * @param object $closeMin the minutes of the hour the park closes
	 */
	public function setCloseMin($closeMin)
	{
		$this->closeMin = $closeMin;
	}
	
	/**
	 * The day of the month from 1 - 31 of the date 
	 * @return void
	 * @param object $day the day to set 
	 */
	public function setDay($day)
	{
		$this->day = $day;
	}
	
	public function setMonth($month)
	{
		$this->month = $month;
	}
	
	public function setYear($year)
	{
		$this->year = $year;
	}
	
	public function getOpenHour()
	{
		return $this->openHour;
	}
	
	public function getOpenMin()
	{
		return $this->openMin;
	}
	
	public function getCloseHour()
	{
		return $this->closeHour;
	}
	
	public function getCloseMin()
	{
		return $this->closeMin;
	}
	
	public function getDay()
	{
		return $this->day;
	}
	
	public function getMonth()
	{
		return $this->month;
	}
	
	public function getYear()
	{
		return $this->year;
	}
	
	public function isWithinRange($hour, $min, $day, $month, $year)
	{
		if($this->day == $day && $this->month == $month && $this->year == $year)
		{
			if($hour > $this->openHour && $hour < $this->closeHour)
			{
				return true;
			}
			else if($hour == $this->openHour && $min >= $this->openMin && 
				$this->openHour != $this->closeHour)
			{
				return true;
			}
			else if($hour == $this->closeHour && $min <= $this->closeMin && 
				$this->openHour != $this->closeHour)
			{
				return true;
			}
			else if($this->openHour == $this->closeHour && 
				$hour == $this->closeHour && $min >= $this->openMin && 
				$min <= $this->closeMin)
			{
				return true;
			}
		}

		return false;
	}
	
	public function toJson()
    {
        $array_store = array ();
    
        $array_store["openHour"] = (int)$this->getOpenHour();
        $array_store["openMin"] = (int)$this->getOpenMin();
        $array_store["closeHour"] = (int)$this->getCloseHour();
        $array_store["closeMin"] = (int)$this->getCloseMin();
        $array_store["dayOfMonth"] = (int)$this->getDay();
        $array_store["year"] = (int)$this->getYear();
		$array_store["month"] = (int)$this->getMonth();
    
        return json_encode($array_store);
    }
}

?>
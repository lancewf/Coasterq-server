<?php


class FriendStatus
{
	// -------------------------------------------------------------------------
	// Private Data
	// -------------------------------------------------------------------------
	
	private $facebookUid;
    
    private $dateTime;
    
    private $ride;
    
    private $waitTime;
	
    // -------------------------------------------------------------------------
	// Public Data
	// -------------------------------------------------------------------------
	
	public function toJson()
    {
        $array_store = array ();
    
        $array_store["facebookuid"] = (int)$this->facebookUid;
        $array_store["rideid"] = (int)$this->getRide()->getId();
        $array_store["minutes"] = (int)$this->getMinutes();
        $array_store["hour"] = (int)$this->getHour();
        $array_store["dayOfMonth"] = (int)$this->getDayOfMonth();
        $array_store["month"] = (int)$this->getMonth();
        $array_store["year"] = (int)$this->getYear();
    
        $array_store["waittime"] = (int)$this->getWaitTime();
        
        return json_encode($array_store);
    }
    
    public function getWaitTime()
    {
    	return $this->waitTime;
    }
    
    public function setWaitTime($waitTime)
    {
    	$this->waitTime = $waitTime;
    }
    
    public function getRide()
    {
    	return $this->ride;
    }
    
    public function setRide($ride)
    {
    	$this->ride = $ride;
    }
    
    public function getFacebookUid()
    {
    	return $this->facebookUid;
    }
    
    public function setFacebookUid($facebookUid)
    {
    	$this->facebookUid = $facebookUid;
    }
    
    public function getDateTime()
    {
    	return $this->dateTime;
    }
    
    public function setDateTime($dateTime)
    {
    	$this->dateTime = $dateTime;
    }
    
    /**
	 * Get the current hour of park. 
	 * 
	 * 0 - 23
	 * @return 
	 */
	public function getHour()
	{
		return date("G", $this->dateTime);
	}
	
	/**
	 * Get the current hour of park. 
	 * 
	 * 00 - 59
	 * @return 
	 */
	public function getMinutes()
	{
		return date("i", $this->dateTime);
	}
	
	/**
	 * Get the day of the month
	 * @return 
	 */
	public function getDayOfMonth()
	{
		return date("j", $this->dateTime);
	}

	/**
	 * Get the month of the park
	 * @return 
	 */
	public function getMonth()
	{
		return date("n", $this->dateTime);
	}
	
	/**
	 * Get the year at the park example 2009
	 * @return 
	 */
	public function getYear()
	{
		return date("Y", $this->dateTime);
	}
}

?>
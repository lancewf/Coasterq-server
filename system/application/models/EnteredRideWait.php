<?php


class EnteredRideWait
{
	// -------------------------------------------------------------------------
	// Private Data
	// -------------------------------------------------------------------------
	
    private $dateTime;
    
    private $rideName;
    
    private $facebookUid;
    
    private $waitTime;
    
    private $parkName;
    
    private $parkUrl;
	
    // -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function toJson()
    {
        $array_store = array ();
    
        $array_store["facebookuid"] = (int)$this->facebookUid;
        $array_store["parkname"] = $this->getParkName();
        $array_store["waittime"] = (int)$this->getWaitTime();
        $array_store["ridename"] = $this->getRideName();
        $array_store["parkurl"] = $this->getParkUrl();
        
        $array_store["minutes"] = (int)$this->getMinutes();
        $array_store["hour"] = (int)$this->getHour();
        $array_store["dayOfMonth"] = (int)$this->getDayOfMonth();
        $array_store["month"] = (int)$this->getMonth();
        $array_store["year"] = (int)$this->getYear();
    
        return json_encode($array_store);
    }
    
    public function getParkUrl()
    {
    	return $this->parkUrl;
    }
    
    public function setParkUrl($parkUrl)
    {
    	$this->parkUrl = $parkUrl;
    }
    
    public function getParkName()
    {
    	return $this->parkName;
    }
    
    public function setParkName($parkName)
    {
    	$this->parkName = $parkName;
    }
    
    public function getWaitTime()
    {
    	return $this->waitTime;
    }
    
    public function setWaitTime($waitTime)
    {
    	$this->waitTime = $waitTime;
    }
    
    public function getRideName()
    {
    	return $this->rideName;
    }
    
    public function setRideName($rideName)
    {
    	$this->rideName = $rideName;
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
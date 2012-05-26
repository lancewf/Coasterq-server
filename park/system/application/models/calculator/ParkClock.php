<?php
require_once('persistence/Property.php');
require_once('persistence/PropertyPeer.php');
require_once('ParkOpenRangeBuilder.php');

/*
 * Get the current time at the park. 
 */
class ParkClock
{
	const TIME_DIFFERENCE = "park_time_diff";

	private $timestamp;
	
	private $parkOpenRanges;

	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($timestamp = null)
	{
		if($timestamp == null)
		{
			$timestamp = time();
		
			$timestamp += $this->getTimeDifference() * 60 * 60;
		}
		
		$this->timestamp = $timestamp;
	}
	
	/**
	 * Get the raw time stamp of the park. 
	 * @return 
	 */
	public function getTime()
	{
		return $this->timestamp;
	}
	
	/**
	 * is the park open
	 * 
	 * @return 
	 */
	public function isOpen()
	{	
		foreach($this->getParkOpenRanges() as $parkOpenRange)
		{
			if($parkOpenRange->isWithinRange($this->getHour(), 
					$this->getMinutes(), $this->getDayOfMonth(), 
					$this->getMonth(), $this->getYear()))
			{
				return true;
			}
		}
		
		return false;
	}
	
	public function getParkOpenRanges()
	{
		if($this->parkOpenRanges == null)
		{
			$builder = new ParkOpenRangeBuilder($this);
			
			$this->parkOpenRanges = $builder->build();
		}
		
		return $this->parkOpenRanges;
	}
	
	/**
	 * Get the current hour of park. 
	 * 
	 * 0 - 23
	 * @return 
	 */
	public function getHour()
	{
		$timestamp = $this->getTime();	
		
		return date("G",$timestamp);
	}
	
	/**
	 * Get the current hour of park. 
	 * 
	 * 00 - 59
	 * @return 
	 */
	public function getMinutes()
	{
		$timestamp = $this->getTime();	
		
		return date("i",$timestamp);
	}
	
	/**
	 * Get the day of the month
	 * @return 
	 */
	public function getDayOfMonth()
	{
		$timestamp = $this->getTime();
		
		return date("j",$timestamp);
	}

	/**
	 * Get the month of the park
	 * @return 
	 */
	public function getMonth()
	{
		$timestamp = $this->getTime();
		
		return date("n",$timestamp);
	}
	
	/**
	 * Get the year at the park example 2009
	 * @return 
	 */
	public function getYear()
	{
		$timestamp = $this->getTime();
		
		return date("Y",$timestamp);
	}
	
	public function toJson()
    {
        $array_store = array ();
    
        $array_store["minutes"] = (int)$this->getMinutes();
        $array_store["hour"] = (int)$this->getHour();
        $array_store["dayOfMonth"] = (int)$this->getDayOfMonth();
        $array_store["month"] = (int)$this->getMonth();
        $array_store["year"] = (int)$this->getYear();
    
        return json_encode($array_store);
    }
	
	private function getTimeDifference()
	{
		$value = $this->getValue(ParkClock::TIME_DIFFERENCE);
		
		return intval($value);
	}
	
	private function getValue($name, $type = "")
	{
		$c = new Criteria();
		$c->add(PropertyPeer::NAME, $name);
		$c->addAnd(PropertyPeer::TYPE, $type);
		
		$properties = PropertyPeer::doSelect($c);
		
		if(count($properties) > 0)
		{
			return $properties[0]->getValue();
		}
		else
		{
			return null;
		}
	}
}

?>
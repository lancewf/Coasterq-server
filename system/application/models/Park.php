<?php


class Park
{
	// -------------------------------------------------------------------------
	// Private Data
	// -------------------------------------------------------------------------
	
    private $name;
    
    private $url;
    
    private $latitude;
    
    private $longitude;
    
    private $databaseName;
    
    private $parkClock;
	
    // -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function toJson()
    {
        $array_store = array ();
    
        $array_store["name"] = $this->getName();
        $array_store["url"] = $this->getUrl();
        $array_store["latitude"] = (double)$this->getLatitude();
        $array_store["longitude"] = (double)$this->getLongitude();
    
        return json_encode($array_store);
    }
    
    public function getParkClock()
    {
    	return $this->parkClock;
    }
    
    public function setParkClock($parkClock)
    {
    	$this->parkClock = $parkClock;
    }
    
    public function getName()
    {
    	return $this->name;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    }
    
    public function getUrl()
    {
    	return $this->url;
    }
    
    public function setUrl($url)
    {
    	$this->url = $url;
    }
    
    public function getLatitude()
    {
    	return $this->latitude;
    }
    
    public function setLatitude($latitude)
    {
    	$this->latitude = $latitude;
    }
    
    public function getLongitude()
    {
    	return $this->longitude;
    }
    
    public function setLongitude($longitude)
    {
    	$this->longitude = $longitude;
    }
    
    public function getDatabaseName()
    {
    	return $this->databaseName;
    }
    
    public function setDatabaseName($databaseName)
    {
    	$this->databaseName = $databaseName;
    }
}

?>
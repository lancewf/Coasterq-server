<?php
require_once('Park.php');
require_once('calculator/ParkClock.php');
require_once('database_names_model.php');

class Park_model extends Model
{
	
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	public function Park_model()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getParks()
	{
		$databases = $this->getDatabaseNames();
		
		$parks = array();
		
		foreach($databases as $database)
		{
			$park = new Park();
			
			$park->setDatabaseName($database);
			
			$parkName = $this->getParkName($database);
			
			$park->setName($parkName);
			
			$parkUrl = $this->getParkUrl($database);
			
			$park->setUrl($parkUrl);

			$latitude = $this->getParkLatitude($database);
			
			$park->setLatitude($latitude);
			
			$longitude = $this->getParkLongitude($database);
			
			$park->setLongitude($longitude);
			
			$parkClock = new ParkClock($database);
			
			$park->setParkClock($parkClock);
			
			array_push($parks, $park);
		}
		
		return $parks;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function getDatabaseNames()
	{
		$database_names_model = new Database_names_model();
		$databases = $database_names_model->getDatabaseNames();
		
		return $databases;
	}
	
	private function getParkLongitude($database)
	{
		return $this->getValue("longitude", $database);
	}
	
	private function getParkLatitude($database)
	{
		return $this->getValue("latitude", $database);
	}
	
	private function getParkUrl($database)
	{
		return $this->getValue("url", $database);
	}
	
	private function getParkName($database)
	{
		return $this->getValue("park_name", $database);
	}
	
	private function getValue($name, $database)
	{
		$property = $this->getProperty($name, $database);
		
		if($property != null)
		{
			return $property->getValue();
		}
		else
		{
			return null;
		}
	}
	
	private function getProperty($name, $database)
	{
		$con = Propel::getConnection($database);
		
		$c = new Criteria();
		$c->add(PropertyPeer::NAME, $name);
		
		$properties = PropertyPeer::doSelect($c, $con);
		
		if(count($properties) > 0)
		{
			return $properties[0];
		}
		else
		{
			return null;
		}
	}
}

?>
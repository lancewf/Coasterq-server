<?php

require_once('persistence/Property.php');
require_once('persistence/PropertyPeer.php');

class Property_model extends Model 
{
	// -------------------------------------------------------------------------
	// Constants
	// -------------------------------------------------------------------------
	
	const PARK_NAME = "park_name";
	const IS_FASSPASS_AVAILABLE = "IsFasspassAvailable";
	const HOME_URL_NAME = "home_url";
	const TIME_DIFFERENCE = "park_time_diff";
	const LATITUDE = "latitude";
	const LONGITUDE = "longitude";
	
	// -------------------------------------------------------------------------
	// Constructors
	// -------------------------------------------------------------------------
	
	
	function Property_model()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getHomeURL()
	{
		return $this->getValue(Property_model::HOME_URL_NAME);
	}
	
	public function getParkName()
	{
		return $this->getValue(Property_model::PARK_NAME);
	}
	
	public function getLatitude()
	{
		return $this->getValue(Property_model::LATITUDE);
	}
	
	public function getLongitude()
	{
		return $this->getValue(Property_model::LONGITUDE);
	}
	
	public function getIsFasspassAvailable()
	{
		$value = $this->getValue(Property_model::IS_FASSPASS_AVAILABLE);
		
		if($value == "true")
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function setHomeURL($homeURL)
	{
		$this->setValue(Property_model::HOME_URL_NAME, $homeURL);
	}
	
	public function setParkName($parkName)
	{
		$this->setValue(Property_model::PARK_NAME, $parkName);
	}
	
	public function setIsFasspassAvailable($isFasspassAvailable)
	{
		$value = "true";
		if(!$isFasspassAvailable)
		{
			$value = "false";
		}
		
		$this->setValue(Property_model::IS_FASSPASS_AVAILABLE, $value);
	}
	
	public function setTimeDifference($diff)
	{
		$this->setValue(Property_model::TIME_DIFFERENCE, $diff);
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function setValue($name, $value, $type = "")
	{
		$property = $this->getProperty($name, $type);
		
		if($property == null)
		{
			$property = new Property();
		}
		
		$property->setName($name);
		
		$property->setValue($value);
		
		$property->setType($type);
		
		$property->save();
	}
	
	private function getValue($name, $type = "")
	{
		$property = $this->getProperty($name, $type);
		
		if($property != null)
		{
			return $property->getValue();
		}
		else
		{
			return null;
		}
	}
	
	private function getProperty($name, $type = "")
	{
		$c = new Criteria();
		$c->add(PropertyPeer::NAME, $name);
		$c->addAnd(PropertyPeer::TYPE, $type);
		
		$properties = PropertyPeer::doSelect($c);
		
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
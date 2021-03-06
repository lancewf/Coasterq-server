<?php

require_once 'persistence/om/BaseRideClosure.php';


/**
 * Skeleton subclass for representing a row from the 'ride_closure' table.
 *
 * Information about a closure for a ride
 *
 * This class was autogenerated by Propel on:
 *
 * Sun May 17 12:03:10 2009
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    persistence
 */
class RideClosure extends BaseRideClosure 
{
	public function getStartDateDay()
	{
		$date = $this->getStartDate(null);
		
		return date("j",$date);
	}
	
	public function getStartDateMonth()
	{
		$date = $this->getStartDate(null);
		
		return date("n",$date);
	}

	public function getStartDateYear()
	{
		$date = $this->getStartDate(null);
		
		return date("Y",$date);
	}
	
	public function getEndDateDay()
	{
		$date = $this->getEndDate(null);
		
		return date("j",$date);
	}
	
	public function getEndDateMonth()
	{
		$date = $this->getEndDate(null);
		
		return date("n",$date);
	}

	public function getEndDateYear()
	{
		$date = $this->getEndDate(null);
		
		return date("Y",$date);
	}
} // RideClosure

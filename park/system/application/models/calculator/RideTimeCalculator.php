<?php

require_once('CurrentRideWaitCalculatorBuilder.php');
require_once('persistence/RideClosure.php');
require_once('persistence/RideClosurePeer.php');
require_once('ParkClock.php');

class RideTimeCalculator
{
	// -------------------------------------------------------------------------
	// Class Constant
	// -------------------------------------------------------------------------
	
	const TIME_5_MIN = 300;
	//const TIME_5_MIN = 0;
		
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $currentRideWaitCalculator;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------

	function __construct($parkClock)
	{	
		$currentRideWaitCalculatorBuilder = 
			new CurrentRideWaitCalculatorBuilder($parkClock);
			
	  	$this->currentRideWaitCalculator = 
	  		$currentRideWaitCalculatorBuilder->build();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function updateCalculatedData($ride)
	{
		if($this->isRideDataOutofDate($ride))
		{
			$this->updateTimes($ride);
		}
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function updateTimes($ride)
	{
		$ride->setLastupdate(time());
		
		$ride->save();
		
		$this->updateCurrentWaitTime($ride);
		
		$this->updateAverageWaitTime($ride);
		
		$this->updateNextShortestWaitDateTime($ride);
		
		$this->updateNextShortestWaitTime($ride);
			
		$ride->save();
	}
	
	private function updateAverageWaitTime($ride)
	{
		$ride->setAverageWaitTime(45);
	}
	
	private function updateNextShortestWaitDateTime($ride)
	{
		$timestamp = time();
		
		$timeOfDay = mktime(12, 0, 0, date("m",$timestamp), 
			date("d",$timestamp), date("y",$timestamp));
			
		$ride->setNextshortestdatetime($timeOfDay);
	}
	
	private function updateCurrentWaitTime($ride)
	{
		$calculatedRideTime = -1;
		
		if(!$this->isRideClosed($ride))
		{
			$calculatedRideTime = 
				$this->currentRideWaitCalculator->calculateCurrentWaitTime($ride);
		}
		
		$ride->setCurrentwaittime($calculatedRideTime);
	}
	
	private function updateNextShortestWaitTime($ride)
	{
		$ride->setNextshortestwaittime(30);
	}
	
	private function isRideDataOutofDate($ride)
	{
		$timestamp = time();
		
		$lastUpdatedTime = $ride->getLastupdate();
		
		if($timestamp > 
			(RideTimeCalculator::TIME_5_MIN + $lastUpdatedTime))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function isRideClosed($ride)
	{
		$criteria = new Criteria();
		
		$parkClock = new ParkClock();
		
		$timestamp = time();
		
		$timeOfDay = mktime(0, 0, 0, $parkClock->getMonth(), 
			$parkClock->getDayOfMonth(), $parkClock->getYear());
		
		$criteria->add(RideClosurePeer::RIDE_ID, $ride->getId());
		$criteria->addAnd(RideClosurePeer::START_DATE, $timeOfDay,
		 Criteria::LESS_EQUAL);
		$criteria->addAnd(RideClosurePeer::END_DATE, $timeOfDay, 
		Criteria::GREATER_EQUAL);
		
		$rideClosures = RideClosurePeer::doSelect($criteria);
		
		if(count($rideClosures) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
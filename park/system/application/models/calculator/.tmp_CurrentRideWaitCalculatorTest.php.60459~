<?php

require_once('CurrentRideWaitCalculator.php');
require_once('RideWaitRetriever.php');
require_once('ParkClock.php');
require_once('CurrentRideWaitGuesser.php');
require_once('CrowdLevelCalculator.php');
require_once('DatabaseCurrentRideWaitCalculator.php');

Mock::generate('RideWaitRetriever');
Mock::generate('ParkClock');
Mock::generate('CurrentRideWaitGuesser');
Mock::generate('CrowdLevelCalculator');
Mock::generate('DatabaseCurrentRideWaitCalculator');

class CurrentRideWaitCalculatorTest extends UnitTestCase 
{
    function testTheParkIsClosed() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$currentRideWaitGuesser = new MockCurrentRideWaitGuesser();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$databaseCurrentRideWaitCalculator = 
			new MockDatabaseCurrentRideWaitCalculator();
	
		$parkClock->setReturnValue('isOpen', false);
		
		$ride = new Ride($parkClock);

		$currentRideWaitCalculator = 
			new CurrentRideWaitCalculator($rideWaitRetriever, $parkClock, 
			$currentRideWaitGuesser, $crowdLevelCalculator, 
			$databaseCurrentRideWaitCalculator);
			
		$actualTime = $currentRideWaitCalculator->calculateCurrentWaitTime($ride);

		$this->assertEqual($actualTime, -1);
    }
	
	function testDatabaseCalcReturnNull() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$currentRideWaitGuesser = new MockCurrentRideWaitGuesser();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$databaseCurrentRideWaitCalculator = 
			new MockDatabaseCurrentRideWaitCalculator();
			
		$ride = new Ride();
		
		$parkClock->setReturnValue('isOpen', true);
		$currentRideWaitGuesser->expectOnce("guessCurrentWait", array($ride));
		$currentRideWaitGuesser->setReturnValue("guessCurrentWait", -888);
		$databaseCurrentRideWaitCalculator->
			setReturnValue('calculateCurrentWaitTime', null);
		
		$currentRideWaitCalculator = 
			new CurrentRideWaitCalculator($rideWaitRetriever, $parkClock, 
			$currentRideWaitGuesser, $crowdLevelCalculator, 
			$databaseCurrentRideWaitCalculator);
			
		$actualTime = $currentRideWaitCalculator->calculateCurrentWaitTime($ride);

		$this->assertEqual($actualTime, -888);
    }
}

class RideWaits
{
	private $time;
	
	function RideWaits($time)
	{
		$this->time = $time;
	}
	
	function setWaitTime($time)
	{
		$this->time = $time;
	}
	
	function getWaitTime()
	{
		return $this->time;
	}
}

class Ride
{
	function Ride()
	{

	}
}

?>
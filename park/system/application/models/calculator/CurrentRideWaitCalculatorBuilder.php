<?php
require_once('CurrentRideWaitCalculator.php');
require_once('ParkClock.php');
require_once('RideWaitRetriever.php');
require_once('CurrentRideWaitModel.php');
require_once('CrowdLevelCalculator.php');
require_once('DatabaseCurrentRideWaitCalculator.php');
require_once('atom/CalcAtomBuilder.php');

class CurrentRideWaitCalculatorBuilder
{
	private $parkClock;
		
	function __construct($parkClock)
	{	
		$this->parkClock = $parkClock;
	}
	
	public function build()
	{
		$rideWaitRetriever = new RideWaitRetriever();
		
		$crowdLevelCalculator = new CrowdLevelCalculator($this->parkClock);
		
		$currentRideWaitModel = new CurrentRideWaitModel($crowdLevelCalculator, 
			$this->parkClock);
			
		$calcAtomBuilder = new CalcAtomBuilder($rideWaitRetriever, 
			$this->parkClock, $crowdLevelCalculator);
			
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$this->parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
	  	$currentRideWaitCalculator = 
			new CurrentRideWaitCalculator($rideWaitRetriever, $this->parkClock, 
			$currentRideWaitModel, $crowdLevelCalculator, 
			$databaseCurrentRideWaitCalculator);
			
		return $currentRideWaitCalculator;
	}
}
?>
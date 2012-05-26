<?php
require_once('atom/ForOneDayBeforeAverageTimeCalcAtom.php');
require_once('RideWaitRetriever.php');
require_once('ParkClock.php');
require_once('CrowdLevelCalculator.php');

Mock::generate('RideWaitRetriever');
Mock::generate('ParkClock');
Mock::generate('CrowdLevelCalculator');

class ForOneDayBeforeTest
{
    function testTheParkIsClosed() 
	{
		$time = mktime(7, 0, 0, 1, 1, 2000);
		
		$ride = "ride";
		
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		
		$parkClock->setReturnValue("getTime", $time);
		
		$rideWaitRetriever->expectOnce("getRideWaits", array($ride, ));
				
		$forOneDayBeforeAverageTimeCalcAtom = 
			new ForOneDayBeforeAverageTimeCalcAtom($rideWaitRetriever, 
				$parkClock, $crowdLevelCalculator);
				
		$forOneDayBeforeAverageTimeCalcAtom->getCalc($ride);
	}
}
?>
<?php
class Test extends Controller
{

	function Test()
	{
		parent::Controller();
		
		require_once('calculator/atom/ForOneDayBeforeAverageTimeCalcAtom.php');
		require_once('calculator/CrowdLevelCalculator.php');
		require_once('calculator/CurrentRideWaitGuesser.php');
		require_once("calculator/RideWaitRetriever.php");
	}

	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------

	public function index()
	{
		$rideWaitRetriever = new RideWaitRetriever();
		$mockRide = new MockRide();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$parkClock = new MockParkClock();
		$time = mktime(7, 0, 0, 1, 2, 2000);
		
		$parkClock->setTime($time);
		
		$mockRide->setPopularitylevel(5);
		
		$forOneDayBeforeAverageTimeCalcAtom = 
			new ForOneDayBeforeAverageTimeCalcAtom($rideWaitRetriever, 
				$parkClock, $crowdLevelCalculator);
				
		$time = $forOneDayBeforeAverageTimeCalcAtom->getCalc($mockRide);
			
		echo "time " . $time;
	}
}

class MockCrowdLevelCalculator
{
	public function getCrowdLevel()
	{
		return CrowdLevelCalculator::CROWD_LEVEL_HIGH;
	}
}

class MockParkClock
{
	private $time;
	
	public function setTime($time)
	{
		$this->time = $time;
	}
	
	public function getTime()
	{
		return $this->time;
	}
}

class MockRide
{
	private $popularityLevel;
	
	public function getPopularitylevel()
	{
		return $this->popularityLevel;
	}
	
	public function setPopularitylevel($popularityLevel)
	{
		$this->popularityLevel = $popularityLevel;
	}
	
	public function getId()
	{
		return 17;
	}
}
?>
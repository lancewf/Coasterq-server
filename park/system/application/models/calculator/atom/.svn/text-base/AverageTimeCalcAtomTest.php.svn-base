<?php

require_once('AverageTimeCalcAtom.php');


class AverageTimeCalcAtomTest extends UnitTestCase 
{
    function testGetCalcAverage1() 
	{
		$rideWaits = array();
		
		array_push($rideWaits, new RideWaitsMock(20));
		array_push($rideWaits, new RideWaitsMock(20));
		array_push($rideWaits, new RideWaitsMock(20));
		
		$rideWaitRetriever = new RideWaitRetrieverMock($rideWaits);
		
		$averageTimeCalcAtomMock = 
			new AverageTimeCalcAtomMock($rideWaitRetriever);
			
		$averageTimeCalcAtomMock->setTimestamp(3);

		$averageTimeCalcAtomMock->setMaxPercentAllowed(1);
		
		$averageTimeCalcAtomMock->setEachWaitTimePercent(0.05);
			
		$weightingAverage = $averageTimeCalcAtomMock->getCalc(null);
			
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 20);
	}
	
    function testGetCalcAverage2() 
	{
		$rideWaits = array();
		
		array_push($rideWaits, new RideWaitsMock(154));
		array_push($rideWaits, new RideWaitsMock(31));
		array_push($rideWaits, new RideWaitsMock(567));
		array_push($rideWaits, new RideWaitsMock(83));
		array_push($rideWaits, new RideWaitsMock(74));
		array_push($rideWaits, new RideWaitsMock(315));
		
		$rideWaitRetriever = new RideWaitRetrieverMock($rideWaits);
		
		$averageTimeCalcAtomMock = 
			new AverageTimeCalcAtomMock($rideWaitRetriever);
			
		$averageTimeCalcAtomMock->setTimestamp(3);

		$averageTimeCalcAtomMock->setMaxPercentAllowed(1);
		
		$averageTimeCalcAtomMock->setEachWaitTimePercent(0.05);
			
		$weightingAverage = $averageTimeCalcAtomMock->getCalc(null);
			
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 204);
	}
	
    function testGetCalcWeighting1() 
	{
		$rideWaits = array();
		
		array_push($rideWaits, new RideWaitsMock(154));
		array_push($rideWaits, new RideWaitsMock(31));
		array_push($rideWaits, new RideWaitsMock(567));
		array_push($rideWaits, new RideWaitsMock(83));
		array_push($rideWaits, new RideWaitsMock(74));
		array_push($rideWaits, new RideWaitsMock(315));
		
		$rideWaitRetriever = new RideWaitRetrieverMock($rideWaits);
		
		$averageTimeCalcAtomMock = 
			new AverageTimeCalcAtomMock($rideWaitRetriever);
			
		$averageTimeCalcAtomMock->setTimestamp(3);

		$averageTimeCalcAtomMock->setMaxPercentAllowed(1);
		
		$averageTimeCalcAtomMock->setEachWaitTimePercent(0.05);
			
		$weightingAverage = $averageTimeCalcAtomMock->getCalc(null);
			
		$this->assertTrue($weightingAverage->getWeighting() < 0.300000001 && 
			$weightingAverage->getWeighting() > 0.299999999999999);
	}
	
    function testGetCalcWeighting2() 
	{
		$rideWaits = array();
		
		array_push($rideWaits, new RideWaitsMock(154));
		array_push($rideWaits, new RideWaitsMock(31));
		array_push($rideWaits, new RideWaitsMock(567));
		array_push($rideWaits, new RideWaitsMock(83));
		array_push($rideWaits, new RideWaitsMock(74));
		array_push($rideWaits, new RideWaitsMock(315));
		
		$rideWaitRetriever = new RideWaitRetrieverMock($rideWaits);
		
		$averageTimeCalcAtomMock = 
			new AverageTimeCalcAtomMock($rideWaitRetriever);
			
		$averageTimeCalcAtomMock->setTimestamp(3);

		$averageTimeCalcAtomMock->setMaxPercentAllowed(1);
		
		$averageTimeCalcAtomMock->setEachWaitTimePercent(0.00125);
			
		$weightingAverage = $averageTimeCalcAtomMock->getCalc(null);
			
		$this->assertTrue($weightingAverage->getWeighting() < 0.007500000001 && 
			$weightingAverage->getWeighting() > 0.007499999);
	}
	
    function testGetCalcMaxWeighting1() 
	{
		$rideWaits = array();
		
		array_push($rideWaits, new RideWaitsMock(154));
		array_push($rideWaits, new RideWaitsMock(31));
		array_push($rideWaits, new RideWaitsMock(567));
		array_push($rideWaits, new RideWaitsMock(83));
		array_push($rideWaits, new RideWaitsMock(74));
		array_push($rideWaits, new RideWaitsMock(315));
		array_push($rideWaits, new RideWaitsMock(154));
		array_push($rideWaits, new RideWaitsMock(31));
		array_push($rideWaits, new RideWaitsMock(567));
		array_push($rideWaits, new RideWaitsMock(83));
		array_push($rideWaits, new RideWaitsMock(74));
		array_push($rideWaits, new RideWaitsMock(315));		

		$rideWaitRetriever = new RideWaitRetrieverMock($rideWaits);
		
		$averageTimeCalcAtomMock = 
			new AverageTimeCalcAtomMock($rideWaitRetriever);
			
		$averageTimeCalcAtomMock->setTimestamp(3);

		$averageTimeCalcAtomMock->setMaxPercentAllowed(.5);
		
		$averageTimeCalcAtomMock->setEachWaitTimePercent(0.05);
			
		$weightingAverage = $averageTimeCalcAtomMock->getCalc(null);
			
		$this->assertEqual($weightingAverage->getWeighting(), 0.5);
	}
}
class RideWaitRetrieverMock
{
	private $rideWaits;
	
	function __construct($rideWaits)
	{
		$this->rideWaits = $rideWaits;
	}
	
	public function getRideWaits($ride)
	{
		return $this->rideWaits;
	}
}

class RideWaitsMock
{
	private $waitTime;
	
	function __construct($waitTime)
	{
		$this->waitTime = $waitTime;
	}
	
	public function getWaitTime()
	{
		return $this->waitTime;
	}
}

class AverageTimeCalcAtomMock extends AverageTimeCalcAtom
{
	function __construct($rideWaitRetriever)
	{
		parent::__construct($rideWaitRetriever);
	}

	protected function getStartTimeDiff()
	{
		return 0;
	}
	
	protected function getEndTimeDiff()
	{
		return AverageTimeCalcAtom::TIME_30_MIN;
	}
}
?>
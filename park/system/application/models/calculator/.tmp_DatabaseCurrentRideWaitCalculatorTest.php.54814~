<?php
require_once('RideWaitRetriever.php');
require_once('ParkClock.php');
require_once('CrowdLevelCalculator.php');
require_once('atom/CalcAtomBuilder.php');
require_once('DatabaseCurrentRideWaitCalculator.php');
require_once('atom/WeightingAverage.php');

Mock::generate('RideWaitRetriever');
Mock::generate('ParkClock');
Mock::generate('CrowdLevelCalculator');
Mock::generate('CalcAtomBuilder');
Mock::generate('WeightingAverage');

class DatabaseCurrentRideWaitCalculatorTest extends UnitTestCase 
{
    function test1() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$calcAtomBuilder = new MockCalcAtomBuilder();
		
		$calcAtoms = array();
		
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(0, 0)));
		
		$calcAtomBuilder->setReturnValue('build', $calcAtoms);
		
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
		$weightingAverage = 
			$databaseCurrentRideWaitCalculator->calculateCurrentWaitTime(null);
		
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 0);
		$this->assertEqual($weightingAverage->getWeighting(), 0);
	}
	
    function test2() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$calcAtomBuilder = new MockCalcAtomBuilder();
		
		$calcAtoms = array();
		
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 0.05)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 0.05)));
		
		$calcAtomBuilder->setReturnValue('build', $calcAtoms);
		
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
		$weightingAverage = 
			$databaseCurrentRideWaitCalculator->calculateCurrentWaitTime(null);
		
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 20);
		$this->assertEqual($weightingAverage->getWeighting(), 0.1);
	}
	
    function test3() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$calcAtomBuilder = new MockCalcAtomBuilder();
		
		$calcAtoms = array();
		
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 1)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(120, 0.05)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(120, 0.05)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(120, 0.05)));
			
		$calcAtomBuilder->setReturnValue('build', $calcAtoms);
		
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
		$weightingAverage = 
			$databaseCurrentRideWaitCalculator->calculateCurrentWaitTime(null);
		
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 20);
		$this->assertEqual($weightingAverage->getWeighting(), 1);
	}
	
	/**
	* Here the last Calc Atom is not used, because the average is already 1 percent. 
	*/
    function test4() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$calcAtomBuilder = new MockCalcAtomBuilder();
		
		$calcAtoms = array();
		
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 0.9)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 0.05)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(20, 0.05)));
		array_push($calcAtoms, new CalcAtom(new WeightingAverage(120, 0.05)));
			
		$calcAtomBuilder->setReturnValue('build', $calcAtoms);
		
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
		$weightingAverage = 
			$databaseCurrentRideWaitCalculator->calculateCurrentWaitTime(null);
		
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 20);
		$this->assertEqual($weightingAverage->getWeighting(), 1);
	}

	/**
	* Empty calcAtoms
	*/
    function test5() 
	{
		$rideWaitRetriever = new MockRideWaitRetriever();
		$parkClock = new MockParkClock();
		$crowdLevelCalculator = new MockCrowdLevelCalculator();
		$calcAtomBuilder = new MockCalcAtomBuilder();
		
		$calcAtoms = array();
			
		$calcAtomBuilder->setReturnValue('build', $calcAtoms);
		
		$databaseCurrentRideWaitCalculator = 
			new DatabaseCurrentRideWaitCalculator($rideWaitRetriever, 
			$parkClock, $crowdLevelCalculator, $calcAtomBuilder);
			
		$weightingAverage = 
			$databaseCurrentRideWaitCalculator->calculateCurrentWaitTime(null);
		
		$this->assertEqual($weightingAverage->getAverageWaitTime(), 0);
		$this->assertEqual($weightingAverage->getWeighting(), 0);
	}
}

class CalcAtom
{
	private $weightingAverage;
	
	function __construct($weightingAverage)
	{
		$this->weightingAverage = $weightingAverage;
	}
	
	public function getCalc($ride)
	{
		return $this->weightingAverage;
	}
}
?>
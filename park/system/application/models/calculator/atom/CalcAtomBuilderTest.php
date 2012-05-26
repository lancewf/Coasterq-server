<?php

require_once('CalcAtomBuilder.php');


class CalcAtomBuilderTest extends UnitTestCase 
{
    function testBuild() 
	{
		$parkClockMock = new ParkClockMock();
		$crowdLevelCalculatorMock = new CrowdLevelCalculatorMock();
		
		$calcAtomBuilder = new CalcAtomBuilder(null, $parkClockMock, 
			$crowdLevelCalculatorMock);
			
		$calcAtoms = $calcAtomBuilder->build();
		echo count($calcAtoms);
		$this->assertTrue(count($calcAtoms) > 0);
	}
}
class ParkClockMock
{
	function __construct()
	{
	}
	
	public function getTime()
	{
		return 23423;
	}
}
class CrowdLevelCalculatorMock
{
	function __construct()
	{
	}
	
	public function getCrowdLevelFromTimestamp()
	{
		return "high";
	}
}
?>
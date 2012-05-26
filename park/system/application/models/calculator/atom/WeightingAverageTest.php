<?php
require_once('WeightingAverage.php');

class WeightingAverageTest extends UnitTestCase 
{
    function testMerging1() 
	{
		$weightingAverage = new WeightingAverage(0, 0);
		
		$weightingAverage100 = new WeightingAverage(17, 1);
		
		$mergedWeightingAverage = 
			$weightingAverage->merge($weightingAverage100);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 17);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 1);
	}
	
    function testMerging2() 
	{
		$weightingAverage = new WeightingAverage(0, 0);
		
		$weightingAverage100 = new WeightingAverage(17, 1.2);
		
		$mergedWeightingAverage = 
			$weightingAverage->merge($weightingAverage100);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 17);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 1);
	}
	
    function testMerging3() 
	{
		$weightingAverage = new WeightingAverage(0, 0);
		
		$weightingAverage100 = new WeightingAverage(17, 0.8);
		
		$mergedWeightingAverage = 
			$weightingAverage->merge($weightingAverage100);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 17);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 0.8);
	}
	
    function testMerging4() 
	{
		$weightingAverage = new WeightingAverage(10, 0.25);
		
		$weightingAverage100 = new WeightingAverage(20, 0.25);
		
		$mergedWeightingAverage = 
			$weightingAverage->merge($weightingAverage100);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 15);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 0.5);
	}
	
    function testMerging5() 
	{
		$baseWeightingAverage = new WeightingAverage(25, 1);
		
		$addWeightingAverage = new WeightingAverage(5, 0.25);
		
		$mergedWeightingAverage = 
			$baseWeightingAverage->merge($addWeightingAverage);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 25);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 1);
	}
	
    function testMerging6() 
	{
		$baseWeightingAverage = new WeightingAverage(25, 0.5);
		
		$addWeightingAverage = new WeightingAverage(5, 1);
		
		$mergedWeightingAverage = 
			$baseWeightingAverage->merge($addWeightingAverage);
			
		$this->assertEqual(
			$mergedWeightingAverage->getAverageWaitTime(), 15);

		$this->assertEqual(
			$mergedWeightingAverage->getWeighting(), 1);
	}
}
?>
<?php

require_once('Future30MinAverageTimeCalcAtom.php');
require_once('Future60MinAverageTimeCalcAtom.php');
require_once('Future90MinAverageTimeCalcAtom.php');
require_once('Past30MinAverageTimeCalcAtom.php');
require_once('Past60MinAverageTimeCalcAtom.php');
require_once('Past90MinAverageTimeCalcAtom.php');
require_once('DaysBeforeEachWaitTimePercentModel.php');

class DaysBeforeCalcAtomBuilder
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_30_TO_CURRENT = 0.07;
	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_60_TO_MINUS_30 = 0.05;
	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_90_TO_MINUS_60 = 0.03;
	const WEIGHT_PERCENTAGE_FOR_EACH_CURRENT_TO_PLUS_30 = 0.07;
	const WEIGHT_PERCENTAGE_FOR_EACH_PLUS_30_TO_PLUS_60 = 0.05;
	const WEIGHT_PERCENTAGE_FOR_EACH_PLUS_60_TO_PLUS_90 = 0.03;
		
	private $timestamp;
	private $crowdLevelCalculator;
	private $rideWaitRetriever;
	private $daysBeforeEachWaitTimePercentModel;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($timestamp, 
		$crowdLevelCalculator, $rideWaitRetriever)
	{
		$this->timestamp = $timestamp;
		$this->crowdLevelCalculator = $crowdLevelCalculator;
		$this->rideWaitRetriever = $rideWaitRetriever;
		$this->daysBeforeEachWaitTimePercentModel = 
			new DaysBeforeEachWaitTimePercentModel();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	/**
	 * 
	 * @return 
	 */
	public function build()
	{		
		$pastTimestamp = $this->timestamp;
		$currentCrowdLevel = $this->crowdLevelCalculator->
			getCrowdLevelFromTimestamp($pastTimestamp);
			
		$dayCalcAtoms = array();
		
		$pastCrowdLevel = null;
		$daysBack = 1;
		while($daysBack <= 14)
		{
			$pastTimestamp -= AverageTimeCalcAtom::TIME_1_DAY;
		
			$pastCrowdLevel = $this->crowdLevelCalculator->
				getCrowdLevelFromTimestamp($pastTimestamp);
				
			if($currentCrowdLevel == $pastCrowdLevel)
			{
				$newCalcAtoms = $this->createDayAtoms(
					$pastTimestamp, $daysBack);
					
				$dayCalcAtoms = array_merge($dayCalcAtoms, $newCalcAtoms);
			}
				
			$daysBack++;
		}
		
		return $dayCalcAtoms;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	/**
	 * 
	 * 
	 * @return 
	 * @param object $pastTimestamp - the time stamp to create the atoms from
	 * @param object $daysBack - how many days back from the current day. 
	 */
	private function createDayAtoms($pastTimestamp, $daysBack)
	{
		$dayCalcAtoms = array();
		
		array_push($dayCalcAtoms, 
			$this->createPast30MinAtom($pastTimestamp, $daysBack));
		
		array_push($dayCalcAtoms, 
			$this->createPast60MinAtom($pastTimestamp, $daysBack));
		
		array_push($dayCalcAtoms, 
			$this->createPast90MinAtom($pastTimestamp, $daysBack));
		
		array_push($dayCalcAtoms, 
			$this->createFuture30MinAtom($pastTimestamp, $daysBack));
		
		array_push($dayCalcAtoms, 
			$this->createFuture60MinAtom($pastTimestamp, $daysBack));
		
		array_push($dayCalcAtoms, 
			$this->createFuture90MinAtom($pastTimestamp, $daysBack));
			
		return $dayCalcAtoms;
	}
	
	private function createFuture90MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$future90Min = new Future90MinAverageTimeCalcAtom(
			$this->rideWaitRetriever);
		
		$future90Min->setTimestamp($pastTimestamp);
		
		$future90Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_PLUS_60_TO_PLUS_90;
		
		$future90Min->setEachWaitTimePercent($finalPercentageForEach);

		return $future90Min;
	}
	
	private function createFuture60MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$future60Min = new Future60MinAverageTimeCalcAtom(
			$this->rideWaitRetriever);
		
		$future60Min->setTimestamp($pastTimestamp);
		
		$future60Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_PLUS_30_TO_PLUS_60;
		
		$future60Min->setEachWaitTimePercent($finalPercentageForEach);

		return $future60Min;
	}
	
	private function createFuture30MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$future30Min = new Future30MinAverageTimeCalcAtom(
			$this->rideWaitRetriever);
		
		$future30Min->setTimestamp($pastTimestamp);
		
		$future30Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_CURRENT_TO_PLUS_30;
		
		$future30Min->setEachWaitTimePercent($finalPercentageForEach);
		
		return $future30Min;
	}
	
	private function createPast90MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$past90Min = new Past90MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past90Min->setTimestamp($pastTimestamp);
		
		$past90Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_90_TO_MINUS_60;
		
		$past90Min->setEachWaitTimePercent($finalPercentageForEach);

		return $past90Min;
	}
	
	private function createPast60MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$past60Min = new Past60MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past60Min->setTimestamp($pastTimestamp);
		
		$past60Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_60_TO_MINUS_30;
		
		$past60Min->setEachWaitTimePercent($finalPercentageForEach);

		return $past60Min;
	}
	
	private function createPast30MinAtom( 
		$pastTimestamp, $daysBack)
	{
		$past30Min = new Past30MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past30Min->setTimestamp($pastTimestamp);
		
		$past30Min->setMaxPercentAllowed(0.30);
		
		$percentageOfWeight = 
			$this->daysBeforeEachWaitTimePercentModel->getPercentage($daysBack);
		
		$finalPercentageForEach = $percentageOfWeight * 
			DaysBeforeCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_30_TO_CURRENT;
		
		$past30Min->setEachWaitTimePercent($finalPercentageForEach);
		
		return $past30Min;
	}
}

?>
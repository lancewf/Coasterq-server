<?php

require_once('Past30MinAverageTimeCalcAtom.php');
require_once('Past60MinAverageTimeCalcAtom.php');
require_once('Past90MinAverageTimeCalcAtom.php');

class NowCalcAtomBuilder
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $timestamp;
	private $rideWaitRetriever;

	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_30_TO_CURRENT = 0.17;
	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_60_TO_MINUS_30 = 0.12;
	const WEIGHT_PERCENTAGE_FOR_EACH_MINUS_90_TO_MINUS_60 = 0.07;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($timestamp, $rideWaitRetriever)
	{
		$this->timestamp = $timestamp;
		$this->rideWaitRetriever = $rideWaitRetriever;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function build()
	{		
		$dayCalcAtoms = array();
		
		array_push($dayCalcAtoms, $this->createPast30MinAtom());
		
		array_push($dayCalcAtoms, $this->createPast60MinAtom());
		
		array_push($dayCalcAtoms, $this->createPast90MinAtom());
		
		return $dayCalcAtoms;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function createPast30MinAtom()
	{
		$past30Min = new Past30MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past30Min->setTimestamp($this->timestamp);
		
		$past30Min->setMaxPercentAllowed(1);
		
		$past30Min->setEachWaitTimePercent(
			NowCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_30_TO_CURRENT);
		
		return $past30Min;
	}
	
	private function createPast60MinAtom()
	{
		$past60Min = new Past60MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past60Min->setTimestamp($this->timestamp);
		
		$past60Min->setMaxPercentAllowed(0.8);
		
		$past60Min->setEachWaitTimePercent(
			NowCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_60_TO_MINUS_30);

		return $past60Min;
	}
	
	private function createPast90MinAtom()
	{
		$past90Min = new Past90MinAverageTimeCalcAtom($this->rideWaitRetriever);
		
		$past90Min->setTimestamp($this->timestamp);
		
		$past90Min->setMaxPercentAllowed(0.50);
		
		$past90Min->setEachWaitTimePercent(
			NowCalcAtomBuilder::WEIGHT_PERCENTAGE_FOR_EACH_MINUS_90_TO_MINUS_60);

		return $past90Min;
	}
}

?>
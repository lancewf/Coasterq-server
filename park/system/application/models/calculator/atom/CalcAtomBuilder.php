<?php

require_once('DaysBeforeCalcAtomBuilder.php');
require_once('NowCalcAtomBuilder.php');

class CalcAtomBuilder
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
 	private $rideWaitRetriever;
	private $crowdLevelCalculator;
	private $parkClock;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($rideWaitRetriever, $parkClock, 
		$crowdLevelCalculator)
	{
		$this->rideWaitRetriever = $rideWaitRetriever;
		$this->crowdLevelCalculator = $crowdLevelCalculator;
		$this->parkClock = $parkClock;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function build()
	{
		$daysBeforeCalcAtomBuilder = new DaysBeforeCalcAtomBuilder(
			$this->parkClock->getTime(), 
			$this->crowdLevelCalculator, 
			$this->rideWaitRetriever);
			
		$nowCalcAtomBuilder = new NowCalcAtomBuilder(
			$this->parkClock->getTime(), 
			$this->rideWaitRetriever);
			
		$calcAtoms = array();
		
		$nowCalcAtoms = $nowCalcAtomBuilder->build();
		
		$calcAtoms = array_merge($calcAtoms, $nowCalcAtoms);
		
			
		$daysBeforeCalcAtoms = $daysBeforeCalcAtomBuilder->build();
				
		$calcAtoms = array_merge($calcAtoms, $daysBeforeCalcAtoms);
			
		return $calcAtoms;
	}
}

?>
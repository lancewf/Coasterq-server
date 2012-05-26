<?php

require_once('AverageTimeCalcAtom.php');

/**
 * Get the Weighting average from the database for the last 30 minutes
 */
class Future90MinAverageTimeCalcAtom extends AverageTimeCalcAtom
{
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($rideWaitRetriever)
	{
		parent::__construct($rideWaitRetriever);
	}
	
	// -------------------------------------------------------------------------
	// AverageTimeCalcAtom overridden Members
	// -------------------------------------------------------------------------
	
	protected function getStartTimeDiff()
	{
		return AverageTimeCalcAtom::TIME_60_MIN;
	}
	
	protected function getEndTimeDiff()
	{
		return AverageTimeCalcAtom::TIME_90_MIN;
	}
}

?>
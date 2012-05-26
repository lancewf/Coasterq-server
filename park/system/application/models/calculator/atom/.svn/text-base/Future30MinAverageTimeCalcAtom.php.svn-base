<?php

require_once('AverageTimeCalcAtom.php');

/**
 * Get the Weighting average from the database for the last 30 minutes
 */
class Future30MinAverageTimeCalcAtom extends AverageTimeCalcAtom
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
		return 0;
	}
	
	protected function getEndTimeDiff()
	{
		return AverageTimeCalcAtom::TIME_30_MIN;
	}
}

?>
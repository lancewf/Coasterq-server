<?php

require_once('AverageTimeCalcAtom.php');

class Past60MinAverageTimeCalcAtom extends AverageTimeCalcAtom
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
		return (-1) * AverageTimeCalcAtom::TIME_60_MIN;
	}
	
	protected function getEndTimeDiff()
	{
		return (-1) * AverageTimeCalcAtom::TIME_30_MIN;
	}

}

?>
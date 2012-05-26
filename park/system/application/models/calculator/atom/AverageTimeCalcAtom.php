<?php

require_once('IAverageTimeCalcAtom.php');
require_once("WeightingAverage.php");

/**
 * This is the template patern
 */
abstract class AverageTimeCalcAtom implements IAverageTimeCalcAtom
{
	// -------------------------------------------------------------------------
	// Class Constant
	// -------------------------------------------------------------------------
	
	const TIME_5_MIN = 300;
 	const TIME_30_MIN = 1800;
 	const TIME_60_MIN = 3600;
 	const TIME_90_MIN = 5400;
 	const TIME_3_HOUR = 10800;
 	const TIME_1_DAY = 86400;
 	const TIME_1_WEEK = 604800;
 	const DAYS_1_DAY = 1;
 	const DAYS_2_DAYS = 2;
 	const DAYS_1_WEEK = 7;
 	const DAYS_4_WEEKS = 28;
 	const DAYS_1_YEAR = 365;
 	const DAYS_1_YEAR_AND_1_DAY = 366;
 	const DAYS_1_YEAR_AND_1_WEEK = 372;
 
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
 	private $rideWaitRetriever;
	private $timestamp;
	private $maxPercentAllowed;
	private $eachWaitTimePercent;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($rideWaitRetriever)
	{
		$this->rideWaitRetriever = $rideWaitRetriever;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getCalc($ride)
	{
		$timestamp = $this->getTimestamp();
		
        if ($timestamp == null)
        {
            return new WeightingAverage(0, 0);
        }
        else
        {
            $startTime = $timestamp + $this->getStartTimeDiff();
            $endOfTime = $timestamp + $this->getEndTimeDiff();
        
            $rideWaits = $this->rideWaitRetriever->getRideWaits($ride, 
				$startTime, $endOfTime);
        
            $weighting = count($rideWaits)*$this->getEachWaitTimePercent();
        
            $averageTime = $this->findAverageWaitTime($rideWaits);
        
            if ($weighting > $this->getMaxPercentAllowed())
            {
                $weighting = $this->getMaxPercentAllowed();
            }
        
            return new WeightingAverage($averageTime, $weighting);
        }
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function setTimestamp($timestamp)
	{
		$this->timestamp = $timestamp;
	}
	
	public function setMaxPercentAllowed($maxPercentAllowed)
	{
		$this->maxPercentAllowed = $maxPercentAllowed;
	}
	
	public function setEachWaitTimePercent($eachWaitTimePercent)
	{
		$this->eachWaitTimePercent = $eachWaitTimePercent;
	}
	
	// -------------------------------------------------------------------------
	// Protected Members
	// -------------------------------------------------------------------------
	
	protected function getTimestamp()
	{
		return $this->timestamp;
	}
	
	protected function getMaxPercentAllowed()
	{
		return $this->maxPercentAllowed;
	}
	
	protected function getEachWaitTimePercent()
	{
		return $this->eachWaitTimePercent;
	}
	
	// -------------------------------------------------------------------------
	// Protected abstract Members
	// -------------------------------------------------------------------------
	
	protected abstract function getStartTimeDiff();
	
	protected abstract function getEndTimeDiff();
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function findAverageWaitTime($rideWaits)
	{
		$averageTime = 0;
		
		if(count($rideWaits) > 0)
		{
			$totalTime = 0;
			foreach($rideWaits as $rideWait)
			{
				$totalTime += $rideWait->getWaitTime();
			}
			$averageTime = $totalTime/count($rideWaits);
		}
		
		return $averageTime;
	}
}

?>
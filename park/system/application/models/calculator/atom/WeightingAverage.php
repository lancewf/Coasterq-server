<?php



class WeightingAverage
{
	// -------------------------------------------------------------------------
	// Private Variables
	// -------------------------------------------------------------------------
	
	private $averageWaitTime;
	private $weighting;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($averageWaitTime, $weighting)
	{
		$this->averageWaitTime = $averageWaitTime;
		
		if($weighting > 1)
		{
			$this->weighting = 1;
		}
		else
		{
			$this->weighting = $weighting;
		}
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getAverageWaitTime()
	{
		return $this->averageWaitTime;
	}
	
	public function getWeighting()
	{
		return $this->weighting;
	}
	
	public function isComplete()
	{
		return $this->checkIfComplete($this->weighting);
	}
	
	/**
	 * Merges the two weightingAverage objects.
	 * 
	 * This method does not effect the local or passed in WeightingAverage 
	 * objects
	 * 
	 * The one past in has less importance than the local object. Meaning that 
	 * if the combined total weighting is heigher than 100 % then the local 
	 * weighting average gets the extra average added. 
	 * 
	 * @return A new WeightingAverage object that contains the product of merging
	 * the local and passed in WeightingAverage.
	 *  
	 * @param object $weightingAverageMerging - the WeightingAverage to merge
	 */
	public function merge($weightingAverageMerging)
	{		
		$newWeighting = $this->weighting + 
			$weightingAverageMerging->getWeighting();
	
		if($this->checkIfComplete($newWeighting))
		{
			$weightingOverflow =  $newWeighting - 1;
			
			$adjustedWeightingAverage = $weightingAverageMerging->getWeighting() -
				$weightingOverflow;
			
            $newCurrentWaitTime = $weightingAverageMerging->getAverageWaitTime()*
	            $adjustedWeightingAverage +
    	        $this->averageWaitTime * $this->weighting;
			
			$newWeighting = 1;
		}
		else
		{
			$totalWeighting = 
				$weightingAverageMerging->getWeighting() + $this->weighting;
			
			if($totalWeighting != 0)
			{
            	$newCurrentWaitTime = $weightingAverageMerging->getAverageWaitTime() *
	            	($weightingAverageMerging->getWeighting()/$totalWeighting) +
    	        	$this->averageWaitTime * ($this->weighting/$totalWeighting);
			}
			else
			{
				$newCurrentWaitTime = 0;
			}
		}
			
		return new WeightingAverage($newCurrentWaitTime, $newWeighting);
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function checkIfComplete($weighting)
	{
		if($weighting > 0.99999)
		{
			return true;
		}
		else
		{	
			return false;
		}
	}
}

?>
<?php
require_once('persistence/Ride.php');
require_once('persistence/RideWait.php');

class RideWaitRetriever
{
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
 	
	public function getRideWaits($ride, $startTime, $endOfTime)
	{	
		$startTime = $this->adjustStartTime($startTime);
		$endOfTime = $this->adjustEndTime($endOfTime);
		
		$c = new Criteria();
		$c->add(RideWaitPeer::RIDE_ID, $ride->getId());
		$c->addAnd(RideWaitPeer::DATE_TIME_IN_LINE, $startTime,
		 Criteria::GREATER_EQUAL);
		$c->addAnd(RideWaitPeer::DATE_TIME_IN_LINE, $endOfTime, 
		Criteria::LESS_EQUAL);
		$c->addAnd(RideWaitPeer::INSIDE_PARK, true, 
		Criteria::EQUAL);
		
		$rideWaits = RideWaitPeer::doSelect($c);
		
		return $rideWaits;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
 	
	private function adjustStartTime($startTime)
	{
		$time = mktime(date("G",$startTime), date("i",$startTime), 00, 
			date("n",$startTime), date("j",$startTime), date("Y",$startTime));
		return $time;
	}
	
	private function adjustEndTime($endOfTime)
	{
		$time = mktime(date("G",$endOfTime), date("i",$endOfTime), -1, 
			date("n",$endOfTime), date("j",$endOfTime), date("Y",$endOfTime));
			
		return $time;
	}
}
?>
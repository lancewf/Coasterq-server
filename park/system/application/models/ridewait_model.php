<?php
require_once('persistence/RideWait.php');
require_once('calculator/ParkClock.php');
require_once('parkclock_model.php');

class RideWait_model extends Model
{
	const TIME_30_MIN = 1800;
	const TIME_4_hours = 14400;
		
	public function RideWait_model()
	{
		parent::Model();
	}

	public function addRideWait($user, $rideId, $dateTime, $waitMin, $isInsidePark, 
		$latitude, $longitude)
	{
		$newRideWait = new RideWait();

		$newRideWait->setRideId($rideId);

		$newRideWait->setUserId($user->getId());

		$newRideWait->setDateTimeInLine($dateTime);

		$newRideWait->setWaitTime($waitMin);
		
		$newRideWait->setInsidePark($isInsidePark);

		$newRideWait->setLatitude($latitude);
		
		$newRideWait->setLongitude($longitude);
		
		$newRideWait->save();
	}
	
	public function clearAll()
	{
		RideWaitPeer::doDeleteAll();
	}

	public function isRideWaitValid($user, $rideId, $waitMin, $timeMin, 
		$timeHour, $dayOfMonth, $month, $year)
	{
		$isValid = true;
		
		if(!$this->areValuesNonNull($user, $rideId, $waitMin, $timeMin, 
			$timeHour, $dayOfMonth, $month, $year))
		{
			$isValid = false;
		}
		else if($this->areThereAnyEntriesInLast30Mins($user, $rideId, $timeMin, 
			$timeHour, $dayOfMonth, $month, $year))
		{
			$isValid = false;
		}
		else if(!$this->isTimeOfDayValid($timeMin, $timeHour, 
			$dayOfMonth, $month, $year))
		{
			$isValid = false;
		}
		else if(!$this->isDateValid($dayOfMonth, $month, $year))
		{
			$isValid = false;
		}
		else if(!$this->isParkOpen($timeMin, $timeHour, $dayOfMonth, $month, $year))
		{
			$isValid = false;
		}
		else if(!$this->isTheWaitTimeValid($waitMin))
		{
			$isValid = false;
		}
		
		return $isValid;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function isTheWaitTimeValid($waitMin)
	{
		if($waitMin >= 0 && $waitMin <= 295)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	private function isParkOpen($timeMin, $timeHour, $dayOfMonth, $month, $year)
	{
		$date = mktime($timeHour, $timeMin, 0, $month, $dayOfMonth, $year);
		
		$parkClock = new ParkClock($date);
		
		if($parkClock->isOpen())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function isDateValid($dayOfMonth, $month, $year)
	{
		$parkClock = $this->getParkClock();
		
		if($parkClock->getDayOfMonth() == $dayOfMonth && 
			$parkClock->getMonth() == $month && $parkClock->getYear() == $year)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function getParkClock()
	{
		$parkclock_model = new Parkclock_model();
		$parkClock = $parkclock_model->getParkClock();
		
		return $parkClock;
	}
	
	private function isTimeOfDayValid($timeMin, $timeHour, $dayOfMonth, 
		$month, $year)
	{
		$date = mktime($timeHour, $timeMin, 0, $month, $dayOfMonth, $year);
		
		$parkClock = $this->getParkClock();
		
		$timdDiffFromNow = $parkClock->getTime() - $date;
		
		if($timdDiffFromNow < RideWait_model::TIME_4_hours)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	private function areThereAnyEntriesInLast30Mins($user, $rideId, 
		$timeMin, $timeHour, $dayOfMonth, $month, $year)
	{
		$criteria = new Criteria();

		$endOfDay = mktime($timeHour, $timeMin, 0, $month, $dayOfMonth, $year);
		$startOfDay = $endOfDay - RideWait_model::TIME_30_MIN;

		$criteria->add(RideWaitPeer::RIDE_ID, $rideId);
		$criteria->add(RideWaitPeer::USER_ID, $user->getId());
		$criteria->add(RideWaitPeer::DATE_TIME_IN_LINE, $startOfDay,
			Criteria::GREATER_EQUAL);
		$criteria->addAnd(RideWaitPeer::DATE_TIME_IN_LINE, $endOfDay,
			Criteria::LESS_EQUAL);

		$rideWaits = RideWaitPeer::doSelect($criteria);

		if(count($rideWaits) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function areValuesNonNull($user, $rideId, $waitMin, $timeMin, 
		$timeHour, $dayOfMonth, $month, $year)
	{
		if($user != null && $rideId != null && $waitMin != null && 
			$timeHour != null && $timeMin != null && $dayOfMonth != null
			&& $month != null && $year != null)
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
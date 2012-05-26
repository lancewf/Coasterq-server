<?php
require_once('persistence/ParkDay.php');
require_once('persistence/ParkDayPeer.php');

class ParkDay_model extends Model
{
	public function ParkDay_model()
	{
		parent::Model();
	}

	public function addParkDay($day, $month, $year,  $isClosed, $openHour, 
				$openMin, $closeHour, $closeMin, $crowdLevel)
	{
		$criteria = new Criteria();
		$day = mktime(0, 0, 0, $month, $day, $year);
		$criteria->add(ParkDayPeer::DATE, $day);

		$matchingParkDays = ParkDayPeer::doSelect($criteria);
		
		if(count($matchingParkDays) > 0)
		{
			$matchingParkDays[0]->setIsClosed($isClosed);
			$matchingParkDays[0]->setOpenHour($openHour);
			$matchingParkDays[0]->setOpenMin($openMin);
			$matchingParkDays[0]->setCloseHour($closeHour);
			$matchingParkDays[0]->setCloseMin($closeMin);
			$matchingParkDays[0]->setCrowdLevel($crowdLevel);
			
			$matchingParkDays[0]->save();
		}
		else
		{
			$newParkDay = new ParkDay();
			
			$newParkDay->setDate($day);
			$newParkDay->setIsClosed($isClosed);
			$newParkDay->setOpenHour($openHour);
			$newParkDay->setOpenMin($openMin);
			$newParkDay->setCloseHour($closeHour);
			$newParkDay->setCloseMin($closeMin);
			$newParkDay->setCrowdLevel($crowdLevel);
			
			$newParkDay->save();
		}
	}
	
	public function setCrowdLevel($day, $month, $year, $crowdLevel)
	{
		$criteria = new Criteria();
		$day = mktime(0, 0, 0, $month, $day, $year);
		$criteria->add(ParkDayPeer::DATE, $day);

		$matchingParkDays = ParkDayPeer::doSelect($criteria);
		
		if(count($matchingParkDays) > 0)
		{
			$matchingParkDays[0]->setCrowdLevel($crowdLevel);
			
			$matchingParkDays[0]->save();
		}
	}
	
	function getParkDays()
	{
		$criteria = new Criteria();
		
		$parkDays = ParkDayPeer::doSelect($criteria);
		
		return $parkDays;
	}
}
?>
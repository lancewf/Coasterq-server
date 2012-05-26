<?php

require_once('persistence/ParkDayPeer.php');
require_once('ParkOpenRange.php');


class ParkOpenRangeBuilder
{
	// -------------------------------------------------------------------------
	// Data
	// -------------------------------------------------------------------------
	
	private $parkClock;
	const TIME_1_DAY  = 86400;
	const TIME_2_DAY  = 172800;
	const TIME_5_DAYS = 432000;
	
	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
	
	function __construct($parkClock)
	{
		$this->parkClock = $parkClock;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function build()
	{
		$timestamp = $this->parkClock->getTime();
		
		$twoDaysBefore = $timestamp - ParkOpenRangeBuilder::TIME_2_DAY;
		
		$fiveDaysAfter = $timestamp + ParkOpenRangeBuilder::TIME_5_DAYS;
		
		$c = new Criteria();
		
		$c->add(ParkDayPeer::DATE, $twoDaysBefore,
		 Criteria::GREATER_EQUAL);
		$c->addAnd(ParkDayPeer::DATE, $fiveDaysAfter, 
		Criteria::LESS_EQUAL);
		
		$parkDays = ParkDayPeer::doSelect($c);
		
		$parkOpenRanges = array();
		
		foreach($parkDays as $parkDay)
		{
            if (!$parkDay->getIsClosed())
            {
                $date = $parkDay->getDate(null);
            
                $day = date("j", $date);
                $month = date("n", $date);
                $year = date("Y", $date);
            
                $parkOpenRange = new ParkOpenRange();
            
                $parkOpenRange->setDay($day);
                $parkOpenRange->setMonth($month);
                $parkOpenRange->setYear($year);
            
                $parkOpenRange->setOpenHour($parkDay->getOpenHour());
                $parkOpenRange->setOpenMin($parkDay->getOpenMin());
            
                if (!$this->doesCloseNextDay($parkDay))
                {
                    $parkOpenRange->setCloseHour($parkDay->getCloseHour());
                    $parkOpenRange->setCloseMin($parkDay->getCloseMin());
                }
                else
                {
                    $parkOpenRange->setCloseHour(23);
                    $parkOpenRange->setCloseMin(59);
            
                    $tomorrowDate = $date + ParkOpenRangeBuilder::TIME_1_DAY;
                    $tomorrowDay = date("j", $tomorrowDate);
                    $tomorrowMonth = date("n", $tomorrowDate);
                    $tomorrowYear = date("Y", $tomorrowDate);
            
                    $nextDayParkOpenRange = new ParkOpenRange();
            
                    $nextDayParkOpenRange->setDay($tomorrowDay);
                    $nextDayParkOpenRange->setMonth($tomorrowMonth);
                    $nextDayParkOpenRange->setYear($tomorrowYear);
            
                    $nextDayParkOpenRange->setOpenHour(0);
                    $nextDayParkOpenRange->setOpenMin(0);
            
                    $nextDayParkOpenRange->setCloseHour($parkDay->getCloseHour());
                    $nextDayParkOpenRange->setCloseMin($parkDay->getCloseMin());
            
                    array_push($parkOpenRanges, $nextDayParkOpenRange);
                }
            
                array_push($parkOpenRanges, $parkOpenRange);
            }
		}
		
		return $parkOpenRanges;
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	/**
	 * If the park day has a close hour that is less than the open hour then
	 * the park does not close until the next day. 
	 * 
	 * @return 
	 * @param object $parkDay - the park closes the next day. 
	 */
	private function doesCloseNextDay($parkDay)
	{
		if($parkDay->getCloseHour() < $parkDay->getOpenHour())
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
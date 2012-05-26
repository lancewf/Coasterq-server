<?php
require_once('persistence/Ride.php');
require_once('calculator/RideTimeCalculator.php');
require_once('parkclock_model.php');

/**
 * The ride model retrieves, adds, add modifies the rides for the park. 
 */
class Ride_model extends Model 
{

	function Ride_model()
	{
		parent::Model();
	}
	
	/**
	 * Get all the park rides in alphabet order but do not include the permently 
	 * closed rides. 
	 * 
	 * Calculate the ride times when the rides are retieveds
	 * 
	 * @return an array of park rides
	 */
	function getRides()
	{
		$criteria = new Criteria();

		$criteria->add(RidePeer::IS_RIDE_PERMENTLY_CLOSED, false);
		
		$criteria->addAscendingOrderByColumn(RidePeer::NAME);

		$rides = RidePeer::doSelect($criteria);
		
		$parkclock_model = new Parkclock_model();
		
		$parkClock = $parkclock_model->getParkClock();
		
		$rideTimeCalculator = new RideTimeCalculator($parkClock); 
		
		foreach($rides as $ride)
		{
			$rideTimeCalculator->updateCalculatedData($ride);
		}
		
		return $rides;
	}
	
	/**
	 * Get all the park rides in alphabet order and also include the permently 
	 * deleted rides
	 * 
	 * @return an array of park rides
	 */
	function getAllsRides()
	{
		$criteria = new Criteria();
		
		$criteria->addAscendingOrderByColumn(RidePeer::NAME);

		$rides = RidePeer::doSelect($criteria);
		
		return $rides;
	}
	
	/**
	 * Update a park ride with the popularity level and the ride permanently 
	 * closed flag.
	 *  
	 * @return 
	 * @param object $rideId - the ride's id to update with the data passed in
	 * with.
	 * @param object $popularityLevel - the popularity level to update the ride
	 * with.
	 * @param object $closedPermanently - a boolean to designate if the ride is 
	 * permanently closed. 
	 */
	public function updateRideData($rideId, 
		$popularityLevel, $closedPermanently)
	{
		$ride = RidePeer::retrieveByPK($rideId);
		
		$ride->setIsRidePermentlyClosed($closedPermanently);
		
		$ride->setPopularitylevel($popularityLevel);
		
		$ride->save();
	}
	
	/**
	 * Add a park ride to the park with the passed in data. 
	 * 
	 * @return 
	 * @param object $rideName - the name of the new ride
	 * @param object $land - the land that is assocaited to the ride or the land
	 * that the ride is in
	 * @param object $height - the height requiement of the ride. 
	 * @param object $hasFastpass - an boolean designator that if the ride has
	 * a fastpass or not. 
	 * @param object $hasSingleLine - an boolean designator that if the ride has
	 * a single rider line
	 * @param object $description - the description of the park ride. 
	 * @param object $popularityLevel[optional] - the populaerity level of the
	 * ride. 
	 */
	public function addRide($rideName, $land, $height, $hasFastpass, 
		$hasSingleLine, $description, $popularityLevel = 5)
	{
		$newRide = new Ride();
		
		$newRide->setName($rideName);
		
		$newRide->setLand($land);
		
		$newRide->setHeight($height);
		
		$newRide->setFastpass($hasFastpass);
		
		$newRide->setSingleline($hasSingleLine);
		
		$newRide->setDescription($description);
		
		$newRide->setPopularitylevel($popularityLevel);
		
		$timestamp = time();
		
		$timeOfDay = mktime(12, 0, 0, date("m",$timestamp), 
			date("d",$timestamp), date("y",$timestamp));
			
		$newRide->setNextshortestdatetime($timeOfDay);
		
		$newRide->save();
	}
	
	/**
	 * Clear all the rides from the park
	 * @return void
	 */
	public function clearAll()
	{
		RidePeer::doDeleteAll();
	}
}
?>

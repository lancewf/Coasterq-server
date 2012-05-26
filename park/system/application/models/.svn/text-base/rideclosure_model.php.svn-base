<?php
require_once('persistence/RideClosure.php');
require_once('persistence/RideClosurePeer.php');

/**
 * Handles the retrieving, creating, and updating the ride closures.  
 */
class RideClosure_model extends Model 
{

	function RideClosure_model()
	{
		parent::Model();
	}
	
	/**
	 * Get all the ride closures for the park. 
	 * 
	 * @return an array of all the ride closures 
	 */
	function getRideClosures()
	{
		$criteria = new Criteria();
		
		$criteria->addAscendingOrderByColumn(RideClosurePeer::START_DATE);
		
		$rideClosures = RideClosurePeer::doSelect($criteria);
		
		return $rideClosures;
	}
	
	/**
	 * Create a new ride closure with the data passed in. 
	 * 
	 * @return return - the id of the new ride closure create. 
	 * @param object $startDate - the start date of the ride closure
	 * @param object $endDate - the end date of the ride closure
	 * @param object $rideId - the ride id of the ride closure. this would be
	 * the ride the is closed during the start and end date. 
	 */
	public function createNewRideClosure($startDate, $endDate, $rideId)
	{
		$newRideClosure = new RideClosure();
		
		$newRideClosure->setStartDate($startDate);
		
		$newRideClosure->setEndDate($endDate);
		
		$newRideClosure->setRideId($rideId);
		
		$newRideClosure->save();
		
		return $newRideClosure->getId();
	}
	
	/**
	 * Delete the ride closure with the id passed in. 
	 * @return void
	 * @param object $id the id of the ride closure to delete
	 */
	public function deleteRideClosure($id)
	{
		$rideClosureToBeDeleted = RideClosurePeer::retrieveByPK($id);
		
		$rideClosureToBeDeleted->delete();
	}
	
	/**
	 * update the ride closure with the id passed in with the data passed in. 
	 * 
	 * @return void
	 * @param object $id - the id of the ride closure to update with the other
	 * data passed in
	 * @param object $startDate - the start date used to update the ride closure
	 * @param object $endDate - the end date used to update the ride closure
	 * @param object $rideId - the ride id of the associated ride used to update
	 * the ride closure
	 */
	public function updateRideClosure($id, $startDate, $endDate, $rideId)
	{
		$rideClosureToBeUpdated = RideClosurePeer::retrieveByPK($id);
		
		$rideClosureToBeUpdated->setStartDate($startDate);
		
		$rideClosureToBeUpdated->setEndDate($endDate);
		
		$rideClosureToBeUpdated->setRideId($rideId);
		
		$rideClosureToBeUpdated->save();
	}
}
?>

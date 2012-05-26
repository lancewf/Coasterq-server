<?php
require_once('persistence/RideWaitPeer.php');
require_once('persistence/UserPeer.php');
require_once('persistence/Property.php');
require_once('persistence/PropertyPeer.php');
require_once('EnteredRideWait.php');
require_once('park_model.php');

class Facebook_model extends Model
{
	
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	public function Facebook_model()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getAllEnteredRideWaits()
	{
		$parkModel = new Park_model();
		$parks = $parkModel->getParks();
		
		$allParksEnteredRideWaits = array();
		
		foreach($parks as $park)
		{
			$enteredRideWaits = $this->getRideWaits($park);
			
			$allParksEnteredRideWaits = 
				array_merge($allParksEnteredRideWaits, $enteredRideWaits);
		}
		
		usort($allParksEnteredRideWaits, array("Facebook_model", "enteredRideWaitCompare"));
		
		return array_slice($allParksEnteredRideWaits, 0, 5);
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	static function enteredRideWaitCompare($enteredRideWait1, $enteredRideWait2)
	{
	    if($enteredRideWait1->getDateTime() < 
	       $enteredRideWait2->getDateTime())
	    {
	    	return 1;
	    }
	    else if($enteredRideWait1->getDateTime() > 
	    		$enteredRideWait2->getDateTime())
	    {
	    	return -1;
	    }
	    else
	    {
	    	return 0;
	    }
	}
	
	private function getFacebookRideWaits($park)
	{
		$con = Propel::getConnection($database);
		
		// Get all ride waits where the user is a facebook user. 
		$sql = "SELECT " . RideWaitPeer::TABLE_NAME . ".* FROM " . RideWaitPeer::TABLE_NAME . 
		" INNER JOIN " . UserPeer::TABLE_NAME . " ON " . 
		RideWaitPeer::USER_ID . " = " . UserPeer::ID . 
		" WHERE " . UserPeer::NAME . " IS NOT NULL ORDER BY " . RideWaitPeer::DATE_TIME_IN_LINE . " DESC";
		
		$stmt = $con->createStatement();
    	$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);
    
		return $this->createEnteredRideWaits($con, $rs, $park);
	}
	
	private function getRideWaits($park)
	{
		$con = Propel::getConnection($park->getDatabaseName());
		
		// Get all ride waits
		$sql = "SELECT " . RideWaitPeer::TABLE_NAME . ".* FROM " . RideWaitPeer::TABLE_NAME .
		" ORDER BY " . RideWaitPeer::DATE_TIME_IN_LINE . " DESC";
		
		$stmt = $con->createStatement();
    	$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

    	return $this->createEnteredRideWaits($con, $rs, $park);
	}
	
    private function createEnteredRideWaits($con, $rs, $park)
    {
    	$enteredRideWaits = array();
    	
    	$index = 0; 
    	while($rs->next() && $index < 5) 
    	{
    		$rideWait = new RideWait();
  			$rideWait->hydrate($rs);
  			
    		$enteredRideWait = new EnteredRideWait();
    		
    		$user = $rideWait->getUser($con);
    		$ride = $rideWait->getRide($con);
    		
    		$enteredRideWait->setParkName($park->getName());
    		
    		$enteredRideWait->setParkUrl($park->getUrl());
    		
    		$enteredRideWait->setRideName($ride->getName());
    		    		
    		$enteredRideWait->setFacebookUid($user->getName());

    		$enteredRideWait->setWaitTime($rideWait->getWaitTime());
    		$enteredRideWait->setDateTime($rideWait->getDateTimeInLine(NULL));

    		array_push($enteredRideWaits, $enteredRideWait);
    		
    		$index++;
    	}
    	
    	return $enteredRideWaits;
	}
}

?>
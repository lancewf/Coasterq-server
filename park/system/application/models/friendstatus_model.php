<?php
require_once('FriendStatus.php');

class FriendStatus_model extends Model
{
	
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	public function FriendStatus_model()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getUserFriendsRideStatus()
	{
		$friendStatuses = array ();
		if($this->facebook_connect->isConnected())
		{
			$friendUids = $this->facebook_connect->client->friends_getAppUsers();
			
			foreach($friendUids as $friendUid)
			{
				$friend = $this->user_model->getFacebookUser($friendUid);
				
				if($friend)
				{
					$rideWaits = $friend->getRideWaits();
					
					foreach($rideWaits as $rideWait)
					{
						$friendStatus = new FriendStatus();
						
						$friendStatus->setRide($rideWait->getRide());
						$friendStatus->setFacebookUid($friendUid);
						$friendStatus->setWaitTime($rideWait->getWaitTime());
						$friendStatus->setDateTime(
							$rideWait->getDateTimeInLine(null));
						
						array_push($friendStatuses, $friendStatus);
					}
				}
			}
		}
		
		if(count($friendStatuses) == 0)
		{
			$friendStatuses = $this->getRideWaits();
		}
		
		usort($friendStatuses, array("FriendStatus_model", "friendStatusCompare"));
		
		if(count($friendStatuses) > 10)
		{
			$friendStatuses = array_slice($friendStatuses, 0, 10);
		}
		
		return $friendStatuses;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	static function friendStatusCompare($friendStatus1, $friendStatus2)
	{
	    if($friendStatus1->getDateTime() < 
	       $friendStatus2->getDateTime())
	    {
	    	return 1;
	    }
	    else if($friendStatus1->getDateTime() > 
	    		$friendStatus2->getDateTime())
	    {
	    	return -1;
	    }
	    else
	    {
	    	return 0;
	    }
	}
	
	private function getRideWaits()
	{
		$con = Propel::getConnection();
		
		// Get all ride waits
		$sql = "SELECT " . RideWaitPeer::TABLE_NAME . ".* FROM " . RideWaitPeer::TABLE_NAME .
		" ORDER BY " . RideWaitPeer::DATE_TIME_IN_LINE . " DESC";
		
		$stmt = $con->createStatement();
    	$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);
    	
    	$enteredRideWaits = array();
    	
    	$index = 0; 
    	while($rs->next() && $index < 5) 
    	{
    		$rideWait = new RideWait();
  			$rideWait->hydrate($rs);
    		$user = $rideWait->getUser();
    		
			$friendStatus = new FriendStatus();
			
			$friendStatus->setRide($rideWait->getRide());
			$friendStatus->setFacebookUid($user->getName());
			$friendStatus->setDateTime($rideWait->getDateTimeInLine(null));
			$friendStatus->setWaitTime($rideWait->getWaitTime());
			
    		array_push($enteredRideWaits, $friendStatus);
    		
    		$index++;
    	}
    	
    	return $enteredRideWaits;
	}
}

?>
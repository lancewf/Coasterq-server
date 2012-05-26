<?php



class Users_online_model extends Model 
{
	// -------------------------------------------------------------------------
	// Private Data
	// -------------------------------------------------------------------------
	
 	const TIME_1_DAY = 86400;
	 	
 	// -------------------------------------------------------------------------
	// Contructor
	// -------------------------------------------------------------------------
 	
	public function User_model()
	{
		parent::Model();
		
		require_once('persistence/UserPeer.php');
		require_once('park_model.php');
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getNumberOfUsersOnline()
	{
		$parkModel = new Park_model();
		$parks = $parkModel->getParks();
		
		$count = 0;

		foreach($parks as $park)
		{
			$parkCount = $this->getNumberOfUsersOnlineAtPark($park);
			
			$count = $parkCount + $count;
		}
		
		return $count;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	private function getNumberOfUsersOnlineAtPark($park)
	{
		$parkClock = $park->getParkClock();
		$parkTime = $parkClock->getTime();
		
		$con = Propel::getConnection($park->getDatabaseName());
		$dayBeforeTime = $parkTime - Users_online_model::TIME_1_DAY;
		
		$criteria = new Criteria($park->getDatabaseName());
		$criteria->add(UserPeer::LAST_TIME_LOGGED_IN, $dayBeforeTime,
		 Criteria::GREATER_EQUAL);
		$criteria->addAnd(UserPeer::LAST_TIME_LOGGED_IN, $parkTime, 
		 Criteria::LESS_EQUAL);
		
		$userCount = UserPeer::doCount($criteria, false, $con);
		
		return $userCount;
	}
}

?>
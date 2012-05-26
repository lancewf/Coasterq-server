<?php



class Users_online_model extends Model 
{
 	const TIME_1_DAY = 86400;
	 	
	public function User_model()
	{
		parent::Model();
		
		require_once('persistence/UserPeer.php');
		require_once('parkclock_model.php');
	}
	
	public function getNumberOfUsersOnline()
	{
		$parkclock_model = new Parkclock_model();
		$parkClock = $parkclock_model->getParkClock();
		
		$parkClock->getTime();
		
		$dayBeforeTime = $parkClock->getTime() - Users_online_model::TIME_1_DAY;
		
		$criteria = new Criteria();
		$criteria->add(UserPeer::LAST_TIME_LOGGED_IN, $dayBeforeTime,
		 Criteria::GREATER_EQUAL);
		$criteria->addAnd(UserPeer::LAST_TIME_LOGGED_IN, $parkClock->getTime(), 
		 Criteria::LESS_EQUAL);
		
		$userCount = UserPeer::doCount($criteria);
		
		return $userCount;
	}
}

?>
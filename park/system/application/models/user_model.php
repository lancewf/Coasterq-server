<?php
class User_model extends Model 
{
	public function User_model()
	{
		parent::Model();
		
		require_once('persistence/RegisterUser.php');
		require_once('persistence/GenericUser.php');
		require_once('persistence/Itinerary.php');
		require_once('parkclock_model.php');
		
		$this->load->helper('cookie');
		$this->load->helper('guid');
	}
	
	/**
	 * Get user. The user should already be login. If the user is not login null
	 * will be returned.
	 */
	public function getUser()
	{
		$cookieId = getCookieId();
		if($cookieId)
		{
      		$user = UserPeer::retrieveByPK($cookieId);

      		return $user;
		}
		else
		{
			return null;
		}
	}
	
	private function setTimeStamp($user)
	{
		$parkclock_model = new Parkclock_model();
		$parkClock = $parkclock_model->getParkClock();
		
		$user->setLastTimeLoggedIn($parkClock->getTime());
		
		$user->save();
	}
	
	/**
	 * This method should only be called when the user first contacts the page 
	 * and only once.
	 * 
	 * Having this only call in one place allows users to not call other services
	 * with out going through the correct method. 
	 */
	public function getOrCreateUser()
	{
		$cookieId = getCookieId();
		if(!$cookieId)
		{
			$cookieId = $this->createNewCookie();
			$user = $this->createNewGenericUser($cookieId);
		}
		else
		{			
			$user = $this->getUser($cookieId);
			if(!$user)
			{
				$user = $this->createNewGenericUser($cookieId);
			}
		}
		
		$this->setTimeStamp($user);

		return $user;
	}
	
	public function logOutUser()
	{
		delete_cookie(cookie_tag());
	}
   
   	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
    private function createNewCookie()
    {
    	$cookieId = generateGUID();
		set_cookie(cookie_tag(), $cookieId, 60*60*24*364*2);
		
		return $cookieId;
    }
   
   	private function createNewGenericUser($cookieId)
	{
		$newUser = new GenericUser();	
		
		$newUser->setId($cookieId);
		
		$itinerary = new Itinerary();
		
		$itinerary->setUser($newUser);
		$itinerary->setDate(Time());
		
		$itinerary->save();
		
		$newUser->save();
		
		return $newUser;
	}
}
?>
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
	
	// returns true for new user false for returning user
	public function logInUser($facebookUserId)
	{
		$isNewUser = false;
		$user = null;
		if(!$this->getFacebookUser($facebookUserId))
		{
			$user = $this->createNewFacebookUser($facebookUserId);
			
			$isNewUser = true;
		}
		else
		{
			$user = $this->logInFacebookUser($facebookUserId);
			
			$isNewUser = false;
		}
		
		$this->setTimeStamp($user);
		
		return $isNewUser;
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
			else if($this->isFacebookUser($user) && 
				!$this->facebook_connect->isConnected())
			{
				$this->logOutUser();
				
				$cookieId = $this->createNewCookie();
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
	
	public function getFacebookUser($facebookUserId)
	{
		$criteria = new Criteria();

		$criteria->add(UserPeer::NAME, $facebookUserId);
		
		$users = UserPeer::doSelect($criteria);
		
		if(count($users) > 0)
		{
			return $users[0];
		}
		else
		{
			return null;
		}
	}
   
   	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
   
	private function logInFacebookUser($facebookUserId)
	{
		$user = $this->getFacebookUser($facebookUserId);
		
		$cookieId = $user->getId();
		
		set_cookie(cookie_tag(), $cookieId, 60*60*24*364*2);
		
		return $user;
	}
	
	private function createNewFacebookUser($facebookUserId)
	{
		$cookieId = getCookieId();
		
		$user = $this->getUser($cookieId);

		if($user)
		{
			$user->delete();
		}
		
		$newUser = new RegisterUser();	

		if(!$cookieId)
		{
			$cookieId = $this->createNewCookie();
		}
		
		$newUser->setId($cookieId);
		$newUser->setName($facebookUserId);
		
		$itinerary = new Itinerary();
		
		$itinerary->setUser($newUser);
		$itinerary->setDate(Time());
	
		$itinerary->save();
		
		$newUser->save();

		return $newUser;
	}
	
	private function isFacebookUser($user)
	{
		if($user instanceof RegisterUser)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
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
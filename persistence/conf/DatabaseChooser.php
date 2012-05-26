<?php


/**
 * This class is used to choose the correct database for the user coming in
 * on a specific site. 
 * 
 * Therefore if the user comes in under animal-kingdom.coasterq.com or 
 * www.animal-kingdom.coasterq.com this code selects the correct database to 
 * display Animal Kingdoms data. 
 */
class DatabaseChooser
{
	public function getDatabase()
	{
		$userURL = $_SERVER['HTTP_HOST'];
		return $this->findDatabaseName($userURL);
	}
	
	/**
	 * Find the database name from the clients URL
	 * 
	 * @return the name of the database
	 * @param object $userURL - clients URL
	 */
	private function findDatabaseName($userURL)
	{
		if(strpos($userURL,  "animal-kingdom.coasterq.com") !== false)
		{
			return 'animalkingdom';
		}
		else if(strpos($userURL,  "tokyo-disneyland.coasterq.com") !== false)
		{
			return 'tokyodisneyland';
		}
		else if(strpos($userURL ,  "busch-gardens-tampa.coasterq.com") !== false)
		{
			return 'buschgardenstampa';
		}
		else if(strpos($userURL ,  "disneyland.coasterq.com") !== false)
		{
			return 'disneyland';
		}
		else if(strpos($userURL ,  "disneyland-park.coasterq.com") !== false)
		{
			return 'parcdisneyland';
		}
		else if(strpos($userURL ,  "epcot.coasterq.com") !== false)
		{
			return 'epcot';
		}
		else if(strpos($userURL, "hollywood-studios.coasterq.com") !== false)
		{
			return 'hollywoodstudios';
		}
		else if(strpos($userURL,  "islands-of-adventure.coasterq.com") !== false)
		{
			return 'islandsofadventure';
		}
		else if(strpos($userURL,  "knotts-berry-farm.coasterq.com") !== false)
		{
			return 'knottsberryfarm';
		}
		else if(strpos($userURL, "legoland-california.coasterq.com") !== false)
		{
			return 'legolandcalifornia';
		}
		else if(strpos($userURL,  "magic-mountain.coasterq.com") !== false)
		{
			return 'magicmountain';
		}
		else if(strpos($userURL,  "over-texas.coasterq.com") !== false)
		{
			return 'overtexas';
		}
		else if(strpos($userURL,  "seaworld-orlando.coasterq.com") !== false)
		{
			return 'seaworldorlando';
		}
		else if(strpos($userURL, "tokyo-disneysea.coasterq.com") !== false)
		{
			return 'tokyodisneysea';
		}
		else if(strpos($userURL,  "universal-studios-florida.coasterq.com") !== false)
		{
			return 'universalstudiosflorida';
		}
		else if(strpos($userURL, "universal-studios-hollywood.coasterq.com") !== false)
		{
			return 'universalstudioshollywood';
		}
		else if(strpos($userURL,  "walt-disney-studios-park.coasterq.com") !== false)
		{
			return 'waltdisneystudiospark';
		}
		else if(strpos($userURL, "magic-kingdom.coasterq.com") !== false)
		{
			return 'magickingdom';
		}
		else if(strpos($userURL, "california-adventure.coasterq.com") !== false)
		{
			return 'californiaadventure';
		}
		else if(strpos($userURL,  "great-adventure.coasterq.com") !== false)
		{
			return 'greatadventure';
		}
		else if(strpos($userURL,  "great-america.coasterq.com") !== false)
		{
			return 'greatamerica';
		}
		else if(strpos($userURL,  "over-georgia.coasterq.com") !== false)
		{
			return 'overgeorgia';
		}
		else if(strpos($userURL,  "discovery-kingdom.coasterq.com") !== false)
		{
			return 'discoverykingdom';
		}
		else if(strpos($userURL,  "seaworld-san-antonio.coasterq.com") !== false)
		{
			return 'seaworldsanantonio';
		}
		else if(strpos($userURL,  "kentucky-kingdom.coasterq.com") !== false)
		{
			return 'kentuckykingdom';
		}
		else if(strpos($userURL,  "six-flags-america.coasterq.com") !== false)
		{
			return 'sixflagsamerica';
		}
		else if(strpos($userURL,  "canadas-wonderland.coasterq.com") !== false)
		{
			return 'canadaswonderland';
		}
		else if(strpos($userURL,  "cedar-point.coasterq.com") !== false)
		{
			return 'cedarpoint';
		}
		else if(strpos($userURL,  "hersheypark.coasterq.com") !== false)
		{
			return 'hersheypark';
		}
		else if(strpos($userURL,  "new-england.coasterq.com") !== false)
		{
			return 'newengland';
		}
		else if(strpos($userURL,  "thorpe-park.coasterq.com") !== false)
		{
			return 'thorpepark';
		}
		else if(strpos($userURL,  "st-louis.coasterq.com") !== false)
		{
			return 'stlouis';
		}
	}
}

?>

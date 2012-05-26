<?php

class Database_names_model extends Model
{
	
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	public function Database_names_model()
	{
		parent::Model();
	}
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function getDatabaseNames()
	{
		$databases = array('animalkingdom', 'tokyodisneyland', 'buschgardenstampa', 
			'disneyland', 'parcdisneyland', 'epcot', 'hollywoodstudios', 
			'islandsOfAdventure', 'knottsberryfarm', 'legolandcalifornia', 'magicmountain', 
			'overtexas', 'seaworldorlando', 'tokyodisneysea', 'universalStudiosFlorida', 
			'universalStudiosHollywood', 'waltdisneystudiospark', 'magickingdom', 
			'californiaadventure', 'greatadventure', 'greatamerica', 'overgeorgia', 
			'discoverykingdom', 'seaworldsanantonio', 
			'sixflagsamerica', 'canadaswonderland', 'cedarpoint', 'hersheypark', 
			'newengland', 'thorpepark', 'stlouis');

//		$databases = array('park', 'park2');
		
		return $databases;
	}
}

?>

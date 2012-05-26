<?php
require_once('persistence/Land.php');
class Land_model extends Model 
{

	function Land_model()
	{
		parent::Model();
	}
	
	public function addLand($name)
	{
		$newLand = new Land();
		
		$newLand->setName($name);
		
		$newLand->save();
		
		return $newLand;
	}
	
	public function clearAll()
	{
		LandPeer::doDeleteAll();
	}
}
?>
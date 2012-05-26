<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'itinerary' table to 'persistence' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel on:
 *
 * Wed Apr 14 18:59:08 2010
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    persistence.map
 */
class ItineraryMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'persistence.map.ItineraryMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('persistence');

		$tMap = $this->dbMap->addTable('itinerary');
		$tMap->setPhpName('Itinerary');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'string', CreoleTypes::VARCHAR, 'user', 'ID', true, 50);

		$tMap->addColumn('DATE', 'Date', 'int', CreoleTypes::DATE, true, null);

	} // doBuild()

} // ItineraryMapBuilder

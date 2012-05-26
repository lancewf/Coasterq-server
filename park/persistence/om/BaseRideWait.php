<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'persistence/RideWaitPeer.php';

/**
 * Base class that represents a row from the 'ride_wait' table.
 *
 * A wait time on a ride
 *
 * This class was autogenerated by Propel on:
 *
 * Wed Apr 14 18:59:08 2010
 *
 * @package    persistence.om
 */
abstract class BaseRideWait extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RideWaitPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the ride_id field.
	 * @var        int
	 */
	protected $ride_id;


	/**
	 * The value for the user_id field.
	 * @var        string
	 */
	protected $user_id;


	/**
	 * The value for the date_time_in_line field.
	 * @var        int
	 */
	protected $date_time_in_line;


	/**
	 * The value for the wait_time field.
	 * @var        int
	 */
	protected $wait_time;


	/**
	 * The value for the latitude field.
	 * @var        double
	 */
	protected $latitude;


	/**
	 * The value for the longitude field.
	 * @var        double
	 */
	protected $longitude;


	/**
	 * The value for the inside_park field.
	 * @var        boolean
	 */
	protected $inside_park;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        Ride
	 */
	protected $aRide;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * itinerary Id
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [ride_id] column value.
	 * Foreign Key for ride
	 * @return     int
	 */
	public function getRideId()
	{

		return $this->ride_id;
	}

	/**
	 * Get the [user_id] column value.
	 * user Id
	 * @return     string
	 */
	public function getUserId()
	{

		return $this->user_id;
	}

	/**
	 * Get the [optionally formatted] [date_time_in_line] column value.
	 * date time in line
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getDateTimeInLine($format = 'Y-m-d H:i:s')
	{

		if ($this->date_time_in_line === null || $this->date_time_in_line === '') {
			return null;
		} elseif (!is_int($this->date_time_in_line)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->date_time_in_line);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [date_time_in_line] as date/time value: " . var_export($this->date_time_in_line, true));
			}
		} else {
			$ts = $this->date_time_in_line;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [wait_time] column value.
	 * time in line
	 * @return     int
	 */
	public function getWaitTime()
	{

		return $this->wait_time;
	}

	/**
	 * Get the [latitude] column value.
	 * the latitude of the user when the time was entered
	 * @return     double
	 */
	public function getLatitude()
	{

		return $this->latitude;
	}

	/**
	 * Get the [longitude] column value.
	 * the longitude of the user when the time was entered
	 * @return     double
	 */
	public function getLongitude()
	{

		return $this->longitude;
	}

	/**
	 * Get the [inside_park] column value.
	 * entry was inside park
	 * @return     boolean
	 */
	public function getInsidePark()
	{

		return $this->inside_park;
	}

	/**
	 * Set the value of [id] column.
	 * itinerary Id
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RideWaitPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [ride_id] column.
	 * Foreign Key for ride
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRideId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ride_id !== $v) {
			$this->ride_id = $v;
			$this->modifiedColumns[] = RideWaitPeer::RIDE_ID;
		}

		if ($this->aRide !== null && $this->aRide->getId() !== $v) {
			$this->aRide = null;
		}

	} // setRideId()

	/**
	 * Set the value of [user_id] column.
	 * user Id
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUserId($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = RideWaitPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} // setUserId()

	/**
	 * Set the value of [date_time_in_line] column.
	 * date time in line
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDateTimeInLine($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [date_time_in_line] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date_time_in_line !== $ts) {
			$this->date_time_in_line = $ts;
			$this->modifiedColumns[] = RideWaitPeer::DATE_TIME_IN_LINE;
		}

	} // setDateTimeInLine()

	/**
	 * Set the value of [wait_time] column.
	 * time in line
	 * @param      int $v new value
	 * @return     void
	 */
	public function setWaitTime($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->wait_time !== $v) {
			$this->wait_time = $v;
			$this->modifiedColumns[] = RideWaitPeer::WAIT_TIME;
		}

	} // setWaitTime()

	/**
	 * Set the value of [latitude] column.
	 * the latitude of the user when the time was entered
	 * @param      double $v new value
	 * @return     void
	 */
	public function setLatitude($v)
	{

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = RideWaitPeer::LATITUDE;
		}

	} // setLatitude()

	/**
	 * Set the value of [longitude] column.
	 * the longitude of the user when the time was entered
	 * @param      double $v new value
	 * @return     void
	 */
	public function setLongitude($v)
	{

		if ($this->longitude !== $v) {
			$this->longitude = $v;
			$this->modifiedColumns[] = RideWaitPeer::LONGITUDE;
		}

	} // setLongitude()

	/**
	 * Set the value of [inside_park] column.
	 * entry was inside park
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setInsidePark($v)
	{

		if ($this->inside_park !== $v) {
			$this->inside_park = $v;
			$this->modifiedColumns[] = RideWaitPeer::INSIDE_PARK;
		}

	} // setInsidePark()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ride_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getString($startcol + 2);

			$this->date_time_in_line = $rs->getTimestamp($startcol + 3, null);

			$this->wait_time = $rs->getInt($startcol + 4);

			$this->latitude = $rs->getFloat($startcol + 5);

			$this->longitude = $rs->getFloat($startcol + 6);

			$this->inside_park = $rs->getBoolean($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = RideWaitPeer::NUM_COLUMNS - RideWaitPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RideWait object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RideWaitPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RideWaitPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RideWaitPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aRide !== null) {
				if ($this->aRide->isModified()) {
					$affectedRows += $this->aRide->save($con);
				}
				$this->setRide($this->aRide);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RideWaitPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RideWaitPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aRide !== null) {
				if (!$this->aRide->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRide->getValidationFailures());
				}
			}


			if (($retval = RideWaitPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RideWaitPeer::DATABASE_NAME);

		if ($this->isColumnModified(RideWaitPeer::ID)) $criteria->add(RideWaitPeer::ID, $this->id);
		if ($this->isColumnModified(RideWaitPeer::RIDE_ID)) $criteria->add(RideWaitPeer::RIDE_ID, $this->ride_id);
		if ($this->isColumnModified(RideWaitPeer::USER_ID)) $criteria->add(RideWaitPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(RideWaitPeer::DATE_TIME_IN_LINE)) $criteria->add(RideWaitPeer::DATE_TIME_IN_LINE, $this->date_time_in_line);
		if ($this->isColumnModified(RideWaitPeer::WAIT_TIME)) $criteria->add(RideWaitPeer::WAIT_TIME, $this->wait_time);
		if ($this->isColumnModified(RideWaitPeer::LATITUDE)) $criteria->add(RideWaitPeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(RideWaitPeer::LONGITUDE)) $criteria->add(RideWaitPeer::LONGITUDE, $this->longitude);
		if ($this->isColumnModified(RideWaitPeer::INSIDE_PARK)) $criteria->add(RideWaitPeer::INSIDE_PARK, $this->inside_park);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RideWaitPeer::DATABASE_NAME);

		$criteria->add(RideWaitPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RideWait (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRideId($this->ride_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setDateTimeInLine($this->date_time_in_line);

		$copyObj->setWaitTime($this->wait_time);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setLongitude($this->longitude);

		$copyObj->setInsidePark($this->inside_park);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     RideWait Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     RideWaitPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RideWaitPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUser($con = null)
	{
		// include the related Peer class
		include_once 'persistence/om/BaseUserPeer.php';

		if ($this->aUser === null && (($this->user_id !== "" && $this->user_id !== null))) {

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->user_id, $con);
			   $obj->addUsers($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a Ride object.
	 *
	 * @param      Ride $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setRide($v)
	{


		if ($v === null) {
			$this->setRideId(NULL);
		} else {
			$this->setRideId($v->getId());
		}


		$this->aRide = $v;
	}


	/**
	 * Get the associated Ride object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Ride The associated Ride object.
	 * @throws     PropelException
	 */
	public function getRide($con = null)
	{
		// include the related Peer class
		include_once 'persistence/om/BaseRidePeer.php';

		if ($this->aRide === null && ($this->ride_id !== null)) {

			$this->aRide = RidePeer::retrieveByPK($this->ride_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = RidePeer::retrieveByPK($this->ride_id, $con);
			   $obj->addRides($this);
			 */
		}
		return $this->aRide;
	}

} // BaseRideWait
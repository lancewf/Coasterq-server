/**
 * This class manages the details of a search for specific rides. 
 */
function RideSearchManager(rideManager)
{	
	// -------------------------------------------------------------------------
	// Public Class Variables
	// -------------------------------------------------------------------------
	
	this.FASTPASS_ALL = 'all';
	this.FASTPASS_YES = 'yes';
	this.FASTPASS_NO = 'no';
	this.RIDE_LOCATION_ALL = "all";
	this.HEIGHT_REQUIREMENT_ALL = "all";
	this.HEIGHT_REQUIREMENT_NO = "no";
	this.HEIGHT_REQUIREMENT_YES = "yes";
	this.MAX_WAIT_TIME_ALL = "all";
	this.MAX_WAIT_TIME_30 = "30";
	this.MAX_WAIT_TIME_60 = "60";
	this.MAX_WAIT_TIME_90 = "90";
	this.MAX_WAIT_TIME_120 = "120";
	
	// -------------------------------------------------------------------------
	// Private Instance Variables
	// -------------------------------------------------------------------------
	
	
	this._fastpass = "all";
	this._rideLocation = "all";
	this._heightRequirement = "all";
	this._maxWaitTime = "all";
	this._rideManager = rideManager;
		
	// -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
	this.setRideLocation = function(rideLocation)
	{
		this._rideLocation = rideLocation;
	}
	
	this.getRideLocation = function()
	{
		return this._rideLocation;
	}
	
	this.setFastpass = function(fastpass)
	{
		this._fastpass = fastpass;
	}
	
	this.getFastpass = function()
	{
		return this._fastpass;
	}
	
	this.setHeightRequirement = function(heightRequirement)
	{
		this._heightRequirement = heightRequirement;	
	}
	
	this.getHeightRequirement = function()
	{
		return this._heightRequirement;
	}
	
	this.setMaxWaitTime = function(maxWaitTime)
	{
		this._maxWaitTime = maxWaitTime;
	}
	
	this.getMaxWaitTime = function()
	{
		return this._maxWaitTime;
	}
	
	this.getRides = function()
	{
		var rides = this._rideManager.getRides();
		var foundRides = new Array();
		
		for(var index = 0; index < rides.length; index++)
		{
			var ride = rides[index];
			
			if(this.getRideLocation() != this.RIDE_LOCATION_ALL &&
			   this.getRideLocation() != ride.getLocation())
			{
				continue;
			}
			if(this.getFastpass() != this.FASTPASS_ALL &&
			   (this.getFastpass() == this.FASTPASS_NO && 
			   ride.getHasFastPass()) ||
			   (this.getFastpass() == this.FASTPASS_YES && 
			   !ride.getHasFastPass()))
			{
				continue;
			}
			if(this.getHeightRequirement() != this.HEIGHT_REQUIREMENT_ALL &&
			   (this.getHeightRequirement() == this.HEIGHT_REQUIREMENT_NO && 
			   ride.getHeightRequirement() > 0) ||
			   (this.getHeightRequirement() == this.HEIGHT_REQUIREMENT_YES && 
			   ride.getHeightRequirement() == 0))
			{
				continue;
			}
			if(this.getMaxWaitTime() != this.MAX_WAIT_TIME_ALL &&
			   (this.getMaxWaitTime() == this.MAX_WAIT_TIME_30 && 
			   ride.getCurrentTime() > 30) ||
			   (this.getMaxWaitTime() == this.MAX_WAIT_TIME_60 && 
			   ride.getCurrentTime() > 60) ||
			   (this.getMaxWaitTime() == this.MAX_WAIT_TIME_90 && 
			   ride.getCurrentTime() > 90) ||
			   (this.getMaxWaitTime() == this.MAX_WAIT_TIME_120 && 
			   ride.getCurrentTime() > 120))
			{
				continue;
			}
			foundRides.push(ride);			
		}
		
		return foundRides; 	
	}
}
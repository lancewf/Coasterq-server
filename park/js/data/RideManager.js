/**
 * Manages the ride Objects
 */
function RideManager()
{
	// ------------------------------------------------------------------
	// Public static Variables
	// ------------------------------------------------------------------
	
	this.STATUS_FAILURE = "failure";
	this.STATUS_SUCCESS = "success";
	
	// ------------------------------------------------------------------
	// Private static Variables
	// ------------------------------------------------------------------

	this._REFRESH_RATE = 300000; // 5 minutes
	//this._REFRESH_RATE = 5000; // 5 seconds
	
	// ------------------------------------------------------------------
	// Private Variables
	// ------------------------------------------------------------------
	
	this._updateListeners = new Array();
	this._rides = new Array();
	this._ajaxTransport = new AjaxTransport();
	this._status = this.STATUS_SUCCESS;

	// ------------------------------------------------------------------
	// Public Members
	// ------------------------------------------------------------------
	
	/**
	 * Get the status of the connection of the client with the server
	 * 
	 * There can be reponses
	 * - failure
	 * - success
 	 */
	//public
	this.getStatus = function()
	{
		return this._status;
	}
	
	/**
	 * Add an UpdateListener
	 * 
	 * The UpdateListener must implement the void refresh() method
	 */
	//public
	this.addUpdateListener = function(updateListener)
	{
		if(this._indexOfUpdateListener(updateListener) == -1)
		{
			this._updateListeners.push(updateListener);
		}
	}
	
	/**
	 * Remove an update listener
	 */
	//public
	this.removeUpdateListener = function(updateListener)
	{
		var indexOf = this._indexOfUpdateListener(updateListener); 
		
		if(indexOf >= 0)
		{
			this._updateListeners.splice(indexOf, 1);
		}
	}
	
	/**
	 * Get the current list of rides
	 * 
	 * @return Array of Ride objects
	 */
	//public
	this.getRides = function()
	{
		return this._rides;
	}
	
	/**
	 * Add a Ride object to the Ride Manager
	 */
	//public
	this.addRideObject = function(ride)
	{
		this._rides.push(ride);
	}
	
	/**
	 * Get a ride from the name of the ride
	 * 
	 * @return the Ride object with the name passed in
	 */
	//public
	this.getRideFromName = function(rideName)
	{
		var foundRide = null;
		
		for(var index = 0; index < this._rides.length; index++)
		{
			var ride = this._rides[index];
			
			if(ride.getName() == rideName)
			{
				foundRide = ride;
			}
		}
		
		return foundRide;
	}
	
	/**
	 * Get a ride from the id of the ride
	 * 
	 * @return the Ride object with the id passed in
	 */
	//public
	this.getRideFromId = function(rideId)
	{
		var foundRide = null;
		
		for(var index = 0; index < this._rides.length; index++)
		{
			var ride = this._rides[index];
			if(ride.getId() == rideId)
			{
				foundRide = ride;
			}
		}
		
		return foundRide;		
	}
	
	/**
	 * Sort the ride by thier name
	 */
	this.sortRides = function()
	{
		this._rides.sort(function(ride1, ride2)
		{
			return ride1.getName() > ride2.getName();
		});
	}
	
	// ------------------------------------------------------------------
	// Private Members
	// ------------------------------------------------------------------

	/**
	 * Get the index of the updateListener passed in
	 * 
	 * @param updateListener - the updateListener to find the index of
	 */
	//private
	this._indexOfUpdateListener = function(updateListener)
	{
    	for(var index = 0; index < this._updateListeners.length; index++)
    	{
    		if(updateListener == this._updateListeners[index])
    		{
    			return index;
    		}
    	}
    	return -1;
	}
	
	/**
	 * Notify all the listeners that the ride data has been changed. 
	 */
	//private
	this._notifyListeners = function()
	{
		for(var index = 0; index < this._updateListeners.length; index++)
		{
			var listener = this._updateListeners[index];
			listener.refresh();
		}
	}
	
	/**
	 * Update the client rides in this manager.
	 * 
	 * Request the server for the ride information.
	 */
	//private
	this._updateClientRides = function()
	{
		var rideManager = this;
		this._ajaxTransport.makeServerRequest(base_services_url + 
			'getRidesUpdate', "", function(response)
        {
        	if(response)
        	{
				rideManager._status = rideManager._STATUS_SUCCESS;
	            rideManager._parseRidesUpdateResponse(
	                    response);
        	}
        	else
        	{
        		rideManager._status = rideManager._STATUS_FAILURE;
        	}
           	rideManager._startTimer();
            rideManager._notifyListeners();
        }); 
	}
	
	/**
	 * Parses the ride data from the server. 
	 * 
	 * Updates each of the rides data:
	 * current time - the current wait time for the ride
	 * average time - the average wait time for the ride for the day
	 * shortest time - the time of the day the wait time is the shortest
	 * 
	 * This does not handle the case where a new ride is added. 
	 */
	//private
	this._parseRidesUpdateResponse = function(response)
	{
        var rideDatas = response.split(",");

		for(var index = 0; index < rideDatas.length; index++)
		{
			var rideData = rideDatas[index];
			
            var pars = rideData.split("-");

            var rideId = pars[0];
            var currentTime = pars[1];
            var averageTime = pars[2];
            var shorestTimeHour = pars[3];
            var shorestTimeMin = pars[4];
            var shorestTime = pars[5];
            
            var ride = this.getRideFromId(rideId);

            ride.setCurrentTime(currentTime);
			ride.setAverageTime(averageTime);
			ride.setNextShortestDateTime(
				new Date(1977, 10, 23, shorestTimeHour, shorestTimeMin));
			ride.setNextShortestTime(shorestTime);
        }
	}
	
	/**
	 * Start the timer to update the rides
	 */
	//private
	this._startTimer = function()
	{
		var rideManager = this;
		this.timer = setTimeout(
    		function() 
    		{ 
    			rideManager._updateClientRides(); 
    		}, 
    		this._REFRESH_RATE);
	}
	
	/**
	 * Stop the timer that updates the rides
	 */
	// private
	this._stopTimer = function()
	{
		clearTimeout(this.timer);
	}
	
	// ------------------------------------------------------------------
	// Contructor
	// ------------------------------------------------------------------
	
	this._startTimer();
}
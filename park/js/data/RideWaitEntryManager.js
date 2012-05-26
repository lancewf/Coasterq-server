/**
 * The Ride wait entry manager manages all the RideWait objects. 
 */
function RideWaitEntryManager()
{
	// -------------------------------------------------------------------------
	// Public Static Variables
	// -------------------------------------------------------------------------
	
	this.STATUS_FAILURE = "failure";
	this.STATUS_SUCCESS = "success";

	// -------------------------------------------------------------------------
	// Private Static Variables
	// -------------------------------------------------------------------------
	
	this._WAIT_PERIOD = 300000; // 5 minutes
	//this._WAIT_PERIOD = 3000; // 3 seconds
	
    // -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
    
	this._rideWaitEnties = new Array();
    this._ajaxTransport = new AjaxTransport();
    this._status = this.STATUS_SUCCESS;
    this._updateListeners = new Array();
	
    // -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
    //public
	this.getStatus = function()
	{
		return this._status;
	}
	
	//public
	this.addUpdateListener = function(listener)
	{
		if(this._indexOfUpdateListener(listener) == -1)
		{
			this._updateListeners.push(listener);
		}
	}
	
	//public
	this.removeUpdateListener = function(listener)
	{
		var indexOf = this._indexOfUpdateListener(listener); 
		
		if(indexOf >= 0)
		{
			this._updateListeners.splice(indexOf, 1);
		}
	}
	
	//public
	this.addRideWaitEntry = function(rideWaitEntry)
	{
		this._rideWaitEnties.push(rideWaitEntry);
		this._sendEntriesToServer();
	}
	
	//public
	this.getUnsentRideWaitEntries = function()
	{
		return this._rideWaitEnties;
	}
	
	// -------------------------------------------------------------------------
    // Private Members
    // -------------------------------------------------------------------------
	
	//private
	this._notifyListeners = function()
	{
		for(var index = 0; index < this._updateListeners.length; index++)
		{
			var listener = this._updateListeners[index];
			listener.refresh();
		}
	}
	
	//private
	this._indexOfUpdateListener = function(listener)
	{
    	for(var index = 0; index < this._updateListeners.length; index++)
    	{
    		if(listener == this._updateListeners[index])
    		{
    			return index;
    		}
    	}
    	return -1;
	}
	
	
	//private
	this._sendEntriesToServer = function()
	{
		if(this._rideWaitEnties.length > 0)
		{
			var rideWaitEntryToSend = this._rideWaitEnties[0];
			var rideWaitEntryManager = this;
			
			var params='rideId='+
					rideWaitEntryToSend.getRide().getId() + 
					'&waitmin=' + rideWaitEntryToSend.getWaitTimeMin() +
					'&timehour=' + rideWaitEntryToSend.getTimeHour() +
					'&timemin=' + rideWaitEntryToSend.getTimeMin() +
					'&dayofmonth=' +rideWaitEntryToSend.getDayOfMonth() +
					'&month=' + rideWaitEntryToSend.getMonth() +
					'&year=' + rideWaitEntryToSend.getYear();
			
			this._ajaxTransport.makeServerRequest(base_services_url + 
				'enterTimeForRide', params, function(reponse)
			{	
				if(reponse == "success" || reponse == "invalid")
				{
					rideWaitEntryManager._status = rideWaitEntryManager._STATUS_SUCCESS;
					rideWaitEntryManager._removeRideWaitEntry(rideWaitEntryToSend);
					rideWaitEntryManager._sendEntriesToServer();
					
					if(reponse == "invalid")
					{
						//alert("invalid");	
					}
				}
				else
				{
					rideWaitEntryManager._status = 
						rideWaitEntryManager._STATUS_FAILURE;
					rideWaitEntryManager._startTimer()
				}

				rideWaitEntryManager._notifyListeners();
			});
		}
	}
	
	//private
	this._startTimer = function()
	{
		var rideWaitEntryManager = this;
		
		this.timer = setTimeout(
		function() 
		{ 
			rideWaitEntryManager._sendEntriesToServer(); 
		}, 
		this._WAIT_PERIOD);
	}
	
	//private
	this._removeRideWaitEntry = function(rideWaitEntry)
	{
		var indexOf = this._indexOfRideWaitEntry(rideWaitEntry);
		if(indexOf >= 0)
		{
			this._rideWaitEnties.splice(indexOf, 1);
		}
	}
	
	//private
    this._indexOfRideWaitEntry = function(rideWaitEntry)
    {
    	for(var index = 0; index < this._rideWaitEnties.length; index++)
    	{
    		if(rideWaitEntry.equals(this._rideWaitEnties[index]))
    		{
    			return index;
    		}
    	}
    	return -1;
    }
}
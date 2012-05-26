/**
 * @author lancewf
 */
RideClosureManager = Class.create(
{
	initialize: function(rideManager)
	{
		this._rideManager = rideManager;
		this._rideClosures = new Array();
		this._ajaxTransport = new AjaxTransport();
		this._updateListeners = new Array();
	},
	
	addRideClosure: function(rideClosure)
	{
		this._rideClosures.push(rideClosure);
		
		this._notifyListeners();
	},
	
	createNewRideClosure: function(startDate, endDate, rideId)
	{
		var ride = this._rideManager.getRideFromId(rideId);
			
		var rideClosure = new RideClosure(-1, startDate, endDate, ride);
		
		this._ajaxTransport.makeServerRequest(base_admin_url + 
			'createNewRideClosure', 'rideClosure='+
                this.getCreateNewRideClosureString(rideClosure), 
			function(reponse)
        {
 			if(reponse != null)
			{
				rideClosure.setId(reponse);
				this.addRideClosure(rideClosure);
			}
			else
			{
				alert("Error in creating a new ride closure " + reponse);
			}
        }.bind(this));
	},
	
	getCreateNewRideClosureString: function(rideClosure)
	{
		var startDay = rideClosure.getStartDate().getDate();
		var startMonth = rideClosure.getStartDate().getMonth() + 1;
		var startYear = rideClosure.getStartDate().getFullYear();
		
		var endDay = rideClosure.getEndDate().getDate();
		var endMonth = rideClosure.getEndDate().getMonth() + 1;
		var endYear = rideClosure.getEndDate().getFullYear();
		
		var serverString =  
			startDay + "-" + startMonth + "-" + startYear + "-" + 
			endDay + "-" + endMonth + "-" + endYear + "-" + 
			rideClosure.getRide().getId();
		
		return serverString;
	},
	
	saveRideClosure: function(originalRideClosure, 
		updatedStartDate, updatedEndDate)
	{
		var clonedRideClosure = originalRideClosure.clone();
		clonedRideClosure.setStartDate(updatedStartDate);
		clonedRideClosure.setEndDate(updatedEndDate);					

		this._ajaxTransport.makeServerRequest(base_admin_url + 
			'updateRideClosure', 'rideClosure='+
                this.getUpdateRideClosureString(clonedRideClosure), 
			function(reponse)
	    {
			if(reponse == "success")
			{
				originalRideClosure.setStartDate(updatedStartDate);
				originalRideClosure.setEndDate(updatedEndDate);
				
				this._notifyListeners();
			}
			else
			{
				alert("Error in Saving Ride Closure " + reponse);
			}
	    }.bind(this));
	},
	
	getUpdateRideClosureString: function(rideClosure)
	{
		var startDay = rideClosure.getStartDate().getDate();
		var startMonth = rideClosure.getStartDate().getMonth() + 1;
		var startYear = rideClosure.getStartDate().getFullYear();
		
		var endDay = rideClosure.getEndDate().getDate();
		var endMonth = rideClosure.getEndDate().getMonth() + 1;
		var endYear = rideClosure.getEndDate().getFullYear();
		
		var serverString =  
			rideClosure.getId() + "-" +
			startDay + "-" + startMonth + "-" + startYear + "-" + 
			endDay + "-" + endMonth + "-" + endYear + "-" + 
			rideClosure.getRide().getId();
		
		return serverString;
	},
	
	removeRideClosure: function(rideClosureToBeDeleted)
	{
		var indexOf = this._indexOfRideClosure(rideClosureToBeDeleted); 
		
		if(indexOf >= 0)
		{
			this._ajaxTransport.makeServerRequest(base_admin_url + 
				'deleteRideClosure', 'rideClosureId='+
		            rideClosureToBeDeleted.getId(), 
				function(reponse)
		    {
				if(reponse == "success")
				{	
					this._rideClosures.splice(indexOf, 1);
					this._notifyListeners();
				}
				else
				{
					alert("Error in deleting Ride Closure " + reponse);
				}
		    }.bind(this));
		}
	},
	
	_indexOfRideClosure : function(rideClosure)
	{
    	for(var index = 0; index < this._rideClosures.length; index++)
    	{
    		if(rideClosure == this._rideClosures[index])
    		{
    			return index;
    		}
    	}
    	return -1;
	},
	
	getRidesThatAreClosed: function(day, month, year)
	{
		var matchingRides = new Array();
		
		var date = new Date(year, month-1, day, 0, 0, 0);
		
		this._rideClosures.each(function (rideClosure)
		{
			if(rideClosure.isWithinRange(date))
			{
				matchingRides.push(rideClosure.getRide());
			}
		});
		
		return matchingRides;
	},
	
	getClosuresFromRide: function(ride)
	{
		var matchingRideClosures = new Array();
				
		this._rideClosures.each(function (rideClosure)
		{
			if(rideClosure.getRide().equals(ride))
			{
				matchingRideClosures.push(rideClosure);
			}
		});
		
		matchingRideClosures.sort(function(rideClosures1, rideClosures2)
		{
			return rideClosures1.getStartDate() > rideClosures2.getStartDate();
		});
		
		return matchingRideClosures;
	},
	
	/**
	 * Add an UpdateListener
	 * 
	 * The UpdateListener must implement the void refresh() method
	 */
	//public
	addUpdateListener : function(updateListener)
	{
		if(this._indexOfUpdateListener(updateListener) == -1)
		{
			this._updateListeners.push(updateListener);
		}
	},
	
	/**
	 * Get the index of the updateListener passed in
	 * 
	 * @param updateListener - the updateListener to find the index of
	 */
	//private
	_indexOfUpdateListener : function(updateListener)
	{
    	for(var index = 0; index < this._updateListeners.length; index++)
    	{
    		if(updateListener == this._updateListeners[index])
    		{
    			return index;
    		}
    	}
    	return -1;
	},
	
	/**
	 * Remove an update listener
	 */
	//public
	removeUpdateListener : function(updateListener)
	{
		var indexOf = this._indexOfUpdateListener(updateListener); 
		
		if(indexOf >= 0)
		{
			this._updateListeners.splice(indexOf, 1);
		}
	},
	
	/**
	 * Notify all the listeners that the ride data has been changed. 
	 */
	//private
	_notifyListeners : function()
	{
		for(var index = 0; index < this._updateListeners.length; index++)
		{
			var listener = this._updateListeners[index];
			listener.refresh();
		}
	}
	
});
/**
 * @author lancewf
 */
RideAdminManager = Class.create(
{
	initialize: function(rideManager)
	{
		this._rideManager = rideManager;
		this._ajaxTransport = new AjaxTransport();
		this._updateListeners = new Array();
	},
	
	updateRide: function(ride, isClosedPermanently, popularity)
	{
		this._ajaxTransport.makeServerRequest(base_admin_url + 
			'updateRideData', 'rideData='+
	            ride.getId() + "-" + 
				popularity + "-" + isClosedPermanently, 
			function(reponse)
	    {
			if(reponse == "success")
			{	
				ride.setClosedPermanently(isClosedPermanently);
				ride.setPopularity(popularity);
				this._notifyListeners();
			}
			else
			{
				alert("Error in updating Ride: " + reponse);
			}
	    }.bind(this));
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
/**
 * Manages the itinerary rides
 * 
 * @param rideManager
 */
function ItineraryRideManager(rideManager)
{
	// ------------------------------------------------------------------
	// Private Variables
	// ------------------------------------------------------------------
	
	this._rideManager = rideManager;
    this._itineraryRides = new Array();
    this._ajaxTransport = new AjaxTransport();
    
	// ------------------------------------------------------------------
	// Public Members
	// ------------------------------------------------------------------
	
	/**
	 * get all the itinerary rides.
	 * 
	 * @return Array of ItineraryRide objects
	 */
	 //public
    this.getItineraryRides = function()
    {
        return this._itineraryRides;
    }
    
	/**
	 * This is used to inital load the itinerary rides from the loadData page
	 * 
	 * @param itineraryRide - the ItineraryRide object to add
	 */
	 //public
    this.addItineraryRideObject = function(itineraryRide)
    {
    	this._itineraryRides.push(itineraryRide);
    }

	/**
	 * Add a new itinerary ride from a ride's id.
	 * 
	 * The priority given is the highest priority of the current list
	 * 
	 * @param ride - the name of the ride to be in the newly added itinerary
	 */
	 //public
    this.addNewItineraryRideFromRideId = function(rideId)
    {
        var ride = this._rideManager.getRideFromId(rideId);
		
		this.addNewItineraryRideFromRideObject(ride);
    }
	
	/**
	 * Add a new itinerary ride from the name of the ride
	 * 
	 * The priority given is the highest priority of the current list
	 * 
	 * @param ride - the name of the ride to be in the newly added itinerary
	 */
	 //public
    this.addNewItineraryRideFromName = function(rideName)
    {
        var ride = this._rideManager.getRideFromName(rideName);
		
		this.addNewItineraryRideFromRideObject(ride);
    }
	
	/**
	 * Add a new ride from the Ride object.
	 * 
	 * The priority given is the highest priority of the current list
	 * 
	 * @param ride - the Ride object to be in the newly added itinerary
	 */
	 //public
	this.addNewItineraryRideFromRideObject = function(ride)
	{
        if(ride != null && !this.containsRide(ride))
        {
            var newItineraryRide = this.createItineraryRideFromRideObject(ride, 
            	this._itineraryRides.length + 1);
            
            this._itineraryRides.push(newItineraryRide);
            
            this._updateServer();
        }
	}
	
	/**
	 * Create a new ItineraryRide object from the rideid and priority
	 * 
	 * @param rideId - the id of the ride that is added to the new itinerary ride.
	 * @param priority - the priority of the new itinerary ride
	 */
	 //public
	this.createItineraryRideFromRideId = function(rideId, priority)
	{
		var ride = this._rideManager.getRideFromId(rideId);
				
		return this.createItineraryRideFromRideObject(ride, priority);
	}
	
	/**
	 * Create a new ItineraryRide object from the Ride object and priority
	 * 
	 * @param ride - the Ride object that is added to the new itinerary ride.
	 * @param priority - the priority of the new itinerary ride
	 */
	 //public
	this.createItineraryRideFromRideObject = function(ride, priority)
	{
		var newItineraryRide = new ItineraryRide(ride, priority);
		
		return newItineraryRide;
	}

	/**
	 * this method checks if a ride is in the itinerary colleciton
	 * @param ride - a ride object 
	 */
	 //public
    this.containsRide = function(ride)
    {
        if(this.getItineraryRideFromRideObject(ride) == null)
		{
			return false;
		}
		else
		{
			return true;
		}
    }
	
	/**
	 * Get the itinerary ride from it's assocatied Ride object
	 * 
	 * @param ride - the Ride Object to find the assocaited itinerary ride from
	 */
	 //public
	this.getItineraryRideFromRideObject = function(ride)
	{
        var foundItineraryRide = null;

		for(var index = 0; index < this._itineraryRides.length; index++)
        {
        	var itineraryRide = this._itineraryRides[index];
        	
            if(itineraryRide.getRideId() == ride.getId())
            {
                foundItineraryRide = itineraryRide;
            } 
        } 

        return foundItineraryRide; 
	}
	
	/**
	 * Remove an itinerary ride from the collection being managed that
	 * is assocatied to the Ride object passed in. 
	 * 
	 * @param ride - the Ride ride that is associated to the 
	 * itinerary ride to remove
	 */
	//public
	this.removeItineraryRideFromRideObject = function(ride)
	{
		var itineraryRide = this.getItineraryRideFromRideObject(ride);
		
		if(itineraryRide != null)
		{
			this.removeItineraryRideFromItineraryRideObject(itineraryRide);
		}
	}
	
	/**
	 * Remove a itinerary ride that is passed in. 
	 */
	//public
	this.removeItineraryRideFromItineraryRideObject = function(itineraryRide)
	{
		var indexOf = this._indexOfItineraryRide(itineraryRide); 
		
		if(indexOf >= 0)
		{
			this._itineraryRides.splice(indexOf, 1);
			
			this._updateServer();
		}
	}
	
	/**
	 * Add an UpdateListener
	 * 
	 * The UpdateListener must implement the void refresh() method
	 */
	//public
	this.addUpdateListener = function(listener)
	{
		this._rideManager.addUpdateListener(listener);
	}
	
	/**
	 * Remove an update listener
	 */
	//public
	this.removeUpdateListener = function(listener)
	{
		this._rideManager.removeUpdateListener(listener);
	}
	
	/**
	 * Update the itinerary local list of ItineraryRide objects
	 * 
	 * @param ridesIdToRemove - Array of ride ids 
     * @param updatedItineraryRides - an Array list of ItineraryRide objects
     * that have updated priorties that are used to update the local list 
     * of ItineraryRide objects.
	 */
	//public
    this.updateItinerary = function(ridesIdToRemove, updatedItineraryRides)
    {
        if(ridesIdToRemove.length > 0 || 
            updatedItineraryRides.length > 0)
        {   
			this._removeItineraryRides(ridesIdToRemove);
			
			this._updateItineraryRidePriorities(updatedItineraryRides);

            this._orderItineraryRides();
            
            this._updateServer();
        }  
    }
	
	// ------------------------------------------------------------------
	// Private Members
	// ------------------------------------------------------------------
	
	/**
	 * Update the server with the current client modified itinerary
	 */
	//private
    this._updateServer = function()
    {
		this._ajaxTransport.makeServerRequest(base_services_url + 
			'updateItinerary', 'itineraryRides='+
                this._getServerUpdateString(), function(reponse)
        {
 			if(reponse == "success")
			{

			}
			else
			{
				//alert("Error - ItineraryRideManager " + reponse);
			}
        });
    }

	/**
	 * Get the server update string for the itinerary from the client to send 
	 * to server. 
	 * The string format to send to the server is
	 * [ride priority]-[ride id],[ride priority]-[ride id],....
	 */
	 //private
	this._getServerUpdateString = function()
	{
		var serverUpdateString = "";
		
		for(var index = 0; index < this._itineraryRides.length; index++)
        {
			var itineraryRide = this._itineraryRides[index];
			
			serverUpdateString += itineraryRide.getPriority() + 
				'-' + itineraryRide.getRideId() + ",";
		}
		
		serverUpdateString = serverUpdateString.substring(0, 
			serverUpdateString.length - 1);
		
		return serverUpdateString;
	}
    
    /**
     * Update the priorities of the local list of ItineraryRide objects
     * with the list of ItineraryRide objects passed in.
     * 
     * @param updatedItineraryRides - an Array list of ItineraryRide objects
     * that have updated priorties that are used to update the local list 
     * of ItineraryRide objects.
     */
    //private
    this._updateItineraryRidePriorities = function(updatedItineraryRides)
    {
    	if(updatedItineraryRides.length > 0)
        {
		    for(var index = 0; index < updatedItineraryRides.length; 
	            index++)
	        { 
	            var newItineraryRide = updatedItineraryRides[index];
	            for(var itineraryRidesIndex = 0; 
	            	itineraryRidesIndex < this._itineraryRides.length; 
	            	itineraryRidesIndex++)
	            {
	            	var itineraryRide = this._itineraryRides[itineraryRidesIndex];
	            	
	                if(itineraryRide.equals(newItineraryRide))
	                {
	                   itineraryRide.setPriority(
	                        newItineraryRide.getPriority());
	                }
	            }
	        }
        }
    }
    
    /**
     * Remove Itinerary rides that match the list of ride id passed in
     * 
     * @param ridesIdToRemove - A list of ride ids that represent the rides from
     * the itinerary to be removed
     */
    //private
    this._removeItineraryRides = function(ridesIdToRemove)
    {
    	if(ridesIdToRemove.length > 0)
        {   
	        var ridesToRemove = new Array();
	
	        //remove rides that are delete
	        for(var index = 0; index < ridesIdToRemove.length; index++)
	        { 
	            var rideId = ridesIdToRemove[index];
	            var itineraryRides = this._itineraryRides;
	            for(var itineraryRidesIndex = 0; itineraryRidesIndex < this._itineraryRides.length; itineraryRidesIndex++)
	            {
	            	var itineraryRide = this._itineraryRides[itineraryRidesIndex];
	                if(itineraryRide.getRideId() == rideId)
	                {
	                    ridesToRemove.push(itineraryRide);
	                }
	            }
	        }
	
	        for(var index = 0; index < ridesToRemove.length; index++)
	        {
	            var itineraryRideToRemove = ridesToRemove[index];
	
				var indexOf = this._indexOfItineraryRide(itineraryRideToRemove); 
				
				if(indexOf >= 0)
				{
					this._itineraryRides.splice(indexOf, 1);
				}
	        }
        } 
    }
    
    /**
     * Get the index of the itinerary ride passed in
     */
    //private
    this._indexOfItineraryRide = function(itineraryRide)
    {
    	for(var index = 0; index < this._itineraryRides.length; index++)
    	{
    		if(itineraryRide.equals(this._itineraryRides[index]))
    		{
    			return index;
    		}
    	}
    	return -1;
    }

	/**
	 * Order the itinerary rides base off thier priorities
	 * 
	 * NOTE: Not sure this works on a Moblie IE browser
	 */
    //private
    this._orderItineraryRides = function()
    {
        this._itineraryRides.sort(function(ride1, ride2)
        {
            return ride1.getPriority() - ride2.getPriority();
        });
    } 
}

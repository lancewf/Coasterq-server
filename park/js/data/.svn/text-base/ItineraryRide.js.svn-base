/**
 * ItineraryRide is an object that holds information about one ride in the itinerary. 
 * The object holds the Ride object and the priority assigned to it. 
 */
function ItineraryRide(ride, priority)
{
    // -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
	 
	this._ride = ride;
	this._priority = priority;
	
    // -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
    /**
     * Get the name of the ride
     */
    this.getName = function()
    {
        return this._ride.getName();
    }

	/**
	 * Set the priority
	 */
	this.setPriority = function(priority)
	{
		this._priority = priority;
	}

	/**
	 * Get the priority
	 */
	this.getPriority = function()
	{
		return this._priority;
	}
	
	/**
	 * Get the assocatied ride
	 */
	this.getRide = function()
	{
		return this._ride;
	}

	/**
	 * Get the assocatied ride id
	 */
	this.getRideId = function()
	{
		return this._ride.getId();
	}

	// When the object is translated to a string
	// this method is called. 
	this.toString = function()
	{
		return this._ride.getName() + " " + this._priority;
	}

	/**
	 * Does the passed in ItineraryRide object equal this ItineraryRide object
	 */
    this.equals = function(itineraryRide)
    {
        return this.getRideId() == itineraryRide.getRideId();
    }
}


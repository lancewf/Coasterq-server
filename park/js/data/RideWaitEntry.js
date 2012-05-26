/**
 * 
 */
function RideWaitEntry(ride, waitTimeMin, timeHour, timeMin, 
			dayOfMonth, month, year)
{
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
    
	this._ride = ride;
	this._waitTimeMin = waitTimeMin;
	this._timeHour = timeHour;
	this._timeMin = timeMin;
	this._dayOfMonth = dayOfMonth;
	this._month = month;
	this._year = year;
	
	// -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
	
	this.getRide = function()
	{
		return this._ride;
	}
	
	this.getWaitTimeMin = function()
	{
		return this._waitTimeMin;
	}
	
	this.getTimeHour = function()
	{
		return this._timeHour;
	}
	
	this.getTimeMin = function()
	{
		return this._timeMin
	}
	
	this.getDayOfMonth = function()
	{
		return this._dayOfMonth;
	}
	
	this.getMonth = function()
	{
		return this._month;
	}

	this.getYear = function()
	{
		return this._year;
	}
	
	this.equals = function(rideWaitEntry)
    {
        return this.getRide().equals(rideWaitEntry.getRide()) && 
        this.getWaitTimeMin() == rideWaitEntry.getWaitTimeMin() && 
        this.getTimeHour() == rideWaitEntry.getTimeHour() && 
        this.getTimeMin() == rideWaitEntry.getTimeMin() && 
        this.getDayOfMonth() == rideWaitEntry.getDayOfMonth();
    }
	
}
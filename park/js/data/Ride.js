function Ride(name, id, landName, heightRequirement, 
	hasFastPass, currentTime, averageTime, nextDateTime, nextTime)
{
    this._name = name;
	this._id = id;
	this._landName = landName;
	this._heightRequirement = heightRequirement;
	this._hasFastPass = hasFastPass;
	this._currentTime = currentTime;
	this._averageTime = averageTime;
	this._nextDateTime = nextDateTime;
	this._nextTime = nextTime;
	
	this.getLocation = function()
	{
		return this._landName;
	}
	
	this.getHeightRequirement = function()
	{
		return this._heightRequirement;
	}
	
	this.getHasFastPass = function()
	{
		return this._hasFastPass;
	}
	
	this.getId = function()
	{
		return this._id;
	}
	
	this.getName = function()
	{
		return this._name;
	}
	
	this.getCurrentTime = function()
	{
		return this._currentTime;
	}

	this.setCurrentTime = function(currentTime)
	{
		this._currentTime = currentTime;
	}
	
	this.isRideOpen = function()
	{
		if(this._currentTime != -1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	this.getAverageTime = function()
	{
		return this._averageTime;
	}

	this.setAverageTime = function(averageTime)
	{
		this._averageTime = averageTime;
	}
	
	this.getNextShortestDateTime = function()
	{
		return this._nextDateTime;
	}
	
	this.setNextShortestDateTime = function(nextDateTime)
	{
		this._nextDateTime = nextDateTime;
	}
	
	this.getNextShortestTime = function()
	{
		return this._nextTime;
	}
	
	this.setNextShortestTime = function(nextTime)
	{
		this._nextTime = nextTime;
	}
	
	this.getPopularity = function()
	{
		return this._popularity;
	}
	
	this.setPopularity = function(popularity)
	{
		this._popularity = popularity;
	}
	
	this.getClosedPermanently = function()
	{
		return this._closedPermanently;
	}
	
	this.setClosedPermanently = function(closedPermanently)
	{
		this._closedPermanently = closedPermanently;
	}
	
	this.toString = function()
	{
		return this._name;
	}
	
	this.equals = function(ride)
    {
        return this.getId() == ride.getId();
    }
	
}
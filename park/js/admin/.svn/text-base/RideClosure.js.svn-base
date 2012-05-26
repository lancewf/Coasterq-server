/**
 * @author lancewf
 */
function RideClosure(id, startDate, endDate, ride)
{
	this._id = id;
	this._startDate = startDate;
	this._endDate = endDate;
	this._ride = ride;
	
	this.isWithinRange = function(date)
	{
		if(date >= this._startDate && date <= this._endDate)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	this.clone = function()
	{
		var clonedRideClosure = 
			new RideClosure(this._id, this._startDate, 
			this._endDate, this._ride);
			
		return clonedRideClosure;
	}
	
	this.getRide = function()
	{
		return this._ride;
	}
	
	this.getStartDate = function()
	{
		return this._startDate;
	}
	
	this.getEndDate = function()
	{
		return this._endDate;
	}
	
	this.setStartDate = function(startDate)
	{
		this._startDate = startDate;
	}
	
	this.setEndDate = function(endDate)
	{
		this._endDate = endDate;
	}
	
	this.getId = function()
	{
		return this._id;
	}
	
	this.setId = function(id)
	{
		this._id = id;
	}
}
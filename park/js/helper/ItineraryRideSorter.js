function ItineraryRideSorter()
{
	// -------------------------------------------------------------------------
	// Public Static Variables
	// -------------------------------------------------------------------------
	
	this.NAME_TYPE = "Name";
	this.LOCATION_TYPE = "Location";
	this.CURRENT_WAIT_TYPE = "CurrentWait";
	this.PRIORITY_TYPE = "Priority";
	this.DESCENDING_ORDER = "descending order";
	this.ASCENDING_ORDER = "ascending";

	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------

	this._type = "Priority";
	this._order = "ascending";

	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	this.setSortType = function(type)
	{
		if(this._type == type)
		{
			this._setOppositeOrder();	
		}
		else
		{
			this._type = type;
			this._order = this.ASCENDING_ORDER;
		}	
	}
	
	this.getSortType = function()
	{
		return this._type;
	}

	this.sortRides = function(itineraryRides)
	{
		var newRideList = this._copyArray(itineraryRides);

		if(this._type == this.NAME_TYPE)
		{
			newRideList.sort(function(ride1, ride2)
			{
				return ride1.getName().localeCompare(ride2.getName());
			});


		}
		else if(this._type == this.LOCATION_TYPE)
		{

			newRideList.sort(function(ride1, ride2)
			{
				return ride1.getRide().getLocation().localeCompare(
					ride2.getRide().getLocation());
			});
		}
		else if(this._type == this.CURRENT_WAIT_TYPE)
		{

			newRideList.sort(function(ride1, ride2)
			{
				return  ride1.getRide().getCurrentTime() - 
					ride2.getRide().getCurrentTime();
			});
		}
		else if(this._type == this.PRIORITY_TYPE)
		{
			newRideList.sort(function(ride1, ride2)
			{
				return ride1.getPriority() - ride2.getPriority();
			});

		}

		if(this._order == this.DESCENDING_ORDER)
		{
			newRideList.reverse();
		}

		return newRideList;
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	this._setOppositeOrder = function()
	{
		if(this._order == this.DESCENDING_ORDER)
		{
			this._order = this.ASCENDING_ORDER;
		}
		else
		{
			this._order = this.DESCENDING_ORDER;
		}
	}

	this._copyArray = function(list)
	{
		var newList = new Array();

		for(var index = 0; index < list.length; index++)
		{
			newList.push(list[index]);
		}

		return newList;
	}
}
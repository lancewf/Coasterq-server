function RideSorter()
{
	// -------------------------------------------------------------------------
	// Public Static Variables
	// -------------------------------------------------------------------------
	
	this.NAME_TYPE = "Name";
	this.LOCATION_TYPE = "Location";
	this.CURRENT_WAIT_TYPE = "CurrentWait";
	this.DESCENDING_ORDER = "descending order";
	this.ASCENDING_ORDER = "ascending";

	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------

	this._type = "Name";
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

	this.sortRides = function(rides)
	{
		var newRideList = this._copyArray(rides);

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
				return ride1.getLocation().localeCompare(ride2.getLocation());
			});
		}
		else if(this._type == this.CURRENT_WAIT_TYPE)
		{

			newRideList.sort(function(ride1, ride2)
			{
				return  ride1.getCurrentTime() - ride2.getCurrentTime();
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


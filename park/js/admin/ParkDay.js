/**
 * @author lancewf
 */
ParkDay = Class.create(
{
	initialize: function()
	{
		
	},
	
	getCrowdLevel: function()
	{
		return this._crowdLevel;
	},
	
	setCrowdLevel: function(crowdLevel)
	{
		this._crowdLevel = crowdLevel;
	},
	
	isClosed: function()
	{
		return this._isClosed;
	},
	
	setIsClosed: function(isClosed)
	{
		this._isClosed = isClosed;
	},
	
	setIsDirty: function(isDirty)
	{
		this._isDirty = isDirty;
	},
	
	isDirty: function()
	{
		return this._isDirty;
	},
	
	isSameDate: function(day, month, year)
	{
		if(day == this._day && month == this._month && year == this._year)
		{
			return true;
		}
		else
		{
			return false;
		}
	},
	
	setDate: function(day, month, year)
	{
		this._day = day;
		this._month = month;
		this._year = year;
	},
	
	getDay: function()
	{
		return this._day;
	},
	
	getMonth: function()
	{
		return this._month;
	},
	
	getYear: function()
	{
		return this._year;
	},
	
	setOpenTime: function(hour, min)
	{
		this._openHour = hour;
		this._openMin = min;
	},
	
	getOpenHour: function()
	{
		return this._openHour;
	},
	
	getOpenMin: function()
	{
		return this._openMin;
	},
	
	getOpenTimeHTML: function()
	{
		return this.getTimeHTML(this._openHour, this._openMin);
	},
	
	getTimeHTML: function(hour, min)
	{
		var hour12 = hour;
		var amPm = "am";
		if(hour == 0)
		{
			hour12 = 12;
			amPm = "am";
		}
		else if(hour > 12)
		{
			hour12 = hour - 12;
		}
		
		if(hour >= 12)
		{
			amPm = "pm";
		}

		var mins = min;
		
		if(mins < 10)
		{
			mins = "0" + mins; 
		}
		return hour12 + ":" + mins + " " + amPm;
	},
	
	setCloseTime: function(hour, min)
	{
		this._closeHour = hour;
		this._closeMin = min;
	},
	
	getCloseHour: function()
	{
		return this._closeHour;
	},
	
	getCloseMin: function()
	{
		return this._closeMin;
	},
	
	getCloseTimeHTML: function()
	{
		return this.getTimeHTML(this._closeHour, this._closeMin);
	},
	
	cloneFrom: function(parkDayToCloneFrom)
	{
		this._openHour = parkDayToCloneFrom.getOpenHour();
		this._openMin = parkDayToCloneFrom.getOpenMin();
		this._closeHour = parkDayToCloneFrom.getCloseHour();
		this._closeMin = parkDayToCloneFrom.getCloseMin();
		this._isClosed = parkDayToCloneFrom.isClosed();
		this._day = parkDayToCloneFrom.getDay();
		this._month = parkDayToCloneFrom.getMonth();
		this._year = parkDayToCloneFrom.getYear();
		this._crowdLevel = parkDayToCloneFrom.getCrowdLevel();
	}
});
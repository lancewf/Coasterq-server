/**
 * @author lancewf
 */
function ParkClock(min, hour, dayOfMonth, month, year)
{
	// ------------------------------------------------------------------
	// Public static Variables
	// ------------------------------------------------------------------
	
	this.STATUS_FAILURE = "failure";
	this.STATUS_SUCCESS = "success";
	
	// 1000 milliseconds in a second
	// -------------------------------------------------------------------------
	// Instance Varablies
	// -------------------------------------------------------------------------
	this._REFRESH_RATE = 240000; // 4 minutes
	this._UPDATE_RATE = 300000; // 5 minutes
	this._date = new Date ( year, month - 1 , dayOfMonth, hour, min, 0 );
	this._status = this.STATUS_SUCCESS;
	this._ajaxTransport = new AjaxTransport();
	this._parkOpenRange = new Array();
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	this.addParkOpenRange = function(openHour, 
		openMin, closeHour, closeMin, day, month, year)
	{
		var parkOpenRange = new ParkOpenRange(openHour, 
			openMin, closeHour, closeMin, day, month, year);
			
		this._parkOpenRange.push(parkOpenRange);
	}
	
	/**
	 * is the park open
	 * 
	 * @return 
	 */
	this.isOpen = function()
	{
		for(var index = 0; index < this._parkOpenRange.length; index++)
		{
			if(this._parkOpenRange[index].isWithinRange(this.get24Hour(), 
					this.getMinutes(), this.getDayOfMonth(), this.getMonth(), 
					this.getYear()))
			{
				return true;
			}
		}
		
		return false;
	}
	
	this.get12Hour = function()
	{
		var hour = this.get24Hour();
		if(hour == 0)
		{
			hour = 12;
		}
		else if(hour > 12)
		{
			hour -= 12;
		}
		return hour;
	}
	
	this.get24Hour = function()
	{
		return this._date.getHours();
	}
	
	this.getMinutes = function()
	{
		return this._date.getMinutes();
	}
	
	this.getDayOfMonth = function()
	{
		return this._date.getDate();
	}
	
	this.getYear = function()
	{
		return this._date.getFullYear();
	}
	
	this.getMonth = function()
	{
		return this._date.getMonth()+1;
	}
	
	this.getDateObject = function()
	{
		return this._date;
	}
	
	this.isPm = function()
	{
		if(this.get24Hour() > 11)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
	
	/**
	 * Update the client rides in this manager.
	 * 
	 * Request the server for the ride information.
	 */
	//private
	this._updateClientClock = function()
	{
		var parkClock = this;
		this._ajaxTransport.makeServerRequest(base_services_url + 
			'getClockUpdate', "", function(response)
        {
        	if(response)
        	{
				parkClock._status = parkClock._STATUS_SUCCESS;
	            parkClock._parseClockUpdateResponse(response);
        	}
        	else
        	{
        		parkClock._status = parkClock._STATUS_FAILURE;
        	}
           	parkClock._startServerUpdateTimer();
        }); 
	}
	
	/**
	 * Parses the clock data from the server. 
	 * 
	 * Update clock on the client:
	 * [0] minutes
	 * [1] hours
	 * [2] The day of the month
	 * [3] the month 1 - 12
	 * [4] the year example 2009 
	 * seperated by '-'
	 */
	//private
	this._parseClockUpdateResponse = function(response)
	{
        var clockData = response.split("-");

        var min = clockData[0];
        var hour = clockData[1];
        var dayOfMonth = clockData[2];
        var month = clockData[3];
        var year = clockData[4];
		
		this._date = new Date ( year, month - 1 , dayOfMonth, hour, min, 0 );
	}
	
	this._updateClock = function()
	{
		this._date.setMilliseconds(this._REFRESH_RATE + 
			this._date.getMilliseconds());
	}
	
	/**
	 * Start the timer to update the rides
	 */
	//private
	this._startServerUpdateTimer = function()
	{
		var parkClock = this;
		this.timer = setTimeout(
    		function() 
    		{ 
    			parkClock._updateClientClock(); 
    		}, 
    		this._UPDATE_RATE);
	}
	
	/**
	 * Start the timer to update the clock
	 */
	//private
	this._startTimer = function()
	{
		var parkClock = this;
		this.timer = setTimeout(
    		function() 
    		{ 
    			parkClock._updateClock(); 
    		}, 
    		this._REFRESH_RATE);
	}
	
	// ------------------------------------------------------------------
	// Contructor
	// ------------------------------------------------------------------
	
	this._startTimer();
	this._updateClientClock();
}

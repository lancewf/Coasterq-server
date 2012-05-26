/**
 * This page creates a panel to allow the users to enter times for a ride. 
 * 
 * This page is only used for browsers with a limited functionaity. 
 * Mobile Internet Explorer
 * 
 * Implements Page
 * 
 * void exit();
 * void showPage(div, arguments)
 * String getName();
 * void setPageHolder(pageHolder);
 */
 
 //Page Name
EnterTimeViewName = "Mobile Enter Time View";

/**
 * This class displays a way to enter a ride time.
 */
function EnterTimeView(rideManager, rideWaitEntryManager, htmlRideDisplayer, 
	parkClock)
 // implements Page
{
	// -------------------------------------------------------------------------
	// Instance Varablies
	// -------------------------------------------------------------------------
	
	// The external method called 
	this._ENTER_TIME_BUTTON_TAGE = "enterTimeSubmit";
	this._RIDE_ID_TAGE = "rideId";
	
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	this._rideManager = rideManager;
	this._htmlRideDisplayer = htmlRideDisplayer;
	this._rideWaitEntryManager = rideWaitEntryManager;
	this._rideWaitSubmitedPageView = new RideWaitSubmitedPageView(htmlRideDisplayer);
	this._selectedRideId = -1;
	this._parkClock = parkClock;
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------
	
	/**
	 * Get the distict page name. 
	 */
	 //public
	this.getName = function()
	{
		return EnterTimeViewName;
	}
	
	/**
	 * Called when the page exits 
	 */
	 //public
	this.exit = function()
	{
		
	}
	
	this.setSelectedRide = function(rideId)
	{
		this._selectedRideId = rideId;
	}
	
	/**
	 * Show this page
	 */
	 //public
	this.showPage = function(replaceDiv)
	{
		this.replaceDiv = replaceDiv;

        var html = this.getHTML();
   
        document.getElementById(this.replaceDiv).innerHTML = html;
        
        this.afterDisplayed();
	}
	
	/**
	 * Set the page holder that this page is contained in
	 */
	 //public
    this.setPageHolder = function(pageHolder)
    {
        this.pageHolder = pageHolder;
    }
    
    /**
	 * Get the html used to display this page
	 */
	 //public
	this.getHTML = function()
	{
		var html = "";
		
		if(this._parkClock.isOpen())
		{
	        html +=
				'<br>' +
	            '<div align="center"><img src="'+ base_url + 'img/enter_time_for.png" alt="Enter Time For:"></div>'+
				'<hr />' +
				'<table cellspacing="5" border="0" align="center">' +
					'<tr>' +
							'<TH>' +
								this._getRidesComboBox() + 
							'</TH>' +
					'</tr>' + 
					'<tr>' +
						'<td>' +
							'<table cellspacing="5" border="0" align="center">' +
								'<tr>' + 
									'<td align="center">' +
										this._htmlRideDisplayer.getTodayDateHTML() +
									'</td>' +
								'</tr>' + 
								'<tr>' +
									'<td align="center">Time of Day</td>' +
								'</tr>' +
								'<tr>' +
									'<td align="center">' +
						 				this._getHourCombobox() + 
						 				" : " + 
						 				this._getMinCombobox() + 
						 				this._getAmPmCombobox() +
					 				'</td>' +
							    '</tr>' +
								'<tr>' +
									'<td align="center">Wait Time</td>' +
								'</tr>' +
								'<tr>' +
									'<td align="center">' +
										this._getTimeAmountComboBox() +
									'</td>' +
								'</tr>' +
								'<tr>' +
									'<td align="center"><br>' +
										this._getButtons() +
									'</td>' +
								'</tr>' +
							'</table>' +
						'</td>' +
					'</tr>' +
				'</table>' +
				'<hr />';
		}
		else
		{
			html +=
				'<br>' +
	            '<div align="center"><img src="'+ base_url + 'img/enter_time_for.png" alt="Enter Time For:"></div>'+
				'<hr />' +
				"<center>Sorry, the park is currently closed.</center>" +
				'<hr />';
		}
				
		return html;
	}
	
	//public
    this.afterDisplayed = function()
	{

	}
    
    // -------------------------------------------------------------------------
	// Object Members
	// -------------------------------------------------------------------------
	
	//public
	this.toString = function()
	{
		return this.getName();
	}
	
	// -------------------------------------------------------------------------
	// Private Memebers
	// -------------------------------------------------------------------------
	
	//private
	this._getSelectedRide = function()
	{
		var rideId = document.getElementById(this._RIDE_ID_TAGE).value;
		var ride = this._rideManager.getRideFromId(rideId);
		
		return ride;
	}

	 //private	
	this._enterTimeToServer = function()
	{
		var month = this._parkClock.getMonth() ;
		var dayOfMonth = this._parkClock.getDayOfMonth() ;
		var year = this._parkClock.getYear();
		
		var waitHour =  document.getElementById('hour').value;
		var waitMin = document.getElementById('min').value;
		waitMin = (+waitMin) + waitHour * 60;
		
		var timeHour = document.getElementById('time_hour').value;
		var timeMin = document.getElementById('time_min').value;
		var amPm = document.getElementById('am_pm').value;
		
		var rideId = document.getElementById('rideId').value;
		var ride = this._getSelectedRide();
		
		timeHour = parseInt(timeHour);
		
		// convert to 24 hour clock. 
		if(amPm == "pm")
		{
			if(timeHour != 12)
			{
				timeHour = parseInt(timeHour) + 12;
			}
		}
		else
		{
			if(timeHour == 12)
			{
				timeHour = 0;
			}
		}
		
		var rideWaitEntry = new RideWaitEntry(ride, waitMin, timeHour, 
				timeMin, dayOfMonth, month, year);
		
		this._rideWaitEntryManager.addRideWaitEntry(rideWaitEntry);
	}

	// Enter time button is clicked
	// submit the time for the ride to the server.
	//private
    this._enterTimeButtonClicked = function()
    {	
		this._enterTimeToServer();
		this._submitPage();
    }

	this._submitPage = function()
	{
		var ride = this._getSelectedRide();
		
		this._rideWaitSubmitedPageView.setRide(ride);
		
		this._rideWaitSubmitedPageView.showPage(this.replaceDiv);
	}
	
	//private
	this._getButtons = function()
	{
		var html = 
		    '<a href="'+base_url+
	        	'" onClick="' + this._ENTER_TIME_BUTTON_TAGE + '();' + 
				' return false" >' +
		    	'<img src="'+ base_url + 'img/submit.png" alt="Submit">' +
		    '</a>';
			
		return html;
	}
	
    //private
	this._getRidesComboBox = function()
	{
		//55
		var rides = this._rideManager.getRides();
		var output ='<select id="' + this._RIDE_ID_TAGE + '" name="combobox">';
		
		for(var index = 0; index < rides.length; index++)
		{
			if(rides[index].isRideOpen())
			{
				if(this._selectedRideId == rides[index].getId())
				{
					output += '<option value="' + rides[index].getId() + 
						'" selected >' + 
						this._htmlRideDisplayer.getShortenedRideName(rides[index]) 
						+ '</option>';
				}
				else
				{
					output += '<option value="' + rides[index].getId() + 
						'">' + this._htmlRideDisplayer.getShortenedRideName(rides[index])  
						+ '</option>';	
				}
			}
		}
		
		output += '</select>';
		
		//reset the seleted ride id to not be used again. 
		this._selectedRideId = -1;
		
		return output;
	}

	//private
	this._getTimeAmountComboBox = function()
	{
		var output =
			'<select id="hour" name="combobox">' +
				'<option value="0" selected >0</option>' +
				'<option value="1">1</option>' +
				'<option value="2">2</option>' +
				'<option value="3">3</option>' +
				'<option value="4">4</option>' +
			'</select> ' +
				'hour' +
			'<select id="min" name="combobox">' +
      			'<option value="0">00</option>' +
      			'<option value="5">05</option>' +
      			'<option value="10">10</option>' +
      			'<option value="15" selected>15</option>' +
      			'<option value="20">20</option>' +
      			'<option value="25">25</option>' +
      			'<option value="30">30</option>' +
      			'<option value="35">35</option>' +
      			'<option value="40">40</option>' +
      			'<option value="45">45</option>' +
      			'<option value="50">50</option>' +
      			'<option value="55">55</option>' +
			'</select> min ';
					
		return output;
	}
	
    //private
	this._getHourCombobox = function()
	{	
		var hour = this._parkClock.get12Hour();
		
		var output = '<select id="time_hour" name="combobox">';
		
		output += 
           	'<option value="' + hour + 
           	'" selected >' + hour + '</option>';
		
		var adjustedHour = hour;
		for(var index = 1; index <= 2; index++)
		{
			adjustedHour--;
			
			if(adjustedHour <= 0)
			{
				adjustedHour = 12;
			}
			output += 
               	'<option value="' + 
               	adjustedHour + '" >' + adjustedHour + '</option>';
		}
		output += '</select>';
		
		return output;
	}
	
	//private
	this._getMinCombobox = function()
	{
		var min = this._parkClock.getMinutes();
		
		var output = '<select id="time_min" name="combobox">';
		
		for(var index = 0; index <= 55 ; index+=5)
		{
			if(min >= index && min <= index + 5)
			{
				output += '<option value="' + index + 
					'" selected >' + this._formatMinutes(index) + '</option>';
			}
			else
			{
				output += '<option value="' + index + 
					'" >' + this._formatMinutes(index) + '</option>';
			}
		}
		output += '</select>';
		
		return output;
	}
	
	//private
	this._formatMinutes = function(min)
	{
		if(min < 10)
		{
			return "0" + min;
		}
		else
		{
			return min;
		}
	}

    //private
	this._getAmPmCombobox = function()
	{
		var output = '<select id="am_pm" name="combobox">';
		
		if(this._parkClock.isPm())
		{
			output += '<option value="am">AM</option>' + 
				'<option value="pm" selected >PM</option>';
		}
		else
		{
			output += '<option value="am" selected>AM</option>' + 
				'<option value="pm">PM</option>';
		}
		
		output += '</select>';
		
		return output;
	}
}

//public static void
function enterTimeSubmit()
{
	var enterTimeViewName = pageHolder.getPage(EnterTimeViewName);
	
	enterTimeViewName._enterTimeButtonClicked();
}
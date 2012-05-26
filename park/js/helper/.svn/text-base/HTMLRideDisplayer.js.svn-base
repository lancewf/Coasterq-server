/**
 * This class helps in displaying text and dates. 
 */
function HTMLRideDisplayer(hideFastpass, parkClock)
{
	// -------------------------------------------------------------------------
	// Static Variables
	// -------------------------------------------------------------------------
	
	this._monthCollection = ["January", "February", "March", "April", "May",
    	"June", "July", "August", "September", "October", "November", "December"];
	
	this._parkClock = parkClock;
	this._hideFastpass = hideFastpass;
	
	// -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
	this.getLegendHTML = function()
	{
		var html = "<font color='#47C3A6'> * </font> <br />";
		
		if(hideFastpass)
		{
        	html += 
        	'<img src="'+ base_url + 'img/height.png">  Height Requirement <br \>' +
			"<img src='"+ base_url + "img/clock.gif'>  Enter Wait Time";
		}
		else
		{
        	html += '<img src="'+ base_url + 'img/fastpass.png">  Fastpass Available<br \>' +
        	'<img src="'+ base_url + 'img/height.png">  Height Requirement <br \>' +
			"<img src='"+ base_url + "img/clock.gif'>  Enter Wait Time";
		}
        
    	return html;
	}
	
	this.getShortenedRideName = function(ride)
	{
		var rideName = ride.getName();
		if(rideName.length > 45)
		{
			return rideName.substring(0, 45)  + " ...";
		}
		else
		{
			return rideName;
		}
	}
	
	this.getAverageWaitTimeHTML = function(ride)
	{
		var roundedTime = this._roundToTheNearest5(ride.getAverageTime());
		return this.getMinutesHTML(roundedTime);
	}
	
	this.getNextShortestWaitTimeHTML = function(ride)
	{
		var roundedTime = this._roundToTheNearest5(ride.getNextShortestTime());
		return this.getMinutesHTML(roundedTime)
	}
	
	this.getNextShortestTimeOfDayHTML = function(ride)
	{
		return this.getTimeHTML(ride.getNextShortestDateTime());		
	}
	
	this.getCurrentWaitTimeHTML = function(ride)
	{
		if(ride.getCurrentTime() == -1 || !parkClock.isOpen())
    	{
    		return "Closed";
    	}
    	else
    	{
			var roundedTime = this._roundToTheNearest5(ride.getCurrentTime());
			return this.getMinutesHTML(roundedTime);
		}
	}
	
	this.getMinutesHTML = function(totalMins)
    {
    	var hours = totalMins/60;
    	var mins = parseInt(totalMins % 60);
    	hours = parseInt(hours);
    	var html = "";
    	
    	if(hours > 0)
    	{
    		html += hours + " hr ";
    	} 
    	
    	html += mins + " min";
    	 
    	return html;
    }
	
	this.getRideNameHTML = function(ride)
    {
    	var html = ride.getName() + "&nbsp;" +
			"<A  HREF='" + base_url + 
			"' onClick='enterRideTimeViewWithSelectedRide(" +
			ride.getId() + ");" +
            " return false' ><img src='"+ base_url + "img/clock.gif'></A>" ;
			
    	return html;
	}
	
	this.getRideIconsHTML = function(ride)
    {
    	var html = "" ;
    	
    	if(ride.getHasFastPass() && ride.getHeightRequirement() > 0)
    	{
    		html += '<img src="'+ base_url + 'img/fastpass.png"><br>';
    		html += '<img src="'+ base_url + 'img/height.png">';
    	}
    	else if(ride.getHeightRequirement() > 0)
    	{
    		html = '<img src="'+ base_url + 'img/height.png">';
    	}
		else if(ride.getHasFastPass())
		{
			html = '<img src="'+ base_url + 'img/fastpass.png">';
		}
    	
    	return html;
	}
	
	this.getTimeHTML = function(dateTime)
    {
    	if(dateTime.getHours() == 23 && dateTime.getMinutes() == 59)
    	{
    		return "Now";
    	}
    	else
    	{
    		var hour12 = dateTime.getHours();
    		if(dateTime.getHours() == 0)
    		{
    			hour12 = 12;
    		}
    		else if(dateTime.getHours() > 12)
    		{
    			hour12 = dateTime.getHours() - 12;
    		}
    		var amPm = (dateTime.getHours() >= 12) ? "pm" : "am" ;
    		var mins = dateTime.getMinutes();
    		
    		if(mins.length = 1)
    		{
    			mins = "0" + mins; 
    		}
    		return hour12 + ":" + mins + " " + amPm;
    	}
	}
	
	this.getTodayDateHTML = function()
	{
		var now = this._parkClock.getDateObject();	
		
		return this.getDateHTML(now.getDate(), now.getMonth() + 1, now.getFullYear());
	}
	
	this.getDateHTML = function(day, month, year)
	{	
		var output = this._monthCollection[month - 1] + " " + 
			day + ", " + year;
		
		return output;
	}
	
	// -------------------------------------------------------------------------
    // Private Members
    // -------------------------------------------------------------------------
  
	/**
	 * Round the value to the nearest 5
	 * 
	 * @param {Object} value
	 */
	this._roundToTheNearest5 = function(value)
	{
		return Math.round((value/5))*5
	}
}

function enterRideTimeViewWithSelectedRide(rideId)
{
	var enterTimeView = pageHolder.getPage(EnterTimeViewName);
	
	enterTimeView.setSelectedRide(rideId);
	
    pageHolder.showPage(EnterTimeViewName);

    var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(EnterTimeViewName);

    return false;
}
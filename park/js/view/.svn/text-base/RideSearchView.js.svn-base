/**
 * Class instance tag
 * 
 * This is the static name of an instance of this class. 
 */
RideSearchViewName = "Ride Search View";


/**
 * This class displays a view to all the user to preform an advanced ride search
 */
function RideSearchView(rideManager, rideDisplayView, hideFastpass)
{
	// -------------------------------------------------------------------------
	// Private Static Variables
	// -------------------------------------------------------------------------
	
	this._SEARCH_BUTTON_TAGE = "advanceSearchButton";
	this._SEARCH_FOUND_ITEMS_DIV_TAG = "search-found-items";
	this._RIDE_LOCATION_FIELD_TAG = "ride-location-field";
	this._FASTPASS_FIELD_TAG = "fastpass-field";
	this._HEIGHT_REQUIREMNT_FIELD_TAG = "height-requirement-field";
	this._MAX_WAIT_TIME_FIELD_TAG = "max-wait-time-field";
	
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
	
	this._rideSearchManager = new RideSearchManager(rideManager);
    this._rideManager = rideManager;
	this._rideDisplayView = rideDisplayView;
	this._hideFastpass = hideFastpass;
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------

	/**
	 * Show this page
	 */
	 //public
	this.showPage = function(replaceDiv)
	{
		this.replaceDiv = replaceDiv;

        var html = this.getHTML();
        
        html += '<div id="rideDisplayView" >';
        html += this._rideDisplayView.getHTML();
        this._rideDisplayView.setReplaceDiv('rideDisplayView');
        html += '</div>';
   
        document.getElementById(this.replaceDiv).innerHTML = html;
        
        this.afterDisplayed();
        
        this._rideDisplayView.afterDisplayed();
	}
	
	/**
	 * Called when the page exits
	 */
    //public
	this.exit = function()
	{
		this._rideDisplayView.exit();
	}
	
    //public
	this.refresh = function()
	{
		this.showPage(this.replaceDiv);
	}
	
	/**
	 * Set the page holder that this page is contained in
	 */
    //public
    this.setPageHolder = function(pageHolder)
    {
        this.pageHolder = pageHolder;
        
        this._rideDisplayView.setPageHolder(pageHolder);
    }
    
	/**
	 * Get the distict page name. 
	 */
	//public
    this.getName = function()
    {
        return RideSearchViewName;
    }
    
    //Public
    this.getHTML = function()
    {
    	var rides = this._rideSearchManager.getRides();
		
		this._rideDisplayView.setRides(rides);
		
		var html =
			'<br>' +
			'<div align="center">' +
			'<img src="'+ base_url + 'img/ride_search.png" alt="Ride Search">' +
			'</div>' +
			'<hr />' + 
			'<table cellspacing="5" border="0" align="center">' +
				'<tr>' +
					'<td align="right">' +
		 				'Location:' + 
	 				'</td>' +
					'<td align="left">' +
		 				this._getRideLocationCombobox() + 
	 				'</td>' +
	 			'</tr>';
				
		if(!this._hideFastpass)
		{
	 		html += '<tr>' +
					'<td align="right">' +
		 				'Fastpass Available:' + 
	 				'</td>' +
					'<td align="left">' +
		 				this._getFastPassCombobox() + 
	 				'</td>' +
			    '</tr>';
		}
		else
		{
			
		}
		
	 	html +=	'<tr>' +
					'<td align="right">' +
		 				'Height Requirement:' + 
	 				'</td>' +
					'<td align="left">' +
		 				this._getHeightCombobox() + 
	 				'</td>' +
			    '</tr>' +
	 			'<tr>' +
					'<td align="right">' +
		 				'Current Wait Time:' + 
	 				'</td>' +
					'<td align="left">' +
		 				this._getRideTimeCombobox() + 
	 				'</td>' +
			    '</tr>' +
	 			'<tr>' +
	 				'<td></td>' + 
					'<td align="left">' +
			            '<a href="'+base_url+
			            	'" onClick="' + this._SEARCH_BUTTON_TAGE + '();' + 
							' return false" >' +
					    '<img src="'+ base_url + 'img/search.png" alt="Search">' +
					    '</a>' +
					'</td>' + 
				'</tr>' + 			    
			'</table>';
			
		return html;
    }
    
    //public
    this.afterDisplayed = function()
	{

	}
    
    // -------------------------------------------------------------------------
	// Object Members
	// -------------------------------------------------------------------------
	
	this.toString = function()
	{
		return this.getName();
	}
    
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------
    
    this._getRideLocationCombobox = function()
	{
		var output = '<select id="' + this._RIDE_LOCATION_FIELD_TAG + 
			'" name="combobox">';
		
		if(this._rideSearchManager.getRideLocation() == 
			this._rideSearchManager.RIDE_LOCATION_ALL)
		{
			output += '<option value="' + 
				this._rideSearchManager.RIDE_LOCATION_ALL + 
				'" selected >All</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.RIDE_LOCATION_ALL +'" >All</option>';
		}
		
		var rideLocations = this._getRideLocations();
		
		for(var index = 0; index < rideLocations.length; index++)
		{
			var rideLocation = rideLocations[index];
			if(this._rideSearchManager.getRideLocation() == rideLocation)
			{
				output += '<option value="' + 
					rideLocation +'" selected >' + rideLocation + '</option>';
			}
			else
			{
				output += '<option value="' + rideLocation + '" >' + 
					rideLocation + '</option>';
			}
		}
		
		output += '</select>';
		
		return output;
	}
	
	//private
	this._collectSearchData = function()
	{
		var fastpass = null;
		var rideLocation = document.getElementById(
			this._RIDE_LOCATION_FIELD_TAG).value;
		var heightRequirment = document.getElementById(
			this._HEIGHT_REQUIREMNT_FIELD_TAG).value;
		var maxWaitTime = document.getElementById(
			this._MAX_WAIT_TIME_FIELD_TAG).value;
				
		var fastpassElement = document.getElementById(
			this._FASTPASS_FIELD_TAG);
		
		if(fastpassElement)
		{
			fastpass = fastpassElement.value;
		}
		else
		{
			fastpass = this._rideSearchManager.FASTPASS_ALL;
		}

		this._rideSearchManager.setRideLocation(rideLocation);
		this._rideSearchManager.setFastpass(fastpass);
		this._rideSearchManager.setHeightRequirement(heightRequirment);
		this._rideSearchManager.setMaxWaitTime(maxWaitTime);
	}
	
	this._searchButtonClicked = function()
	{
		this._collectSearchData();
		
		this.refresh();
	}
	
	//private
	this._getRideTimeCombobox = function()
	{
		var output = 
			'<select id="' + this._MAX_WAIT_TIME_FIELD_TAG + 
			'" name="combobox">';
			
		if(this._rideSearchManager.getMaxWaitTime() == 
			this._rideSearchManager.MAX_WAIT_TIME_ALL)
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_ALL + 
				'" selected >All</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_ALL +'" >All</option>';
		}
		
		if(this._rideSearchManager.getMaxWaitTime() == 
			this._rideSearchManager.MAX_WAIT_TIME_30)
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_30 + 
				'" selected > \< 30 minutes</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_30 + 
				'" > \< 30 minutes</option>';
		}
		
		if(this._rideSearchManager.getMaxWaitTime() == 
			this._rideSearchManager.MAX_WAIT_TIME_60)
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_60 + 
				'" selected > \< 1 hour</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_60 + 
				'" > \< 1 hour</option>';
		}
		
		if(this._rideSearchManager.getMaxWaitTime() == 
			this._rideSearchManager.MAX_WAIT_TIME_90)
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_90 + 
				'" selected > \< 1 1/2 hours</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_90 + 
				'" > \< 1 1/2 hours</option>';
		}
		
		if(this._rideSearchManager.getMaxWaitTime() == 
			this._rideSearchManager.MAX_WAIT_TIME_120)
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_120 + 
				'" selected > \< 2 hours</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.MAX_WAIT_TIME_120 + 
				'" > \< 2 hours</option>';
		}
		
		output += '</select> ';
		
		return output;
	}
	
	//Private
	this._getHeightCombobox = function()
	{
		var output = 
			'<select id="'+ this._HEIGHT_REQUIREMNT_FIELD_TAG + 
			'" name="combobox">';
			
		if(this._rideSearchManager.getHeightRequirement() == 
			this._rideSearchManager.HEIGHT_REQUIREMENT_ALL)
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_ALL + 
				'" selected >All</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_ALL + 
				'" >All</option>';
		}
		if(this._rideSearchManager.getHeightRequirement() == 
			this._rideSearchManager.HEIGHT_REQUIREMENT_YES)
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_YES + 
				'" selected >Yes</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_YES + 
				'" >Yes</option>';
		}
		if(this._rideSearchManager.getHeightRequirement() == 
			this._rideSearchManager.HEIGHT_REQUIREMENT_NO)
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_NO + 
				'" selected >No</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.HEIGHT_REQUIREMENT_NO +'" >No</option>';
		}

		output += '</select> ';
		
		return output;
	}
	
	//private
	this._getFastPassCombobox = function()
	{
		var output = 
			'<select id="'+ this._FASTPASS_FIELD_TAG + '" name="combobox">';
			
		if(this._rideSearchManager.getFastpass() == 
			this._rideSearchManager.FASTPASS_ALL)
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_ALL + 
				'" selected >All</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_ALL +'" >All</option>';
		}
		
		if(this._rideSearchManager.getFastpass() == 
			this._rideSearchManager.FASTPASS_YES)
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_YES +
				'" selected >Yes</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_YES +'" >Yes</option>';
		}
		
		if(this._rideSearchManager.getFastpass() == 
			this._rideSearchManager.FASTPASS_NO)
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_NO +'" selected >No</option>';
		}
		else
		{
			output += '<option value="' + 
				this._rideSearchManager.FASTPASS_NO +'" >No</option>';
		}
		output += '</select> ';
		
		return output;
	}
	
	//private
	this._getRideLocations = function()
	{
		var rides = this._rideManager.getRides();
		
		var rideLocations = new Array();
		
		for(var index = 0; index < rides.length; index++)
		{
			var ride = rides[index];
			if(!this._doesArrayContain(rideLocations, ride.getLocation()))
			{
				rideLocations.push(ride.getLocation());
			}
		}
		
		rideLocations.sort(function(location1, location2)
		{
			return location1.localeCompare(location2);
		});
		
		return rideLocations;
	}
	
	//private
	this._doesArrayContain = function(array, value)
	{
		for(var index = 0; index < array.length; index++)
		{
			var element = array[index];
			if(element == value)
			{
				return true;
			}
		}
		
		return false;
	}
}
 // ----------------------------------------------------------------------------
 // Public Static Members
 // ----------------------------------------------------------------------------

function advanceSearchButton()
{
	var rideSearchView = 
		pageHolder.getPage(RideSearchViewName);
	
	rideSearchView._searchButtonClicked();
}
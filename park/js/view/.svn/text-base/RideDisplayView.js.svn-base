/**
 * Class instance tag
 * 
 * This is the static name of an instance of this class. 
 */
RideDisplayViewName = "Mobile Ride Display View";


/**
 * This class displays a view of all the rides
 */
function RideDisplayView(itineraryRideManager, htmlRideDisplayer)
{
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
	
   	this._itineraryRideManager = itineraryRideManager;
	this._htmlRideDisplayer = htmlRideDisplayer;
    this._rideSorter = new RideSorter();
	
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
   
        document.getElementById(this.replaceDiv).innerHTML = html;
        
        this.afterDisplayed();
	}
	
	this.setReplaceDiv = function(replaceDiv)
	{
		this.replaceDiv = replaceDiv;
	}
	
	/**
	 * Called when the page exits
	 */
	//public
	this.exit = function()
	{
		this._itineraryRideManager.removeUpdateListener(this);
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
	 * Get the distict page name. 
	 */
	//public
	this.getName = function()
	{
		return RideDisplayViewName;
	}

	// ----------------------------------------------------------------------
	// Public Members
	// ----------------------------------------------------------------------
	
	this.setRides = function(rides)
	{
		this.rides = rides;
	}
	
	this.getRides = function()
	{
		return this.rides;
	}
	
	this.addRideToItinerary = function(rideId)
	{
		this._itineraryRideManager.addNewItineraryRideFromRideId(rideId);
		this.refresh();
	}
	
	//public
    this.getHTML = function()
    {        
	    var html = "";
		
		if (this.rides.length > 0) 
		{
	        html = 
	        '<hr />' + 
	        '<table align="center">' +
				'<thead>' +
	            '<tr>' +
	                '<th width="1%">' +
					"*" + 
	                '</th>' +
					'<th width="39%">' +
                        "<A HREF='"+base_url+"' onClick='sortRidesOn(\"" + 
                        this._rideSorter.NAME_TYPE + "\"); " +
						" return false' > " +
						this._getNameTitle() +
						"</A>" +
	                '</th>' +
	                '<th width="40%">' +
	                    "<A HREF='"+base_url+"' onClick='sortRidesOn(\"" + 
                        this._rideSorter.LOCATION_TYPE + "\"); " +
                        " return false' > " +
						this._getLocationTitle() +
						"</A>" +
	                "</th>" +
	                "<th width='17%'>" +
	                    "<A HREF='"+base_url+"' onClick='sortRidesOn(\"" + 
                        this._rideSorter.CURRENT_WAIT_TYPE + "\"); " +
	                    " return false' >" +
						this._getCurrentWaitTitle() + 
						"</A>" +  
	                '</th>' +
	                '<th width="3%">' +
	                    'Q' +
	                '</th>' +
	            '</tr>' +
				'</thead>' +
				'<tbody>' +
	            	this._getRidesHTML() + 
				'</tbody>' +
	         '</table><hr /><br>' +
	        '<div align="left">' +
	            this._htmlRideDisplayer.getLegendHTML() +
	        '</div>';
        }
		else
		{
			html = 	'<hr />' + 
				'<div align="center"> <h3>No Rides Meet Your Search Requirements</h3> </div>';
		}
        
        return html;
    }
    
    //public
	this.afterDisplayed = function()
	{
		this._itineraryRideManager.addUpdateListener(this);
	}
    	
	// -------------------------------------------------------------------------------
	// UpdateListener Members
	// -------------------------------------------------------------------------------
	
	/**
	 * Refresh the page
	 */
	this.refresh = function()
	{
		this.showPage(this.replaceDiv);
	}
		
    // -------------------------------------------------------------------------------
	// Object Members
	// -------------------------------------------------------------------------------
	
	this.toString = function()
	{
		return this.getName();
	}
    
	// ----------------------------------------------------------------------
	// Private Members
	// ----------------------------------------------------------------------
	
	this._getCurrentWaitTitle = function()
	{
		var html = "";
		
		if(this._rideSorter.getSortType() == 
			this._rideSorter.CURRENT_WAIT_TYPE)
		{
			html += "<font color='#6600CC'> Current Wait </font>";
		}
		else
		{
			html += "Current Wait";
		}
		
		return html;
	}
	
	this._getLocationTitle = function()
	{
		var html = "";
		
		if(this._rideSorter.getSortType() == 
			this._rideSorter.LOCATION_TYPE)
		{
			html += "<font color='#6600CC'> Location </font>";
		}
		else
		{
			html += "Location";
		}
		
		return html;
	}
	
	this._getNameTitle = function()
	{
		var html = "";
		
		if(this._rideSorter.getSortType() == 
			this._rideSorter.NAME_TYPE)
		{
			html += "<font color='#6600CC'> Name </font>";
		}
		else
		{
			html += "Name";
		}
		
		return html;
	}
	
	/**
	 * Get the ride html
	 */
	//private 
    this._getRidesHTML = function()
    {	
        var html = "";
		
        var rides = this._rideSorter.sortRides(this.rides);

		for(var index = 0; index < rides.length; index++)
        {
        	var ride = rides[index];
			
			if(1 == (index % 2))
			{
				html += '<tr class="alternate">';
			}
			else
			{
				html += '<tr>';
			}
			
            html += 
	            '<td>' +
	                this._htmlRideDisplayer.getRideIconsHTML(ride) +
	            '</td>' + 
	            '<td>' +
	                this._htmlRideDisplayer.getRideNameHTML(ride) +
	            '</td>' + 
				'<td>' +
	                ride.getLocation() +
	            '</td>' + 
	            '<td align="center" >' +
	                this._htmlRideDisplayer.getCurrentWaitTimeHTML(ride) +
	            '</td>' +
	            '<td align="center" >' +
	                this._getQHTML(ride) +
	            '</td>' + 
            '</tr>';
        }
		
        return html;
    }
    
    this._getQHTML = function(ride)
    {
    	var html = "";
    	
    	if(this._itineraryRideManager.containsRide(ride))
    	{
    		html += "<b>Q</b>";    		
    	}
    	else
    	{
    		html += "<input type='button' value='+Q'" + 
			" onClick='addItineraryRideButtonClicked(" + 
			ride.getId() + "); return false' />"; 
    	}
    	
    	return html;
    }
	
	this._sortOn = function(type)
    {
        this._rideSorter.setSortType(type);       
        this.refresh();
    }
}
 // -------------------------------------------------------------------------
 // Public Static Members
 // -------------------------------------------------------------------------

function addItineraryRideButtonClicked(rideId)
{
	var rideDisplayView = pageHolder.getPage(RideDisplayViewName);

	rideDisplayView.addRideToItinerary(rideId);
}

function sortRidesOn(type)
{
	var rideDisplayView = pageHolder.getPage(RideDisplayViewName);

	rideDisplayView._sortOn(type);

	return false;
}


/**
 * This page creates a panel to allow the users to create and view their intinerary. 
 * 
 * This page is only used for browsers with a limited functionaity. 
 * Mobile Internet Explorer
 * 
 * Implements Page
 * void exit();
 * void showPage(div, arguments);
 * String getName();
 * void setPageHolder(pageHolder);
 * 
 * Implements UpdateListener
 * void refresh();
 * 
 * @param itineraryRideManager - the manager that contain all the itinerary rides
 */
 
 //Page Name
 ItineraryRideViewName = "Itinerary ride View";
function ItineraryRideView(itineraryRideManager, htmlRideDisplayer)
{
	// -------------------------------------------------------------------------
	// Private Static Variables
	// -------------------------------------------------------------------------
	
	// The external method called 
	this._UPDATE_BUTTON = "updateButtonClicked";
	this._ADVANCED_BUTTON = "advancedButtonClicked";
	this._ADVANCED_Q_BUTTON_TEXT = "Advanced Q";
	this._BASIC_Q_BUTTON_TEXT = "Basic Q";
	
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------

	this._itineraryRideManager = itineraryRideManager;
	this._itineraryUpdateManager = 
        new ItineraryUpdateManager(itineraryRideManager);
	this._htmlRideDisplayer = htmlRideDisplayer;
	this._advancedButtonText = this._ADVANCED_Q_BUTTON_TEXT;
	this._isAdvancedView = false;
	this._itineraryRideSorter = new ItineraryRideSorter();

	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------
	
	/**
	 * Get the html used to display this page
	 */
	//public
	this.getHTML = function()
    {
        var html = 
		'<br>' +
        '<div align="center"><img src="'+ base_url + 'img/my_q.png" alt="My Q"></div>' +
        '<hr />' ;
		
		if (!this._isItineraryEmpty()) 
		{
	        html += 
			'<table border="0" align="center" >' +
				'<thead>'+
					'<tr>' +
	    				this._getColumns() +
	            	'</tr>' +
				'</thead>' +
				'<tbody>' +
	            this._getItineraryRidesHTML() + 
				'</tbody>' +
	         '</table>' +
	   	        '<hr />' + 
	        '<div align="right">' +
	            '<a href="'+base_url+
	            	'" onClick="' + this._UPDATE_BUTTON + '();' + 
					' return false" >' +
	            '<img src="'+ base_url + 'img/update.png" alt="Update Q"></a>' +
	        '</div>'+
	        '<div align="left"><br>' +
	            this._htmlRideDisplayer.getLegendHTML() +
	        '</div>';
		}
		else
		{
			html += 
			"<div align='center'>" +
			"You currently have no rides in your Q. Click " + 
			"<A  HREF='"+base_url+"' onClick='advancedSearchView();" +
            " return false' >here</A>" + 
			" to search for rides to add to your Q." +
			"</div>" +
			"<hr />";
		}
        
        return html;
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
	 * Called when the page exits 
	 */
	 //public
	this.exit = function()
	{
		//
		// Do nothing
		//
	}
	
	/**
	 * Get the distict page name. 
	 */
	 //public
	this.getName = function()
    {
        return ItineraryRideViewName;
    }
    
	/**
	 * Set the page holder that this page is contained in
	 */
	 //public
    this.setPageHolder = function(pageHolder)
    {
        this.pageHolder = pageHolder;
    }
    
    //public
    this.afterDisplayed = function()
	{

	}
    
    // -------------------------------------------------------------------------
	// UpdateListener Members
	// -------------------------------------------------------------------------
	
	/**
	 * Refresh the page
	 */
    this.refresh = function()
	{
		this.showPage(this.replaceDiv);
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
	
	//private
	this._isItineraryEmpty = function()
	{
		return this._itineraryRideManager.getItineraryRides().length == 0;
	}
	
	//private
	this._getColumns = function()
    {
		var html = "";
		if(this._isAdvancedView)
    	{
        	html += '<th width="5%">' +
                    	'Priority' + 
            		'</th>' +
                	'<th width="25%">' +
                    	'Name' +
                	'</th>' +
               		'<th width="25%">' +
                    	'Location' +
                	'</th>' +
                	'<th width="12%">' +
                    	'Current Wait' + 
                	'</th>' +
                	'<th width="12%">' +
                    	'Average Wait' +
                	'</th>' +
                	'<th width="16%">' +
                    	'Shortest Wait' +
                	'</th>' +
                	'<th width="5%">' +
                    	'Remove ' +
                	'</th> ';
    	}
    	else //if(this._advancedButtonText == this._BASIC_Q_BUTTON_TEXT)
    	{
			html += '<th width="5%">' +
	                    "<A HREF='"+base_url+"' onClick='sortItineraryOn(\"" + 
                        this._itineraryRideSorter.PRIORITY_TYPE + "\"); " +
	                    " return false' >" + 
							this._getPriorityTitle() +
						"</A>" +
	                '</th>' +
                	'<th width="1%">*</th>' +
	                '<th width="35%">' +
                        "<A HREF='"+base_url+"' onClick='sortItineraryOn(\"" + 
                        this._itineraryRideSorter.NAME_TYPE + "\"); " + 
						" return false' > " +
						this._getNameTitle() +
						"</A>" +
	                '</th>' +
	               '<th width="36%">' +
                        "<A HREF='"+base_url+"' + onClick='sortItineraryOn(\"" + 
                        this._itineraryRideSorter.LOCATION_TYPE + "\"); " +
                        " return false' > " +
						this._getLocationTitle() +
						"</A>" +
	                '</th>' +
	                '<th width="18%">' +
	                    "<A HREF='"+base_url+"' + onClick='sortItineraryOn(\"" + 
                        this._itineraryRideSorter.CURRENT_WAIT_TYPE + "\"); " +
	                    " return false' >" +
						this._getCurrentWaitTitle() + 
						"</A>" + 
	                '</th>' +
	                '<th width="5%">' +
	                    'Remove ' +
	                '</th> ';
    	}
    	
    	return html;
    }
	
	this._getCurrentWaitTitle = function()
	{
		var html = "";
		
		if(this._itineraryRideSorter.getSortType() == 
			this._itineraryRideSorter.CURRENT_WAIT_TYPE)
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
		
		if(this._itineraryRideSorter.getSortType() == 
			this._itineraryRideSorter.LOCATION_TYPE)
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
		
		if(this._itineraryRideSorter.getSortType() == 
			this._itineraryRideSorter.NAME_TYPE)
		{
			html += "<font color='#6600CC'> Name </font>";
		}
		else
		{
			html += "Name";
		}
		
		return html;
	}
	
	this._getPriorityTitle = function()
	{
		var html = "";
		
		if(this._itineraryRideSorter.getSortType() == 
			this._itineraryRideSorter.PRIORITY_TYPE)
		{
			html += "<font color='#6600CC'> Priority </font>";
		}
		else
		{
			html += "Priority";
		}
		
		return html;
	}
    
	/**
	 * Updates the stored ItineraryRide objects to match the changes made on 
	 * the itinerary panel. 
	 * 
	 * Called from updateButtonClicked external 
	 */
	//protected. (only called from this classes external)
    this._update = function()
    {
        this._itineraryUpdateManager.updateItinerary();
        
    	this.refresh();
    }
    
    this._advancedButtonClicked = function()
    {
    	if(this._advancedButtonText == this._ADVANCED_Q_BUTTON_TEXT)
    	{
    		this._advancedButtonText = this._BASIC_Q_BUTTON_TEXT;
    		this._isAdvancedView = true;
    	}
    	else //if(this._advancedButtonText == this._BASIC_Q_BUTTON_TEXT)
    	{
    		this._advancedButtonText = this._ADVANCED_Q_BUTTON_TEXT;
    		this._isAdvancedView = false;
    	}
    	this.refresh();
    }

	/**
	 * Get the html for the itinerary rides table. 
	 */
	//private
    this._getItineraryRidesHTML = function()
    {
		var itineraryRides = this._itineraryRideManager.getItineraryRides();
		
		itineraryRides = this._itineraryRideSorter.sortRides(itineraryRides);

       	var html = "";
		
		for(var index = 0; index < itineraryRides.length; index++)
        {
			var itineraryRide = itineraryRides[index];
			var ride = itineraryRide.getRide();
			
			if(1 == (index % 2))
			{
				html += '<tr class="alternate">';
			}
			else
			{
				html += '<tr>';
			}
			
            html += "<td>" + 
                "<div align='center'>" +
                    "<input name='Priority' type='text' id='Priority" + 
                    itineraryRide.getPriority() + "' value='" + 
                    itineraryRide.getPriority() + "' size='2' maxlength='2' />" +
                "</div>" +
            "</td>" + 
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
            	this._getOptionalColumns(ride) +
            '<td align="center" >' +
                '<input type="checkbox" name="remove" id="remove' + 
                itineraryRide.getPriority() + '" />' +
                '<input name="ridebox" type="hidden" id="RideId' + 
                itineraryRide.getPriority() + '" value="' + ride.getId() + '" />' + 
            '</td>' +
            '</tr>';
        }
		
        return html;
    }
    
    this._getOptionalColumns = function(ride)
    {
    	var html = '';
    	if(this._isAdvancedView)
    	{
			html += 
           	'<td align="center" >' +
               	this._htmlRideDisplayer.getAverageWaitTimeHTML(ride) +
           	'</td>' +
            '<td align="center" >' +
                this._htmlRideDisplayer.getNextShortestTimeOfDayHTML(ride) + 
                "<br> " +
                this._htmlRideDisplayer.getNextShortestWaitTimeHTML(ride) +
            '</td>';
    	}
    	
    	return html;
    }
	
    this._sortOn = function(type)
    {
        this._itineraryRideSorter.setSortType(type);
	
        this.refresh();
    }
}

//public static void
function updateButtonClicked()
{
	var itineraryView = pageHolder.getPage(ItineraryRideViewName);
	
	itineraryView._update();
}
//public static void
function advancedButtonClicked()
{
	var itineraryView = pageHolder.getPage(ItineraryRideViewName);
	
	itineraryView._advancedButtonClicked();
}

function sortItineraryOn(type)
{
	var itineraryView = pageHolder.getPage(ItineraryRideViewName);

	itineraryView._sortOn(type);

	return false;
}

function showRideSearchView()
{
    pageHolder.showPage(RideSearchViewName);
    
    var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(RideSearchViewName);

    return false;
}

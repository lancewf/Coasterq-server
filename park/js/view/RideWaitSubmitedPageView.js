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
 * String getHtml();
 */
 
/**
 * Class instance tag
 * 
 * This is the static name of an instance of this class. 
 */
RideWaitSubmitedPageViewName = "Ride Wait Submit Page View";

/**
 * This class displays a view of a submit ride time
 */
function RideWaitSubmitedPageView(htmlRideDisplayer) // implements Page
{
	// -------------------------------------------------------------------------
	// Static Class Varablies
	// -------------------------------------------------------------------------

	// The external method called 
	this._OK_BUTTON_TAGE = "okSubmit";
	
	// -------------------------------------------------------------------------
	// Instance Varablies
	// -------------------------------------------------------------------------

	this._htmlRideDisplayer = htmlRideDisplayer;
	
	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	//public
	this.setRide = function(ride)
	{
		this.ride = ride;
	}
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------
	
	/**
	 * Get the distict page name. 
	 */
	 //public
	this.getName = function()
	{
		return RideWaitSubmitedPageViewName;
	}
	
	/**
	 * Called when the page exits 
	 */
	 //public
	this.exit = function()
	{
		
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
        var html = 
			'<hr /> <table cellspacing="5" border="0" align="center">' +
				'<tr>' +
					'<td align="center">' +
						'<h3 align="center">' +
            				'Thank you for submitting a ride time for ' + 
            				this.ride.getName() + 
            			' </h3>'+
						"<br />" +
						"Click " + 
						"<A  HREF='"+home_url+"faqs.html' >here</A>" +
						" to see how your entry will improve the wait times displayed on CoasterQ" + 
						"<br />" +
						"<br />" +
						this._getButtons() +
					'</td>' +
				'</tr>' +
			'</table> <hr />';
			
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
	this._getButtons = function()
	{
		
		var html = 
		    '<a href="'+base_url+
	        	'" onClick="' + this._OK_BUTTON_TAGE + '();' + 
				' return false" >' +
		    	'<img src="'+ base_url + 'img/ok_button.png" alt="Ok">' +
		    '</a>';
			
		return html;
	}
}
 // ----------------------------------------------------------------------------
 // Public Static Members
 // ----------------------------------------------------------------------------

//public static void
function okSubmit()
{
	var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(ItineraryRideViewName);
	
	pageHolder.showPage(ItineraryRideViewName);
}
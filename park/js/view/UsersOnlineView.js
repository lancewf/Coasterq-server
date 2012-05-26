/**
 * @author lancewf
 */
UsersOnlineViewName =  "User Online View";

function UsersOnlineView(userOnline)
{
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
	
	this._userOnline = userOnline;
	this._REFRESH_RATE = 300000; // 5 minutes
	//this._REFRESH_RATE = 5000; // 5 seconds
		
	// ------------------------------------------------------------------
	// Private Variables
	// ------------------------------------------------------------------

	this._ajaxTransport = new AjaxTransport();
	this._status = this.STATUS_SUCCESS;
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------

	/**
	 * 
	 */
	 //public
	this.getHTML = function()
	{
		var html = this._getUsersOnline() + " users online";

		return html;
	}
	
	/**
	 * Set the page holder that this page is contained in
	 */
    //public
    this.setPageHolder = function(pageHolder)
    {
        this._pageHolder = pageHolder;
    }

	/**
	 * Show this page
	 */
	 //public
	this.showPage = function(replaceDiv)
	{
		this._replaceDiv = replaceDiv;

        var html = this.getHTML();
   
        document.getElementById(this._replaceDiv).innerHTML = html;
        
        this.afterDisplayed();
	}
	
	/**
	 * Refresh the page
	 */
    this.refresh = function()
	{
		this.showPage(this._replaceDiv);
	}
	
	/**
	 * Get the distict page name. 
	 */
	//public
	this.getName = function()
	{
		return UsersOnlineViewName;
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
	
	/**
	 * Update the client rides in this manager.
	 * 
	 * Request the server for the ride information.
	 */
	//private
	this._updateUsersOnline = function()
	{
		var usersOnlineView = this;
		this._ajaxTransport.makeServerRequest(base_services_url + 
			'getUsersOnline', "", function(response)
        {
        	if(response)
        	{
				usersOnlineView._status = usersOnlineView._STATUS_SUCCESS;
	            usersOnlineView._userOnline = response;
        	}
        	else
        	{
        		usersOnlineView._status = usersOnlineView._STATUS_FAILURE;
        	}
           	usersOnlineView._startTimer();
            usersOnlineView.refresh();
        }); 
	}

	/**
	 * Start the timer to update the rides
	 */
	//private
	this._startTimer = function()
	{
		var usersOnlineView = this;
		this.timer = setTimeout(
    		function() 
    		{ 
    			usersOnlineView._updateUsersOnline(); 
    		}, 
    		this._REFRESH_RATE);
	}
	
	this._getUsersOnline = function()
	{
		return this._addCommas(this._userOnline);
	}
	
	this._addCommas = function(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
	
	this._startTimer();
}

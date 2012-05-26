PageLinkViewName =  "Page Link View";

function PageLinkView(parkName, activePage)
{
	// -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
	
	this._parkName = parkName;
	this._pageHolder = null;
	this._replaceDiv = null;
   	this._activePage = activePage;
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------

	/**
	 * 
	 */
	 //public
	this.getHTML = function()
	{
		var html = 
			'<table width="100%" border="0" >' +
				'<tr>' +
					'<td align="center">' +
						'<h2>' + this._parkName + '</h2>' +
					'</td>' +
				'</tr>' + 
				'<tr>' +
					'<td align="center">' +
                        this._getActivePageHtml() +
					'</td>' +
		        '</tr>' +
			'</table>';

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
	 * Get the distict page name. 
	 */
	//public
	this.getName = function()
	{
		return PageLinkViewName;
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
	
    this.updateSeletedPage = function(activePage)
    {
        this._activePage = activePage;

		this.showPage(this._replaceDiv);
    }
	
	this._getActivePageHtml = function()
    {
        var html = "";

        if(this._activePage == ItineraryRideViewName)
        {
            html += "<b>My Q</b>";
        }
        else
        {
            html += 
            "<A  HREF='"+base_url+"' onClick='showItineraryView();" +
            " return false' >My Q</A>" ;
        }

        html +=  "<img src='" + base_url + "img/dot.png' />";

        if(this._activePage == EnterTimeViewName)
        {
            html += "<b>Enter Wait</b>";
        }
        else
        {
            html += 
            "<A  HREF='"+base_url+"' onClick='enterRideTimeView();" +
            " return false' >Enter Wait</A>" ;
        }

        html +=  "<img src='"+base_url+"img/dot.png' />";

        if(this._activePage == RideSearchViewName)
        {
            html += "<b>Ride Search</b>";
        }
        else
        {
            html += 
            "<A  HREF='"+base_url+"' onClick='advancedSearchView();" +
            " return false' >Ride Search</A>" ;
        }

        html +=  "<img src='"+base_url+"img/dot.png' />";

        html += 
            "<A  HREF='"+home_url+"' >Change Park</A>" ;

        return html;
    }
}

 // -------------------------------------------------------------------------
 // Public Static Members
 // -------------------------------------------------------------------------
	
function advancedSearchView()
{
	//document.location = "#start";
		
    pageHolder.showPage(RideSearchViewName);
    
    var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(RideSearchViewName);

    return false;
}

function enterRideTimeView()
{
	//document.location = "#start";
	
    pageHolder.showPage(EnterTimeViewName);

    var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(EnterTimeViewName);

    return false;
}

function showItineraryView()
{
	//document.location = "#start";
		
    pageHolder.showPage(ItineraryRideViewName);

    var pageLinkView = pageHolder.getPage(PageLinkViewName);
    
    pageLinkView.updateSeletedPage(ItineraryRideViewName);

    return false;
}

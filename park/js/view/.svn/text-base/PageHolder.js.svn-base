
/**
 * This class is a page holder. A page holder contains and manages a collection of pages
 * 
 * The page holder is used to manage which page is displayed to the user and allows pages
 * to be change by passing in the name of the page. 
 * 
 * @param replaceDiv - the div where the page holder displays its pages
 */
function PageHolder(replaceDiv)
{
	// ---------------------------------------------------------
	// Private Data
	// ---------------------------------------------------------
	
	this._replaceDiv = replaceDiv;
	this._pageCollection = new Array();
	this._currentPage = null;
	this._previousPage = null;

	// ---------------------------------------------------------
	// Public Members
	// ---------------------------------------------------------
	
	/**
	 * Add a page to the page holder
	 */
	 //public
	this.addPage = function(page)
	{
        page.setPageHolder(this);
		this._pageCollection.push(page);
	}

	/**
	 * Get the index of the page with the name "pageName"
	 * 
	 * @param pageName - the name of the page that the index is wanted from
	 */
	 //public
	this.getIndex = function(pageName)
	{
		var compareFunction = function(n)
		{
			return n.getName() == pageName;
		};
		
		var index = this._pageCollection.indexOf(compareFunction);
		
		return index;
	}

	/**
	 * Get the page with the name passed in
	 * 
	 * @param pageName - the name of the page desired
	 */
	 //public
	this.getPage = function(pageName)
	{
		var foundPage = null;

		for(var index = 0; index < this._pageCollection.length; index++)
		{
			if(this._pageCollection[index].getName() == pageName)
			{
				foundPage = this._pageCollection[index];
			}
		}
		
		return foundPage;
	}
	
	/**
	 * Show the page with the name passed in
	 * 
	 * @param pageName - the name of the page to show
	 */
	//public
	this.showPage = function(pageName)
	{
		var page = this.getPage(pageName);
		
		if(page)
		{
			if(page == this._currentPage)
			{
				this._currentPage.exit();
	            this._currentPage.showPage(this._replaceDiv, arguments);	
			}
			else
			{
				if(this._currentPage != null)
				{
					this._currentPage.exit();
					this._previousPage = this._currentPage;
				}
				
				this._currentPage = page;
            	this._currentPage.showPage(this._replaceDiv, arguments);
			}
		}
		else
		{
			//alert('Error: internal page "' + pageName + '"not found');
		}
	}
	
	/**
	 * Show the previous page that was shown
	 */
	 //public
	this.showPreviousPage = function()
	{
		if(this._previousPage)
		{
			this._currentPage.exit();
			this._currentPage = this._previousPage;
			this._previousPage.showPage(this._replaceDiv, arguments);
		}
	}
	
	/**
	 * Get the current page what is being shows name. 
	 */
	 //public
	this.currentPageName = function()
	{
		this._currentPage.getName();
	}
}

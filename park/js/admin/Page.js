Page = Class.create(
{
	initialize: function()
	{

	},

	showPage: function(replaceDiv, arguments)
	{
		this.replaceDiv = replaceDiv;
		
        var html = this.getHTML(arguments);
   
        $(this.replaceDiv).innerHTML = html;
		
		this.afterDisplayed();
	},
	
	afterDisplayed: function()
	{
		
	},
	
	exit: function()
	{
		
	},
	
	// display html
	getHTML: function(output)
    {
    	return "";
    },

    setPageHolder: function(pageHolder)
    {
        this.pageHolder = pageHolder;
    },

	getName: function()
	{
		return "Default Name";
	},

	toString: function()
	{
		return this.getName();
	},
	
	unHide: function()
	{
		new Effect.Appear(this.replaceDiv, {duration: 0.1});
	},
	
	hide: function()
	{
		new Effect.Fade(this.replaceDiv, {duration: 0.1} );
	}, 
	
		/**
	 * Refresh the page
	 */
    refresh: function()
	{
		this.showPage(this.replaceDiv);
	}
});

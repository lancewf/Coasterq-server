/**
 * @author lancewf
 */
PermanentlyDeletedRidesView = Class.create(Page,
{
	initialize: function($super, rideManager)
	{
		$super();
		
		this._rideManager = rideManager;
	},
	
	getHTML: function()
	{
		var html = 
			'<center><h3> Permanently Deleted Rides </h3></center>' +
			'<table cellspacing="5" border="0" align="center">' +
				this._getDeletedRidesHTML() +
			'</table>';
			
		return html;
	},
	
	afterDisplayed: function()
	{

	},
	
	_getDeletedRidesHTML : function()
	{	
		var rides = this._rideManager.getRides();
		var output ='';
		
		rides.each(function(ride)
		{
			if(ride.getClosedPermanently())
			{
				output += '<tr><td align="center">';
				output += ride.getName() ;
				output += '</td></tr>';
			}
		});
		
		return output;
	}
});
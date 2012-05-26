/**
 * @author lancewf
 */
EditRideDataView = Class.create(Page,
{
	initialize: function($super, rideCloserManager, rideManager, 
		rideAdminManager)
	{
		$super();
		
		this._month = new Date().getMonth() + 1;
		this._day = 1;
		this._year = new Date().getFullYear();
		this._htmlRideDisplayer = new HTMLRideDisplayer();
		this._rideCloserManager = rideCloserManager;
		this._rideManager = rideManager;
		this._rideAdminManager = rideAdminManager;
		this._selectedRideId = -1;
	},
	
	getHTML: function()
	{
		var html = 
			'<center><h3> Ride Data </h3></center>' +
			'<table cellspacing="5" border="0" align="center">' +
				'<tr>' + 
					'<td colspan="4" align="center">' +
						this._getRideCombobox() +
					'</td>' +
				'</tr>' + 
				'<tr>' +
					'<td>' +
					'Popularity' + 
					'</td>' +				
					'<td> ' + 
						this._getPopularityCombobox() +
					'</td>' + 
			        '<td >' +
			            'Closed Permanently' + 
			        '</td>' +
					'<td>' +
			            '<input id="isPermClosed" type="checkbox" />' + 
					'</td>' +
				'</tr>' +
				'<tr>' + 
					'<td colspan="4" align="center"> ' + 
						'<input type="hidden" value="save" id="saveRideData" />' +
					'</td>' + 
				'</tr>' +
				'<tr>' +
					'<td >' +
						'<b>Current closures</b>' + 
					'</td>' +
					'<td >' +
						'<input type="button" value="new" id="newRideClosure" />' +
					'</td>' + 
				'</tr>' + 
			'</table>' +
			'<div id="currentClosures" />';
			
		return html;
	},
	
	afterDisplayed: function()
	{
		$("newRideClosure").observe("click", function(event)
		{
			var rideId = $("rideCombo").value;
		
			var startDate = new Date(this._year, this._month -1, 1, 0, 0, 0);
			var endDate = new Date(this._year, this._month, 0, 0, 0, 0);
			
			this._rideCloserManager.createNewRideClosure(startDate, 
				endDate, rideId);
			
			this.displayDateForRide(rideId);
		}.bind(this));
		
		$("saveRideData").observe("click", function(event)
		{
			this.saveData();
			$("saveRideData").type = "hidden";
		}.bind(this));
		
		$("rideCombo").observe("change", function(event)
		{
			$("saveRideData").type = "hidden";
			this.displayDateForRide($("rideCombo").value);
		}.bind(this));
		
		$("popularitySelection").observe("change", function(event)
		{
			$("saveRideData").type = "button";
		}.bind(this));
		
		$("isPermClosed").observe("click", function(event)
		{
			$("saveRideData").type = "button";
		}.bind(this));
		
		this.displayDateForRide(this._selectedRideId);
	},
	
	setDate: function(day, month, year)
	{
		this._day = day;
		this._month = month;
		this._year = year;
		
		CalendarControlSetCurrentMonth(this._month);
		CalendarControlSetCurrentYear(this._year);
		CalendarControlSetCurrentDay(this._day);
	},
	
	displayDateForRide: function(rideId)
	{
		var ride = this._rideManager.getRideFromId(rideId);
		
		$("popularitySelection").value = ride.getPopularity();
		$("isPermClosed").checked = ride.getClosedPermanently();
		
		$("currentClosures").innerHTML = this.getRideClosuresHtml(ride);
		
		$$("#currentClosures .saveRideClosure").each( function(saveButton, index)
		{
			saveButton.observe('click', function(event) 
			{
				var rideClosures = this._rideCloserManager.getClosuresFromRide(ride);
				
				var changedRideClosure = rideClosures[index];
				
				var startDate = this.getStartDateFromForm(index);
				
				var endDate = this.getEndDateFromForm(index);
				
				if(changedRideClosure.getStartDate().getDate() != startDate.getDate() ||
					changedRideClosure.getStartDate().getMonth() != startDate.getMonth() ||
					changedRideClosure.getStartDate().getFullYear() != startDate.getFullYear() ||
					changedRideClosure.getEndDate().getDate() != endDate.getDate() ||
					changedRideClosure.getEndDate().getMonth() != endDate.getMonth() ||
					changedRideClosure.getEndDate().getFullYear() != endDate.getFullYear()
				  )
				{
					this._rideCloserManager.saveRideClosure(changedRideClosure, 
						startDate, endDate);
					this.displayDateForRide(rideId);
				}
				
			}.bind(this));
		}.bind(this));
		
		$$("#currentClosures .deleteRideClosure").each( function(deleteButton, index)
		{
			deleteButton.observe('click', function(event) 
			{
				var rideClosures = this._rideCloserManager.getClosuresFromRide(ride);
				
				this._rideCloserManager.removeRideClosure(rideClosures[index]);
				
				this.displayDateForRide(rideId);
			}.bind(this));
		}.bind(this));
		
		this._selectedRideId = rideId;
	},
	
	getStartDateFromForm: function(index)
	{
		var textField = $$("#currentClosures .closuresStartDate")[index];
		var startDateText = textField.value;
		
		if(startDateText.length > 0)
		{
			var splitStartDate = startDateText.split('-');
			
			var startDate = new Date(splitStartDate[2],
				splitStartDate[0]-1, splitStartDate[1], 0, 0, 0);
				
			return startDate;
		}
		
		return null;
	},
	
	getEndDateFromForm: function(index)
	{
		var textField = $$("#currentClosures .closuresEndDate")[index];
		var endDateText = textField.value;
		
		if(endDateText.length > 0)
		{
			var splitDate = endDateText.split('-');
			
			var endDate = new Date(splitDate[2],
				splitDate[0]-1, splitDate[1], 0, 0, 0);
				
			return endDate;
		}
		
		return null;
	},
	
	getDateFromTextField: function(texField)
	{
		var text = texField.value;
		
		if(text.length > 0)
		{
			var splitDate = text.split('-');
			
			var date = new Date(splitDate[2], splitDate[0]-1, 
				splitDate[1], 0, 0, 0);
				
			return date;
		}
		
		return null;
	},
	
	getRideClosuresHtml: function(ride)
	{
		var html = "";
		var rideClosures = this._rideCloserManager.getClosuresFromRide(ride);
		
		if(rideClosures.length > 0)
		{
			html += '<table cellspacing="5" border="0" align="center">';
			
			rideClosures.each(function(rideClosure, index)
			{
				var startDate = rideClosure.getStartDate();
				var endDate = rideClosure.getEndDate();
				
				html += 
				'<tr>' +
					'<td colspan="3" align="left"> ' + 
						'<input class="closuresStartDate" name="start_date"' + 
       					'onfocus="showCalendarControl(this);"' + 
       					'type="text" size="8" value="' + 
						this.getCalenderControlFormat(startDate) + '"/>'+ 
						' - ' +
						'<input class="closuresEndDate" name="end_date"' + 
       					'onfocus="showCalendarControl(this);"' + 
       					'type="text" size="8" value="' + 
						this.getCalenderControlFormat(endDate) + '"/>'+ 
					'</td>' + 
					'<td>' +
						'<input type="button" value="save" class="saveRideClosure" />' +
						' &nbsp;' +
						'<input type="button" value="delete" class="deleteRideClosure" />' +
					'</td>' + 
				'</tr>';
			}.bind(this));
			
			html += '</table>';
		}
		
		return html;
	},
	
	getCalenderControlFormat: function(date)
	{
		var html = "";
		
		var month = date.getMonth();
		
		month++;
		
		html += month + "-" + date.getDate() + "-" + date.getFullYear(); 
		
		return html;
	},
	
	saveData: function()
	{
		var isClosedPermanently = $("isPermClosed").checked;
		var popularity = $F('popularitySelection');
		var ride = this._rideManager.getRideFromId($("rideCombo").value);
		
		if(ride.getClosedPermanently() != isClosedPermanently || 
			ride.getPopularity() != popularity)
		{
			this._rideAdminManager.updateRide(ride, 
				isClosedPermanently, popularity);
		}
	},
	
	_getRideCombobox : function()
	{	
		var rides = this._rideManager.getRides();
		var output ='<select id="rideCombo" name="combobox">';
		
		for(var index = 0; index < rides.length; index++)
		{
			if(this._selectedRideId == rides[index].getId())
			{
				output += '<option value="' + rides[index].getId() + 
					'" selected >' + 
					this._htmlRideDisplayer.getShortenedRideName(rides[index])  + '</option>';
			}
			else
			{
				output += '<option value="' + rides[index].getId() + 
					'">' + this._htmlRideDisplayer.getShortenedRideName(rides[index])  
					+ '</option>';	
			}
		}
		
		output += '</select>';
		

		if(this._selectedRideId == -1)
		{
			this._selectedRideId = rides[0].getId();
		}
		
		return output;
	},
	
	_getPopularityCombobox : function()
	{	
		var output = '<select id="popularitySelection" name="combobox">';
		
		for(var index = 1; index <= 5; index++)
		{		
			output += 
               	'<option value="' + 
               	index + '" >' + index + '</option>';
		}
		output += '</select>';
		
		return output;
	}
});
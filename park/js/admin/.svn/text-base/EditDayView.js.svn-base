/**
 * @author lancewf
 */
EditDayView = Class.create(Page,
{
	initialize: function($super, parkDayManager)
	{
		$super();
		
		this._month = 1;
		this._day = 1;
		this._year = 2009;
		this._htmlRideDisplayer = new HTMLRideDisplayer();
		this._parkDayManager = parkDayManager;
		this._isEditingCrowLevel = true;
		this._isEditingHours = true;
	},
	
	getHTML: function()
	{
		var html = 
			'<center><h3> Park Day </h3></center>' +
			'<table cellspacing="5" border="0" align="center">' +
				'<tr>' +
			        '<td align="center" >' +
			            'Edit Hours' + 
			        '</td>' +
					'<td>' +
			            '<input id="editHours" type="checkbox" />' + 
					'</td>' +
					'<td>' +
						'Edit Crowd Level' + 
					'</td>' +
					'<td> ' + 
						'<input id="editCrowdLevel" type="checkbox" />' + 
					'</td>' + 
				'</tr>' +
				'<tr>' +
			        '<td align="center" >' +
			            'Closed' + 
			        '</td>' +
					'<td>' +
			            '<input id="isClosed" type="checkbox" />' + 
					'</td>' +
					'<td>' +
					'Crowd Level' + 
					'</td>' +
					'<td> ' + 
						this._getCrowdLevelCombobox() +
					'</td>' + 
				'</tr>' +
				'<tr>' + 
					'<td>' +
					'Start Date' + 
					'</td>' +
					'<td colspan="3">' +
						'<input id="start_date" name="start_date"' + 
       					'onfocus="showCalendarControl(this);"' + 
       					'type="text" />'+ 
	   				'</td>' + 
				'</tr>' +
				'<tr>' + 
					'<td>' +
					'End Date' + 
					'</td>' +
					'<td colspan="3">' +
						'<input id="end_date" name="end_date"' + 
       					'onfocus="showCalendarControl(this);"' + 
       					'type="text" />'+ 
	   				'</td>' + 
				'</tr>' +
				'<tr>' +
					'<td>' +
					'Park Opens' + 
					'</td>' +
					'<td align="center" colspan="3">' +
		 				this._getHourCombobox(8, 'parkOpensHour') + 
		 				" : " + 
		 				this._getMinCombobox('parkOpensMin') + 
		 				this._getAmPmCombobox(true, 'parkOpensAmPm') +
	 				'</td>' +
			    '</tr>' +
				'<tr>' +
					'<td>' +
					'Park Closes' + 
					'</td>' +
					'<td align="center" colspan="3">' +
		 				this._getHourCombobox(9, 'parkClosesHour') + 
		 				" : " + 
		 				this._getMinCombobox('parkClosesMin') + 
		 				this._getAmPmCombobox(false, 'parkClosesAmPm') +
	 				'</td>' +
			    '</tr>' +
				'<tr>' + 
					'<td colspan="4" align="center"> ' + 
						'<br /><input type="button" value="save" id="save" />' +
					'</td>' + 
				'</tr>' + 
			'</table>';
			
		return html;
	},
	
	afterDisplayed: function()
	{
		$("editCrowdLevel").observe("click", function(event)
		{
			this._isEditingCrowLevel = $("editCrowdLevel").checked;
			this.crowdLevelVisablity(this._isEditingCrowLevel);
		}.bind(this));
		
		$("editHours").observe("click", function(event)
		{
			this._isEditingHours = $("editHours").checked;
			this.parkHoursVisablity(this._isEditingHours);
			
		}.bind(this));
		
		$("save").observe("click", function(event)
		{
			this.saveData();
		}.bind(this));
		
		$("editCrowdLevel").checked = this._isEditingCrowLevel;
		this.crowdLevelVisablity(this._isEditingCrowLevel);
		
		$("editHours").checked = this._isEditingHours;
		this.parkHoursVisablity(this._isEditingHours);
	},
	
	parkHoursVisablity: function(isVisable)
	{
		if(isVisable)
		{
			$("parkOpensHour").show();
			$("parkOpensMin").show();
			$("parkOpensAmPm").show();
			
			$("parkClosesHour").show();
			$("parkClosesMin").show();
			$("parkClosesAmPm").show();
		}
		else
		{
			$("parkOpensHour").hide();
			$("parkOpensMin").hide();
			$("parkOpensAmPm").hide();
			
			$("parkClosesHour").hide();
			$("parkClosesMin").hide();
			$("parkClosesAmPm").hide();
		}
	},
	
	crowdLevelVisablity: function(isVisable)
	{
		if(isVisable)
		{
			$("crowdLevelSelection").show();
		}
		else
		{
			$("crowdLevelSelection").hide();
		}
	},
	
	saveData: function()
	{		
		var startDate = this.getStartDateFromForm();
		
		var endDate = this.getEndDateFromForm();
					
		if(startDate != null && endDate != null)
		{
			var isClosed = $F("isClosed");
			
			var openHour = this.getOpenHour();
			var openMin = $F('parkOpensMin');
			
			var closeHour = this.getClosesHour();
			var closeMin = $F('parkClosesMin');
			var crowdLevel = $F('crowdLevelSelection');
			
			var parkDays = new Array();
			
			if(endDate.getTime() < startDate.getTime())
			{
				alert("The end Date is before the start date");
			}
			
			while(endDate.getTime() >= startDate.getTime())
			{
				var parkDay = new ParkDay();
				
				parkDay.setDate(startDate.getDate(), startDate.getMonth() + 1, 
					startDate.getFullYear());
					
				if(isClosed != null)
				{
					parkDay.setIsClosed(true);
				}
				else
				{
					parkDay.setIsClosed(false);
				}
				
				parkDay.setOpenTime(openHour, openMin);
				
				parkDay.setCloseTime(closeHour, closeMin);
				
				parkDay.setCrowdLevel(crowdLevel);
				
				parkDays.push(parkDay);
				
				startDate.setDate(startDate.getDate() + 1);
			}
			
			if(parkDays.length > 0)
			{
				this._parkDayManager.addParkDays(parkDays, 
					$("editCrowdLevel").checked, $("editHours").checked);
			}
			else
			{
				alert("No data was saved");
			}
		}
	},
	
	getClosesHour : function()
	{
		var hour = $F('parkClosesHour');
		var amPm = $F('parkClosesAmPm');
		
		if(amPm == "am" && hour == 12)
		{
			hour = 0;
		}
		else if(amPm == "pm" && hour != 12)
		{
			hour = parseInt(hour) + 12;
		}
		
		return hour;
	},
	
	getOpenHour : function()
	{
		var hour = $F('parkOpensHour');
		var amPm = $F('parkOpensAmPm');
		
		if(amPm == "am" && hour == 12)
		{
			hour = 0;
		}
		else if(amPm == "pm" && hour != 12)
		{
			hour = parseInt(hour) + 12;
		}
		
		return hour;
	},
	
	getEndDateFromForm: function()
	{
		var endDateText = $F("end_date");
		
		if(endDateText.length > 0)
		{
			var splitEndDate = endDateText.split('-');
			
			var endDate = new Date(splitEndDate[2],
				splitEndDate[0]-1, splitEndDate[1], 0, 0, 0);
				
			return endDate;
		}
		
		return null;
	},
	
	getStartDateFromForm: function()
	{
		var startDateText = $F("start_date");
		
		if(startDateText.length > 0)
		{
			var splitStartDate = startDateText.split('-');
			
			var startDate = new Date(splitStartDate[2],
				splitStartDate[0]-1, splitStartDate[1], 0, 0, 0);
				
			return startDate;
		}
		
		return null;
	},
	
	setDate: function(day, month, year)
	{
		this._day = day;
		this._month = month;
		this._year = year;
		
		$("start_date").value = this._month + "-" + this._day + "-" + this._year;
		$("end_date").value = this._month + "-" + this._day + "-" + this._year;
		
		CalendarControlSetCurrentMonth(this._month);
		CalendarControlSetCurrentYear(this._year);
		CalendarControlSetCurrentDay(this._day);
	},
	
	setParkDay: function(parkDay)
	{
		this.setDate(parkDay.getDay(), parkDay.getMonth(), parkDay.getYear());
		
		$("isClosed").checked = parkDay.isClosed();
		
		var openHour = parkDay.getOpenHour();
		
		if(openHour > 11 && openHour != 0)
		{
			$('parkOpensAmPm').value = "pm";
		}
		else
		{
			$('parkOpensAmPm').value = "am";
		}
		
		if(openHour == 0)
		{
			openHour = 12;
		}
		else if(openHour > 12)
		{
			openHour -= 12;
		}
		
		$('parkOpensHour').value = openHour;
		$('parkOpensMin').value = parkDay.getOpenMin();
		
		var closeHour = parkDay.getCloseHour();
		
		if(closeHour > 11  && closeHour != 0)
		{
			$('parkClosesAmPm').value = "pm";
		}
		else
		{
			$('parkClosesAmPm').value = "am";
		}
		
		if(closeHour == 0)
		{
			closeHour = 12;
		}
		else if(closeHour > 12)
		{
			closeHour -= 12;
		}
		$('crowdLevelSelection').value = parkDay.getCrowdLevel();
		$('parkClosesHour').value = closeHour;
		$('parkClosesMin').value = parkDay.getCloseMin();
	},
	
	_getCrowdLevelCombobox : function()
	{	
		var output = '<select id="crowdLevelSelection" name="combobox">';
		
		for(var index = 1; index <= 4; index++)
		{		
			output += 
               	'<option value="' + 
               	index + '" >' + index + '</option>';
		}
		output += '</select>';
		
		return output;
	},
	
    //private
	_getHourCombobox : function(seletedHour, tag)
	{	
		var output = '<select id="' + tag + '" name="combobox">';
		
		for(var adjustedHour = 1; adjustedHour <= 12; adjustedHour++)
		{
			if(seletedHour == adjustedHour)
			{
				output += 
		           	'<option value="' + adjustedHour + 
		           	'" selected >' + adjustedHour + '</option>';
			}
			else
			{			
				output += 
	               	'<option value="' + 
	               	adjustedHour + '" >' + adjustedHour + '</option>';
			}
		}
		output += '</select>';
		
		return output;
	},
	
	//private
	_getMinCombobox : function(tag)
	{
		var min = 0;
		
		var output = '<select id="' + tag + '" name="combobox">';
		
		output += '<option value="0" selected >00</option>';

		output += '<option value="30" >30</option>';

		output += '</select>';
		
		return output;
	},

    //private
	_getAmPmCombobox : function(isAm, tag)
	{
		var output = '<select id="' + tag + '" name="combobox">';
		
		if(!isAm)
		{
			output += '<option value="am">AM</option>' + 
				'<option value="pm" selected >PM</option>';
		}
		else
		{
			output += '<option value="am" selected>AM</option>' + 
				'<option value="pm">PM</option>';
		}
		
		output += '</select>';
		
		return output;
	}
});
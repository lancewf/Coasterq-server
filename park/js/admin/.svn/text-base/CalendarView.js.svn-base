/**
 * @author lancewf
 */
CalendarView = Class.create(Page,
{
	initialize: function($super, parkDayManager, rideCloserManager, rideManager)
	{
		$super();
		
		var date = new Date();
		
		var rideAdminManager = new RideAdminManager(rideManager);

		this._month = date.getMonth() + 1;
		this._year = date.getFullYear();
		this._editDayView = new EditDayView(parkDayManager);
		this._editRideDataView = 
			new EditRideDataView(rideCloserManager, rideManager, rideAdminManager);
		this._permanentlyDeletedRidesView = new PermanentlyDeletedRidesView(rideManager);
		this._parkDayManager = parkDayManager;
		this._rideCloserManager = rideCloserManager;
		
		this._parkDayManager.addUpdateListener(this);
		this._rideCloserManager.addUpdateListener(this);
		rideAdminManager.addUpdateListener(this);
	},
	
	// -------------------------------------------------------------------------
	// Page Members
	// -------------------------------------------------------------------------
	
	/**
	 * Get the distict page name. 
	 */
	 //public
	getName: function()
	{
		return CalendarView.NAME;
	},
	
	getHTML: function()
	{
		var html = 
			'<table cellspacing="5" border="1" align="center">' +
				'<tr>' +
					'<td>' + 
						this.getMonthHTML(this._month, this._year) +
					'</td>' + 
				'</tr>' +
			'</table>';
			
		html += 
			'<table cellspacing="5" border="1" align="center">' +
				'<tr VALIGN=TOP>' +
					'<td>' + 
						'<div id="editDate"> </div>' +
					'</td>' + 
					'<td>' + 
						'<div id="editRide"> </div>' +
					'</td>' + 
				'</tr>' +
				'<tr VALIGN=TOP>' +
					'<td colspan="2">' + 
						'<div id="permanentlyDeletedRides"> </div>' +
					'</td>' + 
				'</tr>' +
			'</table>';
			
		return html;
	},
	
	getMonthHTML: function(month, year)
	{
		var mn=['January','February','March','April','May','June','July','August','September','October','November','December'];
		var dim=[31,0,31,30,31,30,31,31,30,31,30,31];
		
		var oD = new Date(year, month-1, 1); //DD replaced line to fix date bug when current day is 31st
		oD.od=oD.getDay()+1; //DD replaced line to fix date bug when current day is 31st
		
		dim[1]=(((oD.getFullYear()%100!=0)&&(oD.getFullYear()%4==0))||(oD.getFullYear()%400==0))?29:28;
		
		var t = "";
		
		t += '<div id="calendar">' +
			'<table class="calendar" align="center" cols="7" cellpadding="0" border="1" cellspacing="0">' +
				'<tr align="center">'+
					'<td colspan="1">' +
						'<img src="'+ base_url + 'img/fastpassLeft.png">' +
					'</td>' +
					'<td colspan="5" align="center" class="month">'+
						mn[month-1]+' - '+ year +
					'</td>' +
					'<td colspan="1">' +
						'<img src="'+ base_url + 'img/fastpass.png">' +
					'</td>' +
				'</tr>' + 
				'<tr align="center">';
		
		for(s=0;s<7;s++)
		{
			t+='<td class="daysofweek">'+"SMTWTFS".substr(s,1)+'</td>';
		}
		
		t+='</tr><tr align="center">';
		
		for(i=1;i<=42;i++)
		{
			var x=((i-oD.od>=0)&&(i-oD.od<dim[month-1]))? i-oD.od+1 : '&nbsp;';
			
			if(x == '&nbsp;')
			{
				t+='<td></td>';
			}
			else
			{
				t += this._getDayHtml(x, month, year);
			}
			
			if(((i)%7==0)&&(i<36))
			{
				t+='</tr><tr align="center">';
			}
		}
		t+='</tr></table></div>';
		
		return t;
	},
	
	afterDisplayed: function()
	{
		$$("#calendar .dayclosed").each( function(day)
		{
			day.observe('click', function(event) 
			{
				var text = day.firstChild;
				
				this.editDay(text.textContent);
				
			}.bind(this));
		}.bind(this));
		
		$$("#calendar .dayNoInfo").each( function(day)
		{
			day.observe('click', function(event) 
			{
				var text = day.firstChild;
				
				this.editDay(text.textContent);
				
			}.bind(this));
		}.bind(this));
		
		$$("#calendar .dayHoursEntered").each( function(day)
		{
			day.observe('click', function(event) 
			{
				var text = day.firstChild;
				
				this.editDay(text.textContent);
				
			}.bind(this));
		}.bind(this));
		
		var imgs = $$("#calendar img");
		
		imgs[0].observe("click", function(event)
		{
			this.past();
		}.bind(this));
		
		imgs[1].observe("click", function(event)
		{
			this.future();
		}.bind(this));
		
		this._editDayView.showPage("editDate");
		this._editRideDataView.showPage("editRide");
		this._permanentlyDeletedRidesView.showPage("permanentlyDeletedRides");
	},
	
	editDay: function(day)
	{
		var parkDay = this._parkDayManager.getParkDay(day, 
			this._month, this._year);
		
		if(parkDay != null)
		{
			this._editDayView.setParkDay(parkDay);
		}
		else
		{
			this._editDayView.setDate(day, this._month, this._year);
		}
		
		this._editRideDataView.setDate(day, this._month, this._year);
	},
	
	past: function()
	{
		this._month--;
		
		if(this._month == 0)
		{
			this._month = 12;
			this._year--;
		}
		
		this._editRideDataView.setDate(1, this._month, this._year);
		
		CalendarControlSetCurrentMonth(this._month);
		CalendarControlSetCurrentYear(this._year);
		CalendarControlSetCurrentDay(1);
		
		this.refresh();
	},
	
	future: function()
	{
		this._month++;
		
		if(this._month > 12)
		{
			this._month = 1;
			this._year++;
		}
		
		this._editRideDataView.setDate(1, this._month, this._year);
		
		CalendarControlSetCurrentMonth(this._month);
		CalendarControlSetCurrentYear(this._year);
		CalendarControlSetCurrentDay(1);
		this.refresh();
	},
	
	_getDayHtml: function(day, month, year)
	{
		var html = "";
		
		var parkDay = this._parkDayManager.getParkDay(day, month, year);
		
		if(parkDay != null && parkDay.isClosed())
		{
			html += '<td class="dayclosed">'+ day +'<br /> closed ' + '</td>';
		}
		else if(parkDay != null)
		{
			html += '<td class="dayHoursEntered">'+ day +'<br /> ' + 
				'<span id="crowdLevel' + parkDay.getCrowdLevel() + '">' + 
				"CL - " + parkDay.getCrowdLevel() + '</span><br />' +
				parkDay.getOpenTimeHTML() + '<br />' +
				parkDay.getCloseTimeHTML();
				
			html += this._getRideCloserHtml(day, month, year);
			html += '</td>';
		}
		else// no information
		{
			html += '<td class="dayNoInfo">'+ day +'</td>';
		}
		
		return html;
	},
	
	_getRideCloserHtml: function(day, month, year)
	{
		var rides = this._rideCloserManager.getRidesThatAreClosed(
			day, month, year);
	
		var html = "";
		
		if(rides.length > 0)
		{
			html += '<br /><span id="closedRides">';
				
			rides.each(function(ride)
			{
				if(!ride.getClosedPermanently())
				{
					if(ride.getName().length < 13)
					{
						html += ride.getName() + "<br />";
					}
					else
					{
						html += ride.getName().substring(0, 13)  + "<br />";
					}
				}
			});
			
			html += "</span>";
		}
		
		return html;
	}
});

Object.extend(CalendarView, 
{
	NAME: "Calendar View",
});

/**
 * @author lancewf
 */
ParkDayManager = Class.create(
{
	initialize: function()
	{
		this._parkDays = new Array();
		this._ajaxTransport = new AjaxTransport();
		this._updateListeners = new Array();
			
		this.getParkDaysFromServer();
	},
	
	addParkDay: function(parkDayToAdd)
	{
		var matchingParkDay = this.getParkDay(parkDayToAdd.getDay(), 
			parkDayToAdd.getMonth(), parkDayToAdd.getYear());
			
		if(matchingParkDay != null)
		{
			matchingParkDay.cloneFrom(parkDayToAdd);
			matchingParkDay.setIsDirty(true);
		}
		else
		{
			this._parkDays.push(parkDayToAdd);
			parkDayToAdd.setIsDirty(true);
		}
		
		this.updateServer();
		this._notifyListeners();
	},
	
	addParkDays: function(parkDaysToAdd, setCrowdLevel, setHours)
	{
		parkDaysToAdd.each(function(parkDay)
		{
			var matchingParkDay = this.getParkDay(parkDay.getDay(), 
				parkDay.getMonth(), parkDay.getYear());
				
			if(matchingParkDay != null)
			{
				if(setCrowdLevel)
				{
					matchingParkDay.setCrowdLevel(parkDay.getCrowdLevel());
				}
				
				if(setHours)
				{
					matchingParkDay.setOpenTime(parkDay.getOpenHour(), 
						parkDay.getOpenMin());
						
					matchingParkDay.setCloseTime(parkDay.getCloseHour(), 
						parkDay.getCloseMin());
					matchingParkDay.setIsClosed(parkDay.isClosed());
				}
				
				matchingParkDay.setIsDirty(true);
			}
			else
			{
				this._parkDays.push(parkDay);
				parkDay.setIsDirty(true);
			}
		}.bind(this));
		
		this.updateServer();
		this._notifyListeners();
	},
	
	updateServer: function()
	{
		this._ajaxTransport.makeServerRequest(base_admin_url + 
			'updateParkDays', 'parkDays='+
                this.getServerUpdateString(), function(reponse)
        {
 			if(reponse == "success")
			{
				this._parkDays.each(function(parkDay)
				{
					parkDay.setIsDirty(false);
				});
			}
			else
			{
				alert("Error in updating server " + reponse);
			}
        }.bind(this));
	},
	
	/**
	 * Get the client modified itinary
	 * The string format to send to the server is
	 * [ride priority]-[ride id],[ride priority]-[ride id],....
	 */
	 //private
	getServerUpdateString: function()
	{
		var serverUpdateString = "";
		
		this._parkDays.each(function(parkDay)
		{
			if(parkDay.isDirty())
			{
				serverUpdateString +=  parkDay.getDay() + "-" + 
					parkDay.getMonth() + "-" + parkDay.getYear() +
	            	"-" + parkDay.isClosed() + "-" + parkDay.getOpenHour() + 
	            	"-" + parkDay.getOpenMin() + "-" + 
					parkDay.getCloseHour() + "-" + 
					parkDay.getCloseMin() + "-" + 
					parkDay.getCrowdLevel() + ",";
			}
		});
		
		serverUpdateString = serverUpdateString.substring(0, 
			serverUpdateString.length - 1);
		
		return serverUpdateString;
	},
	
	getParkDay: function(day, month, year)
	{
		var parkDayFound = null;
		this._parkDays.each(function(parkDay)
		{
			if(parkDay.isSameDate(day, month, year))
			{
				parkDayFound = parkDay;	
			}	
		});
		
		return parkDayFound;
	},
	
	/**
	 * Get the park days from the server
	 */
	//private
	getParkDaysFromServer: function()
	{
		this._ajaxTransport.makeServerRequest(base_admin_url + 
			'getParkDays', "", function(response)
        {
			if(response == "empty")
			{
				alert("No park days");
			}
        	else if(response)
        	{
	            this.parseResponse(response);
        	}
        	else
        	{
				alert("Server is not working correctly. Go get Lance: " + response);
        	}
			this._notifyListeners();
        }.bind(this)); 
	},
	
	/**
	 * Add an UpdateListener
	 * 
	 * The UpdateListener must implement the void refresh() method
	 */
	//public
	addUpdateListener : function(updateListener)
	{
		if(this._indexOfUpdateListener(updateListener) == -1)
		{
			this._updateListeners.push(updateListener);
		}
	},
	
	/**
	 * Get the index of the updateListener passed in
	 * 
	 * @param updateListener - the updateListener to find the index of
	 */
	//private
	_indexOfUpdateListener : function(updateListener)
	{
    	for(var index = 0; index < this._updateListeners.length; index++)
    	{
    		if(updateListener == this._updateListeners[index])
    		{
    			return index;
    		}
    	}
    	return -1;
	},
	
	/**
	 * Remove an update listener
	 */
	//public
	removeUpdateListener : function(updateListener)
	{
		var indexOf = this._indexOfUpdateListener(updateListener); 
		
		if(indexOf >= 0)
		{
			this._updateListeners.splice(indexOf, 1);
		}
	},
	
	/*
	 * Get the park days from the server to the client
	 * 
	 * The format that is day '-' month '-' year '-' is closed '-' 
	 * open hour '-' open minutes '-' close hour '-' close min
	 * 
	 * The park days are seperated by a comma ','
	 */
	parseResponse : function(response)
	{
        var parkDayDatas = response.split(",");

		for(var index = 0; index < parkDayDatas.length; index++)
		{
			var parkDayData = parkDayDatas[index];
			
            var pars = parkDayData.split("-");

            var day = pars[0];
            var month = pars[1];
            var year = pars[2];
            var isClosed = pars[3];
            var openHour = pars[4];
            var openMin = pars[5];
            var closeHour = pars[6];
            var closeMin = pars[7];
			var crowdLevel = pars[8];
			
			var parkDay = new ParkDay();
			
			parkDay.setDate(day, month, year);
			
			if(isClosed == "true")
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
			
			this._parkDays.push(parkDay);
        }
	},
	
	/**
	 * Notify all the listeners that the ride data has been changed. 
	 */
	//private
	_notifyListeners : function()
	{
		for(var index = 0; index < this._updateListeners.length; index++)
		{
			var listener = this._updateListeners[index];
			listener.refresh();
		}
	}
});

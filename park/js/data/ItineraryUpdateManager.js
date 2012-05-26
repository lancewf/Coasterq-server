/**
 * Manages collecting the itinerary ride data from the 
 * itinerary page and updating the server.
 * 
 * The Itinerary Page must contain tags
 * 
 * RideId - tag that holds the value of the rides id
 * Priority - tag that holds the rides current client priority
 * remove - tag that holds true if the ride was remove and false if not removed 
 * this is check box
 */
function ItineraryUpdateManager(itineraryRideManager) 
{
	// -------------------------------------------------------------------------
	// Static Variables
	// -------------------------------------------------------------------------
	
    //constances
    this._RIDE_ID_TAG = 'RideId';
    this._PRIORITY_TAG = 'Priority';
    this._REMOVE_TAG = 'remove';
    
    // -------------------------------------------------------------------------
	// Private variables and data
	// -------------------------------------------------------------------------
    
    this._itineraryRideManager = itineraryRideManager;

    // -------------------------------------------------------------------------
    // Public Members
    // -------------------------------------------------------------------------
    
    /**
     * Scan the Itinerary Ride page and collect the changes made the to 
     * the itinerary rides
     */
    // public
    this.updateItinerary = function ()
    {
        var ridesToRemove = new Array(); 
        var changedPriorityList = new Array();
        var notChangedPriorityList = new Array();
        
        this._collectDataFromPage(ridesToRemove, 
            changedPriorityList, notChangedPriorityList);
    
        var finialPrioritylisting = this._getNewSortedPriorityListing( 
             changedPriorityList, notChangedPriorityList);

        this._itineraryRideManager.updateItinerary(
            ridesToRemove, finialPrioritylisting);
   }

    // -------------------------------------------------------------------------
    // Private Members
    // -------------------------------------------------------------------------
	
	/**
	 * Collect the data from the itinerary ride view page. 
	 * 
	 * @param {Object} ridesToRemove
	 * @param {Object} changedPriorityList
	 * @param {Object} notChangedPriorityList
	 */
	//private
    this._collectDataFromPage = function(ridesToRemove, 
            changedPriorityList, notChangedPriorityList)
    {
        for(var index = 1; 
        	index <= itineraryRideManager.getItineraryRides().length; 
        	index++)
        {
            var rideId = document.getElementById(
            	this._RIDE_ID_TAG + index).value;

            if(this._doesRowNeedRemoved(index))
            {
                ridesToRemove.push(rideId);
            }
            else
            {
                var priority = document.getElementById(
                	this._PRIORITY_TAG + index).value;
                var itieraryRide = 
					this._itineraryRideManager.createItineraryRideFromRideId(
						rideId,  priority);
                
                if(this._hasPriorityChanged(index))
                {
                    changedPriorityList.push(itieraryRide);
                }
                else
                {
                    notChangedPriorityList.push(itieraryRide);
                }
            }
        }
    }
    
    //private
    this._getNewSortedPriorityListing = function( 
            changedPriorityList, notChangedPriorityList)
    {
        var finialPrioritylisting = new Array();

        changedPriorityList.sort(function(a,b)
        {
            return a.getPriority() - b.getPriority();
        }); 

        notChangedPriorityList.sort(function(a,b)
        {
            return a.getPriority() - b.getPriority();
        });

        var index = 1;
        while(true)
        {
            if(changedPriorityList.length == 0)
            {
                while(notChangedPriorityList.length > 0)
                {
                	var rideId  = notChangedPriorityList.shift().getRideId();
                	
					var newItineraryRide = 
						this._itineraryRideManager.createItineraryRideFromRideId(
						rideId, index);
						
                    finialPrioritylisting.push(newItineraryRide);
                    index++;
                }
                break;
            }
            if(notChangedPriorityList.length == 0)
            {
                while(changedPriorityList.length > 0)
                {
					var rideId = changedPriorityList.shift().getRideId();
					var newItineraryRide = 
						this._itineraryRideManager.createItineraryRideFromRideId(
						rideId, index);
					
                    finialPrioritylisting.push(newItineraryRide);
                    index++;
                }
                break;
            }
            
            if(index >= changedPriorityList[0].getPriority())
            {
				var rideId = changedPriorityList.shift().getRideId();
				var newItineraryRide = 
					this._itineraryRideManager.createItineraryRideFromRideId(
					rideId, index);
				
                finialPrioritylisting.push(newItineraryRide);
            }
            else
            {
				var rideId = notChangedPriorityList.shift().getRideId();
				var newItineraryRide = 
					this._itineraryRideManager.createItineraryRideFromRideId(
					rideId, index);
					
                finialPrioritylisting.push(newItineraryRide);
            }
            index++;
        }

        return finialPrioritylisting;
    }  
	
	//private
    this._hasPriorityChanged = function(row)
    {
        if( document.getElementById(this._PRIORITY_TAG + row).value != row)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
	//private
    this._doesRowNeedRemoved = function(row)
    {
        if(document.getElementById(this._REMOVE_TAG + row).checked)
        {
            return true;
        }
        else
        {
            return false;
        }
    } 
}

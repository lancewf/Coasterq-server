/**
 * @author lancewf
 */
function ParkOpenRange(openHour, openMin, closeHour, closeMin, day, month, year)
{
	this._day = day;
	this._month = month;
	this._year = year;
	this._openHour = openHour;
	this._openMin = openMin;
	this._closeHour = closeHour;
	this._closeMin = closeMin;
	
	this.isWithinRange = function(hour, min, day, month, year)
	{
		if(this._day == day && this._month == month && this._year == year)
		{
			
			if(hour > this._openHour && hour < this._closeHour)
			{
				return true;
			}
			else if(hour == this._openHour && min >= this._openMin && 
				this._openHour != this._closeHour)
			{
				return true;
			}
			else if(hour == this._closeHour && min <= this._closeMin && 
				this._openHour != this._closeHour)
			{
				return true;
			}
			else if(this._openHour == this._closeHour && hour == this._closeHour &&
				min >= this._openMin && min <= this._closeMin)
			{
				return true;
			}
		}

		return false;
	}
}
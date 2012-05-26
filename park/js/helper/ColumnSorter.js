/**
 * 
 * Warning: This class can only be used by browser that can use prototype
 */
ColumnSorter = Class.create(
{
	sortByIntInput: function(index, rows)
	{
		var sortedRows = rows.sortBy(function(row) 
		{ 
			value = row.childElements()[index];
			value = value.down('div').down('input').value;
			return parseInt(value);
	    });
	    
	    return sortedRows;
	},
	
	sortByWaitTime: function(index, rows)
	{
		var sortedRows = rows.sortBy(function(row) 
		{ 
			var value = row.childElements()[index].collectTextNodes(); 
			
			var hours = 0;
			value.scan(/[0-9]+ hr/, function(match)
			{
				var text = "" + match;
				text.scan(/[0-9]+/, function(hourMatch){hours = parseInt(hourMatch)});
			});
			
			var minutes = 0;
			value.scan(/[0-9]+ min/, function(match)
			{
				var text = "" + match;
				text.scan(/[0-9]+/, function(minMatch){minutes = parseInt(minMatch)});
			});
			
			var total = hours*60 + minutes;
			
			return total;
	    });
	    
	    return sortedRows;
	},
	
	sortByTimeOfDay: function(index, rows)
	{
		var sortedRows = rows.sortBy(function(row) 
		{ 
			var value = row.childElements()[index].collectTextNodes(); 
			
			var hour = 0;
			value.scan(/[0-9]+:/, function(match)
			{
				var text = "" + match;
				text.scan(/[0-9]+/, function(hourMatch)
				{hour = parseInt(hourMatch)});
			});
			
			var minutes = 0;
			value.scan(/:[0-9]+/, function(match)
			{
				var text = "" + match;
				text.scan(/[0-9]+/, function(minMatch)
				{minutes = parseInt(minMatch)});
			});
			
			if(hour == 12)
			{
				hour = 0;
			}
			if(value.indexOf('pm') >= 0)
			{
				hour += 12;
			}
			
			var total = hour*60 + minutes;
							
			return total;
	    });
	    
	    return sortedRows;
	},

	sortByText: function(index, rows)
	{
		var sortedRows = rows.sortBy(function(row) 
		{ 
			var value = row.childElements()[index].collectTextNodes(); 

			return value;
	    });
	    
	    return sortedRows;
	}
	
});

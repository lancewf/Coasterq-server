/**
 * This class handels all the ajax messages sent. 
 */
function AjaxTransport()
{
	//public
	this.makeServerRequest = function(url, params, returnTestFunction)
	{
		var xmlHttpReq = this._createRequest();
		
		xmlHttpReq.open('POST', url , true);
		
		xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		xmlHttpReq.setRequestHeader("Content-Length", params.length);

		xmlHttpReq.onreadystatechange = function() 
		{
			if (xmlHttpReq.readyState == 4) 
			{
				returnTestFunction(xmlHttpReq.responseText);
			}
		}
		
		xmlHttpReq.send(params);	
	}
	
	//private
	this._createRequest = function()
	{
        //Construct an XMLHTTP Object to handle our HTTP Request
        var xmlHttpReq = false;
        try
        {
            xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
        }   
        catch (err)
        {
            try
            {
                xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (err2)
            {
				xmlHttpReq = false;
            }
        }
		
		if(!xmlHttpReq && typeof XMLHttpRequest != 'undefined')
		{
				try
				{
					xmlHttpReq = new XMLHttpRequest();
				}
				catch (e)
				{
					xmlHttpReq = false;
				}
		}
		
		if(!xmlHttpReq && typeof XMLHttpRequest != 'undefined')
		{
				try
				{
					xmlHttpReq = window.createRequest();
				}
				catch (e)
				{
					xmlHttpReq = false;
				}
		}
		
		return xmlHttpReq;
	}
}
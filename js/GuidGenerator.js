/**
 * @author lancewf
 */
function BuildGuid()
{
	return (_S4()+_S4()+"-"+_S4()+"-"+_S4()+"-"+_S4()+"-"+_S4()+_S4()+_S4());
}

function _S4() 
{
   return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
}

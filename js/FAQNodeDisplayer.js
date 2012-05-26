function FAQNodeDisplayer(){this.getDisplayHTML=function(Va){var Wa="";if(Va.isLeaf()){Wa+="<div id='text'>"+Va.getName()+"</div><br />";}
else{Wa+="<A  HREF='faqs.html' onClick='clicked(\""+Va.getChildrenLink()+"\", \""+Va.getListener()+"\");"+" return false' ><h3>"+Va.getName()+"</h3></A>"+"<div id='"+Va.getChildrenLink()+"'></div><br />";}
return Wa;}}
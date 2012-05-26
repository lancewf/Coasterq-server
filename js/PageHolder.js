function PageHolder(ea){this._aa=ea;this._ba=new Array();this._ca=null;this._da=null;this.addPage=function(fa){fa.setPageHolder(this);this._ba.push(fa);}
this.getIndex=function(ga){var ha=function(n){return n.getName()==ga;};var ia=this._ba.indexOf(ha);return ia;}
this.getPage=function(ja){var ka=null;for(var la=0;la<this._ba.length;la++){if(this._ba[la].getName()==ja){ka=this._ba[la];}}
return ka;}
this.showPage=function(ma){var na=this.getPage(ma);if(na){if(na==this._ca){this._ca.exit();this._ca.showPage(this._aa,arguments);}
else{if(this._ca!=null){this._ca.exit();this._da=this._ca;}
this._ca=na;this._ca.showPage(this._aa,arguments);}}
else{}}
this.showPreviousPage=function(){if(this._da){this._ca.exit();this._ca=this._da;this._da.showPage(this._aa,arguments);}}
this.currentPageName=function(){this._ca.getName();}}
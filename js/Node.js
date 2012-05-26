function Node(){this._qa;this._ra=BuildGuid();this._sa;this._ta=new Array();this._ua=false;this._va=null;this._wa=null;this.addChild=function(xa){this._ta.push(xa);}
this.setName=function(ya){this._qa=ya;}
this.getName=function(){return this._qa;}
this.setIsLeaf=function(za){this._sa=za;}
this.isLeaf=function(){return this._sa;}
this.setChildLink=function(Aa){this._ra=Aa;}
this.getChildrenLink=function(){return this._ra;}
this.click=function(Ba){if(this.getChildrenLink()==Ba){if(this._ua){this.hideChildren();}
else{this.showChildren();}
return true;}
else{var Ca=false;if(this._ua){for(var Da=0;Da<this._ta.length;Da++){var Ea=this._ta[Da].click(Ba);if(!Ea){this._ta[Da].hideChildren();}
else{Ca=Ea;}}}
return Ca;}}
this.showChildren=function(){if(!this._ua){var Fa=this.getChildrenHTML();document.getElementById(this._ra).innerHTML=Fa;this._ua=true;}}
this.hideChildren=function(){if(this._ua){document.getElementById(this._ra).innerHTML="";this._ua=false;}}
this.setIsChildrenVisible=function(Ga){this._ua=Ga;}
this.setListener=function(Ha){this._va=Ha;}
this.getListener=function(){return this._va;}
this.setDisplayer=function(Ia){this._wa=Ia;}
this.getChildrenHTML=function(){var Ja="";for(var Ka=0;Ka<this._ta.length;Ka++){Ja+=this._wa.getDisplayHTML(this._ta[Ka]);}
return Ja;}}
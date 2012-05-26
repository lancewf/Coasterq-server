NodeTreeViewName="Node Tree View";function NodeTreeView(Ma){this._La=Ma.buildTree(NodeTreeViewName);this.getHTML=function(){this._La.setChildLink(this.replaceDiv);this._La.setIsChildrenVisible(true);var Na="<table align='center'><tr><td>"+this._La.getChildrenHTML()+"</td></tr></table>";return Na;}
this.setPageHolder=function(Oa){this.pageHolder=Oa;}
this.showPage=function(Pa){this.replaceDiv=Pa;var Qa=this.getHTML();document.getElementById(this.replaceDiv).innerHTML=Qa;this.afterDisplayed();}
this.exit=function(){}
this.toString=function(){return this.getName();}
this.getName=function(){return NodeTreeViewName;}
this.afterDisplayed=function(){}
this.clicked=function(Ra){this._La.click(Ra);}}
function clicked(Sa,Ta){var Ua=pageHolder.getPage(Ta);Ua.clicked(Sa);return false;}
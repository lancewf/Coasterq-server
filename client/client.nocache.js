function client(){var M='',nb='" for "gwt:onLoadErrorFn"',lb='" for "gwt:onPropertyErrorFn"',Y='"><\/script>',$='#',Lb='.cache.html',ab='/',Fb='106B25AC15F14803621238D963B300DF',Gb='4DE0F78CE3FBACD0E745368314F44DA3',Hb='8BD64DB060AB4E8CEF4AD2E7B4F6D48D',Ib='9F12113F498654099E50E96692A0F071',Ub='<script defer="defer">client.onInjectionDone(\'client\')<\/script>',X='<script id="',ib='=',_='?',Jb='B00C2E3DB97275D04EE591B145F764DF',kb='Bad handler "',Tb='DOMContentLoaded',Kb='F48C09AF880DDE0AC54A92822F1BABE5',Mb='GwtFacebook.css',Z='SCRIPT',W='__gwt_marker_client',bb='base',Q='begin',P='bootstrap',db='clear.cache.gif',N='client',hb='content',V='end',zb='gecko',Ab='gecko1_8',R='gwt.codesvr=',S='gwt.hosted=',T='gwt.hybrid',Sb='gwt/standard/standard.css',mb='gwt:onLoadErrorFn',jb='gwt:onPropertyErrorFn',gb='gwt:property',Rb='head',Db='hosted.html?client',Qb='href',yb='ie6',xb='ie8',ob='iframe',cb='img',pb="javascript:''",Nb='link',Cb='loadExternalRefs',eb='meta',rb='moduleRequested',U='moduleStartup',wb='msie',fb='name',tb='opera',qb='position:absolute;width:0;height:0;border:none',Ob='rel',vb='safari',Eb='selectingPermutation',O='startup',Pb='stylesheet',Bb='unknown',sb='user.agent',ub='webkit';var k=window,l=document,m=k.__gwtStatsEvent?function(a){return k.__gwtStatsEvent(a)}:null,n=k.__gwtStatsSessionId?k.__gwtStatsSessionId:null,o,p,q,r=M,s={},t=[],u=[],v=[],w,x;m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:P,millis:(new Date).getTime(),type:Q});if(!k.__gwt_stylesLoaded){k.__gwt_stylesLoaded={}}if(!k.__gwt_scriptsLoaded){k.__gwt_scriptsLoaded={}}function y(){var b=false;try{var c=k.location.search;return (c.indexOf(R)!=-1||(c.indexOf(S)!=-1||k.external&&k.external.gwtOnLoad))&&c.indexOf(T)==-1}catch(a){}y=function(){return b};return b}
function z(){if(o&&p){var b=l.getElementById(N);var c=b.contentWindow;if(y()){c.__gwt_getProperty=function(a){return F(a)}}client=null;c.gwtOnLoad(w,N,r);m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:U,millis:(new Date).getTime(),type:V})}}
function A(){var e,f=W,g;l.write(X+f+Y);g=l.getElementById(f);e=g&&g.previousSibling;while(e&&e.tagName!=Z){e=e.previousSibling}function h(a){var b=a.lastIndexOf($);if(b==-1){b=a.length}var c=a.indexOf(_);if(c==-1){c=a.length}var d=a.lastIndexOf(ab,Math.min(c,b));return d>=0?a.substring(0,d+1):M}
;if(e&&e.src){r=h(e.src)}if(r==M){var i=l.getElementsByTagName(bb);if(i.length>0){r=i[i.length-1].href}else{r=h(l.location.href)}}else if(r.match(/^\w+:\/\//)){}else{var j=l.createElement(cb);j.src=r+db;r=h(j.src)}if(g){g.parentNode.removeChild(g)}}
function B(){var b=document.getElementsByTagName(eb);for(var c=0,d=b.length;c<d;++c){var e=b[c],f=e.getAttribute(fb),g;if(f){if(f==gb){g=e.getAttribute(hb);if(g){var h,i=g.indexOf(ib);if(i>=0){f=g.substring(0,i);h=g.substring(i+1)}else{f=g;h=M}s[f]=h}}else if(f==jb){g=e.getAttribute(hb);if(g){try{x=eval(g)}catch(a){alert(kb+g+lb)}}}else if(f==mb){g=e.getAttribute(hb);if(g){try{w=eval(g)}catch(a){alert(kb+g+nb)}}}}}}
function E(a,b){var c=v;for(var d=0,e=a.length-1;d<e;++d){c=c[a[d]]||(c[a[d]]=[])}c[a[e]]=b}
function F(a){var b=u[a](),c=t[a];if(b in c){return b}var d=[];for(var e in c){d[c[e]]=e}if(x){x(a,d,b)}throw null}
var G;function H(){if(!G){G=true;var a=l.createElement(ob);a.src=pb;a.id=N;a.style.cssText=qb;a.tabIndex=-1;l.body.appendChild(a);m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:U,millis:(new Date).getTime(),type:rb});a.contentWindow.location.replace(r+J)}}
u[sb]=function(){var b=navigator.userAgent.toLowerCase();var c=function(a){return parseInt(a[1])*1000+parseInt(a[2])};if(b.indexOf(tb)!=-1){return tb}else if(b.indexOf(ub)!=-1){return vb}else if(b.indexOf(wb)!=-1){if(document.documentMode>=8){return xb}else{var d=/msie ([0-9]+)\.([0-9]+)/.exec(b);if(d&&d.length==3){var e=c(d);if(e>=6000){return yb}}}}else if(b.indexOf(zb)!=-1){var d=/rv:([0-9]+)\.([0-9]+)/.exec(b);if(d&&d.length==3){if(c(d)>=1008)return Ab}return zb}return Bb};t[sb]={gecko:0,gecko1_8:1,ie6:2,ie8:3,opera:4,safari:5};client.onScriptLoad=function(){if(G){p=true;z()}};client.onInjectionDone=function(){o=true;m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:Cb,millis:(new Date).getTime(),type:V});z()};A();var I;var J;if(y()){if(k.external&&(k.external.initModule&&k.external.initModule(N))){k.location.reload();return}J=Db;I=M}B();m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:P,millis:(new Date).getTime(),type:Eb});if(!y()){try{E([tb],Fb);E([Ab],Gb);E([xb],Hb);E([zb],Ib);E([yb],Jb);E([vb],Kb);I=v[F(sb)];J=I+Lb}catch(a){return}}var K;function L(){if(!q){q=true;if(!__gwt_stylesLoaded[Mb]){var a=l.createElement(Nb);__gwt_stylesLoaded[Mb]=a;a.setAttribute(Ob,Pb);a.setAttribute(Qb,r+Mb);l.getElementsByTagName(Rb)[0].appendChild(a)}if(!__gwt_stylesLoaded[Sb]){var a=l.createElement(Nb);__gwt_stylesLoaded[Sb]=a;a.setAttribute(Ob,Pb);a.setAttribute(Qb,r+Sb);l.getElementsByTagName(Rb)[0].appendChild(a)}z();if(l.removeEventListener){l.removeEventListener(Tb,L,false)}if(K){clearInterval(K)}}}
if(l.addEventListener){l.addEventListener(Tb,function(){H();L()},false)}var K=setInterval(function(){if(/loaded|complete/.test(l.readyState)){H();L()}},50);m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:P,millis:(new Date).getTime(),type:V});m&&m({moduleName:N,sessionId:n,subSystem:O,evtGroup:Cb,millis:(new Date).getTime(),type:Q});l.write(Ub)}
client();
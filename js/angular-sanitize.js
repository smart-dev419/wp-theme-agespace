!function(e,t,n){"use strict";function r(e){var n=[];return l(n,t.noop).chars(e),n.join("")}function i(e,n){var r,i={},a=e.split(",");for(r=0;r<a.length;r++)i[n?t.lowercase(a[r]):a[r]]=!0;return i}function a(e,t){null===e||e===n?e="":"string"!=typeof e&&(e=""+e),d.innerHTML=e;var r=5;do{if(0===r)throw u("uinput","Failed to sanitize html because the input is unstable");r--,document.documentMode<=11&&c(d),e=d.innerHTML,d.innerHTML=e}while(e!==d.innerHTML);for(var i=d.firstChild;i;){switch(i.nodeType){case 1:t.start(i.nodeName.toLowerCase(),o(i.attributes));break;case 3:t.chars(i.textContent)}var a;if(!((a=i.firstChild)||(1==i.nodeType&&t.end(i.nodeName.toLowerCase()),a=i.nextSibling)))for(;null==a&&(i=i.parentNode)!==d;)a=i.nextSibling,1==i.nodeType&&t.end(i.nodeName.toLowerCase());i=a}for(;i=d.firstChild;)d.removeChild(i)}function o(e){for(var t={},n=0,r=e.length;n<r;n++){var i=e[n];t[i.name]=i.value}return t}function s(e){return e.replace(/&/g,"&amp;").replace(h,function(e){return"&#"+(1024*(e.charCodeAt(0)-55296)+(e.charCodeAt(1)-56320)+65536)+";"}).replace(p,function(e){return"&#"+e.charCodeAt(0)+";"}).replace(/</g,"&lt;").replace(/>/g,"&gt;")}function l(e,n){var r=!1,i=t.bind(e,e.push);return{start:function(e,a){e=t.lowercase(e),!r&&k[e]&&(r=e),r||!0!==w[e]||(i("<"),i(e),t.forEach(a,function(r,a){var o=t.lowercase(a),l="img"===e&&"src"===o||"background"===o;!0!==L[o]||!0===C[o]&&!n(r,l)||(i(" "),i(a),i('="'),i(s(r)),i('"'))}),i(">"))},end:function(e){e=t.lowercase(e),r||!0!==w[e]||!0===f[e]||(i("</"),i(e),i(">")),e==r&&(r=!1)},chars:function(e){r||i(s(e))}}}function c(e){if(e.nodeType===Node.ELEMENT_NODE)for(var t=e.attributes,n=0,r=t.length;n<r;n++){var i=t[n],a=i.name.toLowerCase();"xmlns:ns1"!==a&&0!==a.indexOf("ns1:")||(e.removeAttributeNode(i),n--,r--)}var o=e.firstChild;o&&c(o),(o=e.nextSibling)&&c(o)}var d,u=t.$$minErr("$sanitize"),h=/[\uD800-\uDBFF][\uDC00-\uDFFF]/g,p=/([^\#-~ |!])/g,f=i("area,br,col,hr,img,wbr"),m=i("colgroup,dd,dt,li,p,tbody,td,tfoot,th,thead,tr"),g=i("rp,rt"),b=t.extend({},g,m),v=t.extend({},m,i("address,article,aside,blockquote,caption,center,del,dir,div,dl,figure,figcaption,footer,h1,h2,h3,h4,h5,h6,header,hgroup,hr,ins,map,menu,nav,ol,pre,section,table,ul")),x=t.extend({},g,i("a,abbr,acronym,b,bdi,bdo,big,br,cite,code,del,dfn,em,font,i,img,ins,kbd,label,map,mark,q,ruby,rp,rt,s,samp,small,span,strike,strong,sub,sup,time,tt,u,var")),y=i("circle,defs,desc,ellipse,font-face,font-face-name,font-face-src,g,glyph,hkern,image,linearGradient,line,marker,metadata,missing-glyph,mpath,path,polygon,polyline,radialGradient,rect,stop,svg,switch,text,title,tspan"),k=i("script,style"),w=t.extend({},f,v,x,b),C=i("background,cite,href,longdesc,src,xlink:href"),E=i("abbr,align,alt,axis,bgcolor,border,cellpadding,cellspacing,class,clear,color,cols,colspan,compact,coords,dir,face,headers,height,hreflang,hspace,ismap,lang,language,nohref,nowrap,rel,rev,rows,rowspan,rules,scope,scrolling,shape,size,span,start,summary,tabindex,target,title,type,valign,value,vspace,width"),z=i("accent-height,accumulate,additive,alphabetic,arabic-form,ascent,baseProfile,bbox,begin,by,calcMode,cap-height,class,color,color-rendering,content,cx,cy,d,dx,dy,descent,display,dur,end,fill,fill-rule,font-family,font-size,font-stretch,font-style,font-variant,font-weight,from,fx,fy,g1,g2,glyph-name,gradientUnits,hanging,height,horiz-adv-x,horiz-origin-x,ideographic,k,keyPoints,keySplines,keyTimes,lang,marker-end,marker-mid,marker-start,markerHeight,markerUnits,markerWidth,mathematical,max,min,offset,opacity,orient,origin,overline-position,overline-thickness,panose-1,path,pathLength,points,preserveAspectRatio,r,refX,refY,repeatCount,repeatDur,requiredExtensions,requiredFeatures,restart,rotate,rx,ry,slope,stemh,stemv,stop-color,stop-opacity,strikethrough-position,strikethrough-thickness,stroke,stroke-dasharray,stroke-dashoffset,stroke-linecap,stroke-linejoin,stroke-miterlimit,stroke-opacity,stroke-width,systemLanguage,target,text-anchor,to,transform,type,u1,u2,underline-position,underline-thickness,unicode,unicode-range,units-per-em,values,version,viewBox,visibility,width,widths,x,x-height,x1,x2,xlink:actuate,xlink:arcrole,xlink:role,xlink:show,xlink:title,xlink:type,xml:base,xml:lang,xml:space,xmlns,xmlns:xlink,y,y1,y2,zoomAndPan",!0),L=t.extend({},C,z,E);!function(e){var t;if(!e.document||!e.document.implementation)throw u("noinert","Can't create an inert html document");var n=((t=e.document.implementation.createHTMLDocument("inert")).documentElement||t.getDocumentElement()).getElementsByTagName("body");if(1===n.length)d=n[0];else{var r=t.createElement("html");d=t.createElement("body"),r.appendChild(d),t.appendChild(r)}}(e),t.module("ngSanitize",[]).provider("$sanitize",function(){var e=!1;this.$get=["$$sanitizeUri",function(n){return e&&t.extend(w,y),function(e){var t=[];return a(e,l(t,function(e,t){return!/^unsafe:/.test(n(e,t))})),t.join("")}}],this.enableSvg=function(n){return t.isDefined(n)?(e=n,this):e}}),t.module("ngSanitize").filter("linky",["$sanitize",function(e){var n=/((ftp|https?):\/\/|(www\.)|(mailto:)?[A-Za-z0-9._%+-]+@)\S*[^\s.;,(){}<>"\u201d\u2019]/i,i=/^mailto:/i,a=t.$$minErr("linky"),o=t.isString;return function(s,l,c){function d(e){e&&m.push(r(e))}if(null==s||""===s)return s;if(!o(s))throw a("notstring","Expected string but received: {0}",s);for(var u,h,p,f=s,m=[];u=f.match(n);)h=u[0],u[2]||u[4]||(h=(u[3]?"http://":"mailto:")+h),p=u.index,d(f.substr(0,p)),function(e,n){var r;if(m.push("<a "),t.isFunction(c)&&(c=c(e)),t.isObject(c))for(r in c)m.push(r+'="'+c[r]+'" ');else c={};!t.isDefined(l)||"target"in c||m.push('target="',l,'" '),m.push('href="',e.replace(/"/g,"&quot;"),'">'),d(n),m.push("</a>")}(h,u[0].replace(i,"")),f=f.substring(p+u[0].length);return d(f),e(m.join(""))}}])}(window,window.angular);
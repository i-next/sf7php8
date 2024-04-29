/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/tool/color.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var e=function(e){this.value=e},r=function(){function r(){this._len=0}return r.prototype.insert=function(r){var t=new e(r);return this.insertEntry(t),t},r.prototype.insertEntry=function(e){this.head?(this.tail.next=e,e.prev=this.tail,e.next=null,this.tail=e):this.head=this.tail=e,this._len++},r.prototype.remove=function(e){var r=e.prev,t=e.next;r?r.next=t:this.head=t,t?t.prev=r:this.tail=r,e.next=e.prev=null,this._len--},r.prototype.len=function(){return this._len},r.prototype.clear=function(){this.head=this.tail=null,this._len=0},r}(),t=function(){function t(e){this._list=new r,this._maxSize=10,this._map={},this._maxSize=e}return t.prototype.put=function(r,t){var n=this._list,a=this._map,i=null;if(null==a[r]){var l=n.len(),o=this._lastRemovedEntry;if(l>=this._maxSize&&l>0){var u=n.head;n.remove(u),delete a[u.key],i=u.value,this._lastRemovedEntry=u}o?o.value=t:o=new e(t),o.key=r,n.insertEntry(o),a[r]=o}return i},t.prototype.get=function(e){var r=this._map[e],t=this._list;if(null!=r)return r!==t.tail&&(t.remove(r),t.insertEntry(r)),r.value},t.prototype.clear=function(){this._list.clear(),this._map={}},t.prototype.len=function(){return this._list.len()},t}();!function(e){var r={};if("undefined"==typeof JSON)return r;for(var t=0;t<e.length;t++){var n=String.fromCharCode(t+32),a=(e.charCodeAt(t)-20)/100;r[n]=a}}("007LLmW'55;N0500LLLLLLLLLL00NNNLzWW\\\\WQb\\0FWLg\\bWb\\WQ\\WrWWQ000CL5LLFLL0LL**F*gLLLL5F0LF\\FFF5.5N"),h(["Function","RegExp","Date","Error","CanvasGradient","CanvasPattern","Image","Canvas"],(function(e,r){return e["[object "+r+"]"]=!0,e}),{}),h(["Int8","Uint8","Uint8Clamped","Int16","Uint16","Int32","Uint32","Float32","Float64"],(function(e,r){return e["[object "+r+"Array]"]=!0,e}),{});var n=Array.prototype,a=n.slice,i=n.map,l=function(){}.constructor,o=l?l.prototype:null,u="__proto__";function s(e,r,t){if(!e)return[];if(!r)return function(e){for(var r=[],t=1;t<arguments.length;t++)r[t-1]=arguments[t];return a.apply(e,r)}(e);if(e.map&&e.map===i)return e.map(r,t);for(var n=[],l=0,o=e.length;l<o;l++)n.push(r.call(t,e[l],l,e));return n}function h(e,r,t,n){if(e&&r){for(var a=0,i=e.length;a<i;a++)t=r.call(n,t,e[a],a,e);return t}}o&&"function"==typeof o.bind&&o.call.bind(o.bind);var c={transparent:[0,0,0,0],aliceblue:[240,248,255,1],antiquewhite:[250,235,215,1],aqua:[0,255,255,1],aquamarine:[127,255,212,1],azure:[240,255,255,1],beige:[245,245,220,1],bisque:[255,228,196,1],black:[0,0,0,1],blanchedalmond:[255,235,205,1],blue:[0,0,255,1],blueviolet:[138,43,226,1],brown:[165,42,42,1],burlywood:[222,184,135,1],cadetblue:[95,158,160,1],chartreuse:[127,255,0,1],chocolate:[210,105,30,1],coral:[255,127,80,1],cornflowerblue:[100,149,237,1],cornsilk:[255,248,220,1],crimson:[220,20,60,1],cyan:[0,255,255,1],darkblue:[0,0,139,1],darkcyan:[0,139,139,1],darkgoldenrod:[184,134,11,1],darkgray:[169,169,169,1],darkgreen:[0,100,0,1],darkgrey:[169,169,169,1],darkkhaki:[189,183,107,1],darkmagenta:[139,0,139,1],darkolivegreen:[85,107,47,1],darkorange:[255,140,0,1],darkorchid:[153,50,204,1],darkred:[139,0,0,1],darksalmon:[233,150,122,1],darkseagreen:[143,188,143,1],darkslateblue:[72,61,139,1],darkslategray:[47,79,79,1],darkslategrey:[47,79,79,1],darkturquoise:[0,206,209,1],darkviolet:[148,0,211,1],deeppink:[255,20,147,1],deepskyblue:[0,191,255,1],dimgray:[105,105,105,1],dimgrey:[105,105,105,1],dodgerblue:[30,144,255,1],firebrick:[178,34,34,1],floralwhite:[255,250,240,1],forestgreen:[34,139,34,1],fuchsia:[255,0,255,1],gainsboro:[220,220,220,1],ghostwhite:[248,248,255,1],gold:[255,215,0,1],goldenrod:[218,165,32,1],gray:[128,128,128,1],green:[0,128,0,1],greenyellow:[173,255,47,1],grey:[128,128,128,1],honeydew:[240,255,240,1],hotpink:[255,105,180,1],indianred:[205,92,92,1],indigo:[75,0,130,1],ivory:[255,255,240,1],khaki:[240,230,140,1],lavender:[230,230,250,1],lavenderblush:[255,240,245,1],lawngreen:[124,252,0,1],lemonchiffon:[255,250,205,1],lightblue:[173,216,230,1],lightcoral:[240,128,128,1],lightcyan:[224,255,255,1],lightgoldenrodyellow:[250,250,210,1],lightgray:[211,211,211,1],lightgreen:[144,238,144,1],lightgrey:[211,211,211,1],lightpink:[255,182,193,1],lightsalmon:[255,160,122,1],lightseagreen:[32,178,170,1],lightskyblue:[135,206,250,1],lightslategray:[119,136,153,1],lightslategrey:[119,136,153,1],lightsteelblue:[176,196,222,1],lightyellow:[255,255,224,1],lime:[0,255,0,1],limegreen:[50,205,50,1],linen:[250,240,230,1],magenta:[255,0,255,1],maroon:[128,0,0,1],mediumaquamarine:[102,205,170,1],mediumblue:[0,0,205,1],mediumorchid:[186,85,211,1],mediumpurple:[147,112,219,1],mediumseagreen:[60,179,113,1],mediumslateblue:[123,104,238,1],mediumspringgreen:[0,250,154,1],mediumturquoise:[72,209,204,1],mediumvioletred:[199,21,133,1],midnightblue:[25,25,112,1],mintcream:[245,255,250,1],mistyrose:[255,228,225,1],moccasin:[255,228,181,1],navajowhite:[255,222,173,1],navy:[0,0,128,1],oldlace:[253,245,230,1],olive:[128,128,0,1],olivedrab:[107,142,35,1],orange:[255,165,0,1],orangered:[255,69,0,1],orchid:[218,112,214,1],palegoldenrod:[238,232,170,1],palegreen:[152,251,152,1],paleturquoise:[175,238,238,1],palevioletred:[219,112,147,1],papayawhip:[255,239,213,1],peachpuff:[255,218,185,1],peru:[205,133,63,1],pink:[255,192,203,1],plum:[221,160,221,1],powderblue:[176,224,230,1],purple:[128,0,128,1],red:[255,0,0,1],rosybrown:[188,143,143,1],royalblue:[65,105,225,1],saddlebrown:[139,69,19,1],salmon:[250,128,114,1],sandybrown:[244,164,96,1],seagreen:[46,139,87,1],seashell:[255,245,238,1],sienna:[160,82,45,1],silver:[192,192,192,1],skyblue:[135,206,235,1],slateblue:[106,90,205,1],slategray:[112,128,144,1],slategrey:[112,128,144,1],snow:[255,250,250,1],springgreen:[0,255,127,1],steelblue:[70,130,180,1],tan:[210,180,140,1],teal:[0,128,128,1],thistle:[216,191,216,1],tomato:[255,99,71,1],turquoise:[64,224,208,1],violet:[238,130,238,1],wheat:[245,222,179,1],white:[255,255,255,1],whitesmoke:[245,245,245,1],yellow:[255,255,0,1],yellowgreen:[154,205,50,1]};function g(e){return(e=Math.round(e))<0?0:e>255?255:e}function d(e){return e<0?0:e>1?1:e}function f(e){var r=e;return r.length&&"%"===r.charAt(r.length-1)?g(parseFloat(r)/100*255):g(parseInt(r,10))}function p(e){var r=e;return r.length&&"%"===r.charAt(r.length-1)?d(parseFloat(r)/100):d(parseFloat(r))}function v(e,r,t){return t<0?t+=1:t>1&&(t-=1),6*t<1?e+(r-e)*t*6:2*t<1?r:3*t<2?e+(r-e)*(2/3-t)*6:e}function m(e,r,t){return e+(r-e)*t}function y(e,r,t,n,a){return e[0]=r,e[1]=t,e[2]=n,e[3]=a,e}function b(e,r){return e[0]=r[0],e[1]=r[1],e[2]=r[2],e[3]=r[3],e}var k=new t(20),w=null;function L(e,r){w&&b(w,r),w=k.put(e,w||r.slice())}function _(e,r){if(e){r=r||[];var t=k.get(e);if(t)return b(r,t);var n=(e+="").replace(/ /g,"").toLowerCase();if(n in c)return b(r,c[n]),L(e,r),r;var a,i=n.length;if("#"===n.charAt(0))return 4===i||5===i?(a=parseInt(n.slice(1,4),16))>=0&&a<=4095?(y(r,(3840&a)>>4|(3840&a)>>8,240&a|(240&a)>>4,15&a|(15&a)<<4,5===i?parseInt(n.slice(4),16)/15:1),L(e,r),r):void y(r,0,0,0,1):7===i||9===i?(a=parseInt(n.slice(1,7),16))>=0&&a<=16777215?(y(r,(16711680&a)>>16,(65280&a)>>8,255&a,9===i?parseInt(n.slice(7),16)/255:1),L(e,r),r):void y(r,0,0,0,1):void 0;var l=n.indexOf("("),o=n.indexOf(")");if(-1!==l&&o+1===i){var u=n.substr(0,l),s=n.substr(l+1,o-(l+1)).split(","),h=1;switch(u){case"rgba":if(4!==s.length)return 3===s.length?y(r,+s[0],+s[1],+s[2],1):y(r,0,0,0,1);h=p(s.pop());case"rgb":return s.length>=3?(y(r,f(s[0]),f(s[1]),f(s[2]),3===s.length?h:p(s[3])),L(e,r),r):void y(r,0,0,0,1);case"hsla":return 4!==s.length?void y(r,0,0,0,1):(s[3]=p(s[3]),x(s,r),L(e,r),r);case"hsl":return 3!==s.length?void y(r,0,0,0,1):(x(s,r),L(e,r),r);default:return}}y(r,0,0,0,1)}}function x(e,r){var t=(parseFloat(e[0])%360+360)%360/360,n=p(e[1]),a=p(e[2]),i=a<=.5?a*(n+1):a+n-a*n,l=2*a-i;return y(r=r||[],g(255*v(l,i,t+1/3)),g(255*v(l,i,t)),g(255*v(l,i,t-1/3)),1),4===e.length&&(r[3]=e[3]),r}function F(e,r){var t=_(e);if(t){for(var n=0;n<3;n++)t[n]=r<0?t[n]*(1-r)|0:(255-t[n])*r+t[n]|0,t[n]>255?t[n]=255:t[n]<0&&(t[n]=0);return A(t,4===t.length?"rgba":"rgb")}}function M(e){var r=_(e);if(r)return((1<<24)+(r[0]<<16)+(r[1]<<8)+ +r[2]).toString(16).slice(1)}function I(e,r,t){if(r&&r.length&&e>=0&&e<=1){t=t||[];var n=e*(r.length-1),a=Math.floor(n),i=Math.ceil(n),l=r[a],o=r[i],u=n-a;return t[0]=g(m(l[0],o[0],u)),t[1]=g(m(l[1],o[1],u)),t[2]=g(m(l[2],o[2],u)),t[3]=d(m(l[3],o[3],u)),t}}var W=I;function q(e,r,t){if(r&&r.length&&e>=0&&e<=1){var n=e*(r.length-1),a=Math.floor(n),i=Math.ceil(n),l=_(r[a]),o=_(r[i]),u=n-a,s=A([g(m(l[0],o[0],u)),g(m(l[1],o[1],u)),g(m(l[2],o[2],u)),d(m(l[3],o[3],u))],"rgba");return t?{color:s,leftIndex:a,rightIndex:i,value:n}:s}}var C=q;function S(e,r,t,n){var a,i=_(e);if(e)return i=function(e){if(e){var r,t,n=e[0]/255,a=e[1]/255,i=e[2]/255,l=Math.min(n,a,i),o=Math.max(n,a,i),u=o-l,s=(o+l)/2;if(0===u)r=0,t=0;else{t=s<.5?u/(o+l):u/(2-o-l);var h=((o-n)/6+u/2)/u,c=((o-a)/6+u/2)/u,g=((o-i)/6+u/2)/u;n===o?r=g-c:a===o?r=1/3+h-g:i===o&&(r=2/3+c-h),r<0&&(r+=1),r>1&&(r-=1)}var d=[360*r,t,s];return null!=e[3]&&d.push(e[3]),d}}(i),null!=r&&(i[0]=(a=r,(a=Math.round(a))<0?0:a>360?360:a)),null!=t&&(i[1]=p(t)),null!=n&&(i[2]=p(n)),A(x(i),"rgba")}function E(e,r){var t=_(e);if(t&&null!=r)return t[3]=d(r),A(t,"rgba")}function A(e,r){if(e&&e.length){var t=e[0]+","+e[1]+","+e[2];return"rgba"!==r&&"hsva"!==r&&"hsla"!==r||(t+=","+e[3]),r+"("+t+")"}}function N(e,r){var t=_(e);return t?(.299*t[0]+.587*t[1]+.114*t[2])*t[3]/255+(1-t[3])*r:0}function O(){return A([Math.round(255*Math.random()),Math.round(255*Math.random()),Math.round(255*Math.random())],"rgb")}var j=new t(100);function z(e){if(function(e){return"string"==typeof e}(e)){var r=j.get(e);return r||(r=F(e,-.1),j.put(e,r)),r}if(function(e){return null!=e.colorStops}(e)){var t=function(e,r){if(Object.assign)Object.assign(e,r);else for(var t in r)r.hasOwnProperty(t)&&t!==u&&(e[t]=r[t]);return e}({},e);return t.colorStops=s(e.colorStops,(function(e){return{offset:e.offset,color:F(e.color,-.1)}})),t}return e}export{I as fastLerp,W as fastMapToColor,q as lerp,F as lift,z as liftColor,N as lum,C as mapToColor,E as modifyAlpha,S as modifyHSL,_ as parse,O as random,A as stringify,M as toHex};export default null;
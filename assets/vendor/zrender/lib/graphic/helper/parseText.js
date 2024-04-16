/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/graphic/helper/parseText.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var t=function(t){this.value=t},n=function(){function n(){this._len=0}return n.prototype.insert=function(n){var e=new t(n);return this.insertEntry(e),e},n.prototype.insertEntry=function(t){this.head?(this.tail.next=t,t.prev=this.tail,t.next=null,this.tail=t):this.head=this.tail=t,this._len++},n.prototype.remove=function(t){var n=t.prev,e=t.next;n?n.next=e:this.head=e,e?e.prev=n:this.tail=n,t.next=t.prev=null,this._len--},n.prototype.len=function(){return this._len},n.prototype.clear=function(){this.head=this.tail=null,this._len=0},n}(),e=function(){function e(t){this._list=new n,this._maxSize=10,this._map={},this._maxSize=t}return e.prototype.put=function(n,e){var i=this._list,r=this._map,a=null;if(null==r[n]){var l=i.len(),h=this._lastRemovedEntry;if(l>=this._maxSize&&l>0){var o=i.head;i.remove(o),delete r[o.key],a=o.value,this._lastRemovedEntry=o}h?h.value=e:h=new t(e),h.key=n,i.insertEntry(h),r[n]=h}return a},e.prototype.get=function(t){var n=this._map[t],e=this._list;if(null!=n)return n!==e.tail&&(e.remove(n),e.insertEntry(n)),n.value},e.prototype.clear=function(){this._list.clear(),this._map={}},e.prototype.len=function(){return this._list.len()},e}(),i="12px sans-serif";var r,a,l=function(t){var n={};if("undefined"==typeof JSON)return n;for(var e=0;e<t.length;e++){var i=String.fromCharCode(e+32),r=(t.charCodeAt(e)-20)/100;n[i]=r}return n}("007LLmW'55;N0500LLLLLLLLLL00NNNLzWW\\\\WQb\\0FWLg\\bWb\\WQ\\WrWWQ000CL5LLFLL0LL**F*gLLLL5F0LF\\FFF5.5N"),h={createCanvas:function(){return"undefined"!=typeof document&&document.createElement("canvas")},measureText:function(t,n){if(!r){var e=h.createCanvas();r=e&&e.getContext("2d")}if(r)return a!==n&&(a=r.font=n||i),r.measureText(t);t=t||"";var o=/(\d+)px/.exec(n=n||i),u=o&&+o[1]||12,s=0;if(n.indexOf("mono")>=0)s=u*t.length;else for(var c=0;c<t.length;c++){var d=l[t[c]];s+=null==d?u:d*u}return{width:s}},loadImage:function(t,n,e){var i=new Image;return i.onload=n,i.onerror=e,i.src=t,i}},o=new e(50);function u(t){if("string"==typeof t){var n=o.get(t);return n&&n.image}return t}f(["Function","RegExp","Date","Error","CanvasGradient","CanvasPattern","Image","Canvas"],(function(t,n){return t["[object "+n+"]"]=!0,t}),{}),f(["Int8","Uint8","Uint8Clamped","Int16","Uint16","Int32","Uint32","Float32","Float64"],(function(t,n){return t["[object "+n+"Array]"]=!0,t}),{});Array.prototype.slice;var s=function(){}.constructor,c=s?s.prototype:null,d="__proto__";function f(t,n,e,i){if(t&&n){for(var r=0,a=t.length;r<a;r++)e=n.call(i,e,t[r],r,t);return e}}function v(t,n){return null!=t?t:n}c&&"function"==typeof c.bind&&c.call.bind(c.bind);var p={};function g(t,n){var r=p[n=n||i];r||(r=p[n]=new e(500));var a=r.get(t);return null==a&&(a=h.measureText(t,n).width,r.put(t,a)),a}function m(t){return g("国",t)}var w=/\{([a-zA-Z0-9_]+)\|([^}]*)\}/g;function W(t,n,e,i,r){if(!n)return"";var a=(t+"").split("\n");r=x(n,e,i,r);for(var l=0,h=a.length;l<h;l++)a[l]=y(a[l],r);return a.join("\n")}function x(t,n,e,i){var r=function(t,n){if(Object.assign)Object.assign(t,n);else for(var e in n)n.hasOwnProperty(e)&&e!==d&&(t[e]=n[e]);return t}({},i=i||{});r.font=n,e=v(e,"..."),r.maxIterations=v(i.maxIterations,2);var a=r.minChar=v(i.minChar,0);r.cnCharWidth=g("国",n);var l=r.ascCharWidth=g("a",n);r.placeholder=v(i.placeholder,"");for(var h=t=Math.max(0,t-1),o=0;o<a&&h>=l;o++)h-=l;var u=g(e,n);return u>h&&(e="",u=0),h=t-u,r.ellipsis=e,r.ellipsisWidth=u,r.contentWidth=h,r.containerWidth=t,r}function y(t,n){var e=n.containerWidth,i=n.font,r=n.contentWidth;if(!e)return"";var a=g(t,i);if(a<=e)return t;for(var l=0;;l++){if(a<=r||l>=n.maxIterations){t+=n.ellipsis;break}var h=0===l?L(t,r,n.ascCharWidth,n.cnCharWidth):a>0?Math.floor(t.length*r/a):0;a=g(t=t.substr(0,h),i)}return""===t&&(t=n.placeholder),t}function L(t,n,e,i){for(var r=0,a=0,l=t.length;a<l&&r<n;a++){var h=t.charCodeAt(a);r+=0<=h&&h<=127?e:i}return a}function b(t,n){null!=t&&(t+="");var e,i=n.overflow,r=n.padding,a=n.font,l="truncate"===i,h=m(a),o=v(n.lineHeight,h),u=!!n.backgroundColor,s="truncate"===n.lineOverflow,c=n.width,d=(e=null==c||"break"!==i&&"breakAll"!==i?t?t.split("\n"):[]:t?E(t,n.font,c,"breakAll"===i,0).lines:[]).length*o,f=v(n.height,d);if(d>f&&s){var p=Math.floor(f/o);e=e.slice(0,p)}if(t&&l&&null!=c)for(var w=x(c,a,n.ellipsis,{minChar:n.truncateMinChar,placeholder:n.placeholder}),W=0;W<e.length;W++)e[W]=y(e[W],w);var L=f,b=0;for(W=0;W<e.length;W++)b=Math.max(g(e[W],a),b);null==c&&(c=b);var C=b;return r&&(L+=r[0]+r[2],C+=r[1]+r[3],c+=r[1]+r[3]),u&&(C=c),{lines:e,height:f,outerWidth:C,outerHeight:L,lineHeight:o,calculatedLineHeight:h,contentWidth:b,contentHeight:d,width:c}}var C=function(){},_=function(t){this.tokens=[],t&&(this.tokens=t)},k=function(){this.width=0,this.height=0,this.contentWidth=0,this.contentHeight=0,this.outerWidth=0,this.outerHeight=0,this.lines=[]};function H(t,n){var e=new k;if(null!=t&&(t+=""),!t)return e;for(var i,r=n.width,a=n.height,l=n.overflow,h="break"!==l&&"breakAll"!==l||null==r?null:{width:r,accumWidth:0,breakAll:"breakAll"===l},o=w.lastIndex=0;null!=(i=w.exec(t));){var s=i.index;s>o&&A(e,t.substring(o,s),n,h),A(e,i[2],n,h,i[1]),o=w.lastIndex}o<t.length&&A(e,t.substring(o,t.length),n,h);var c,d,f,p,x=[],y=0,L=0,b=n.padding,C="truncate"===l,_="truncate"===n.lineOverflow;function H(t,n,e){t.width=n,t.lineHeight=e,y+=e,L=Math.max(L,n)}t:for(var F=0;F<e.lines.length;F++){for(var I=e.lines[F],E=0,M=0,N=0;N<I.tokens.length;N++){var O=(G=I.tokens[N]).styleName&&n.rich[G.styleName]||{},j=G.textPadding=O.padding,z=j?j[1]+j[3]:0,S=G.font=O.font||n.font;G.contentHeight=m(S);var U=v(O.height,G.contentHeight);if(G.innerHeight=U,j&&(U+=j[0]+j[2]),G.height=U,G.lineHeight=(d=O.lineHeight,f=n.lineHeight,p=U,null!=d?d:null!=f?f:p),G.align=O&&O.align||n.align,G.verticalAlign=O&&O.verticalAlign||"middle",_&&null!=a&&y+G.lineHeight>a){N>0?(I.tokens=I.tokens.slice(0,N),H(I,M,E),e.lines=e.lines.slice(0,F+1)):e.lines=e.lines.slice(0,F);break t}var P=O.width,Q=null==P||"auto"===P;if("string"==typeof P&&"%"===P.charAt(P.length-1))G.percentWidth=P,x.push(G),G.contentWidth=g(G.text,S);else{if(Q){var R=O.backgroundColor,T=R&&R.image;T&&(T=u(T),(c=T)&&c.width&&c.height&&(G.width=Math.max(G.width,T.width*U/T.height)))}var D=C&&null!=r?r-M:null;null!=D&&D<G.width?!Q||D<z?(G.text="",G.width=G.contentWidth=0):(G.text=W(G.text,D-z,S,n.ellipsis,{minChar:n.truncateMinChar}),G.width=G.contentWidth=g(G.text,S)):G.contentWidth=g(G.text,S)}G.width+=z,M+=G.width,O&&(E=Math.max(E,G.lineHeight))}H(I,M,E)}e.outerWidth=e.width=v(r,L),e.outerHeight=e.height=v(a,y),e.contentHeight=y,e.contentWidth=L,b&&(e.outerWidth+=b[1]+b[3],e.outerHeight+=b[0]+b[2]);for(F=0;F<x.length;F++){var G,J=(G=x[F]).percentWidth;G.width=parseInt(J,10)/100*e.width}return e}function A(t,n,e,i,r){var a,l,h=""===n,o=r&&e.rich[r]||{},u=t.lines,s=o.font||e.font,c=!1;if(i){var d=o.padding,f=d?d[1]+d[3]:0;if(null!=o.width&&"auto"!==o.width){var v=function(t,n){return"string"==typeof t?t.lastIndexOf("%")>=0?parseFloat(t)/100*n:parseFloat(t):t}(o.width,i.width)+f;u.length>0&&v+i.accumWidth>i.width&&(a=n.split("\n"),c=!0),i.accumWidth=v}else{var p=E(n,s,i.width,i.breakAll,i.accumWidth);i.accumWidth=p.accumWidth+f,l=p.linesWidths,a=p.lines}}else a=n.split("\n");for(var m=0;m<a.length;m++){var w=a[m],W=new C;if(W.styleName=r,W.text=w,W.isLineHolder=!w&&!h,"number"==typeof o.width?W.width=o.width:W.width=l?l[m]:g(w,s),m||c)u.push(new _([W]));else{var x=(u[u.length-1]||(u[0]=new _)).tokens,y=x.length;1===y&&x[0].isLineHolder?x[0]=W:(w||!y||h)&&x.push(W)}}}var F=f(",&?/;] ".split(""),(function(t,n){return t[n]=!0,t}),{});function I(t){return!function(t){var n=t.charCodeAt(0);return n>=32&&n<=591||n>=880&&n<=4351||n>=4608&&n<=5119||n>=7680&&n<=8303}(t)||!!F[t]}function E(t,n,e,i,r){for(var a=[],l=[],h="",o="",u=0,s=0,c=0;c<t.length;c++){var d=t.charAt(c);if("\n"!==d){var f=g(d,n),v=!i&&!I(d);(a.length?s+f>e:r+s+f>e)?s?(h||o)&&(v?(h||(h=o,o="",s=u=0),a.push(h),l.push(s-u),o+=d,h="",s=u+=f):(o&&(h+=o,o="",u=0),a.push(h),l.push(s),h=d,s=f)):v?(a.push(o),l.push(u),o=d,u=f):(a.push(d),l.push(f)):(s+=f,v?(o+=d,u+=f):(o&&(h+=o,o="",u=0),h+=d))}else o&&(h+=o,s+=u),a.push(h),l.push(s),h="",o="",u=0,s=0}return a.length||h||(h=t,o="",u=0),o&&(h+=o),h&&(a.push(h),l.push(s)),1===a.length&&(s+=r),{accumWidth:s,lines:a,linesWidths:l}}export{k as RichTextContentBlock,b as parsePlainText,H as parseRichText,W as truncateText};export default null;

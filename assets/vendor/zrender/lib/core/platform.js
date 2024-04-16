/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/platform.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var e=12,r="sans-serif",n="12px "+r;var t,a,o=function(e){var r={};if("undefined"==typeof JSON)return r;for(var n=0;n<e.length;n++){var t=String.fromCharCode(n+32),a=(e.charCodeAt(n)-20)/100;r[t]=a}return r}("007LLmW'55;N0500LLLLLLLLLL00NNNLzWW\\\\WQb\\0FWLg\\bWb\\WQ\\WrWWQ000CL5LLFLL0LL**F*gLLLL5F0LF\\FFF5.5N"),L={createCanvas:function(){return"undefined"!=typeof document&&document.createElement("canvas")},measureText:function(e,r){if(!t){var f=L.createCanvas();t=f&&f.getContext("2d")}if(t)return a!==r&&(a=t.font=r||n),t.measureText(e);e=e||"";var u=/(\d+)px/.exec(r=r||n),i=u&&+u[1]||12,d=0;if(r.indexOf("mono")>=0)d=i*e.length;else for(var c=0;c<e.length;c++){var v=o[e[c]];d+=null==v?i:v*i}return{width:d}},loadImage:function(e,r,n){var t=new Image;return t.onload=r,t.onerror=n,t.src=e,t}};function f(e){for(var r in L)e[r]&&(L[r]=e[r])}export{n as DEFAULT_FONT,r as DEFAULT_FONT_FAMILY,e as DEFAULT_FONT_SIZE,o as DEFAULT_TEXT_WIDTH_MAP,L as platformApi,f as setPlatformAPI};export default null;

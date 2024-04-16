/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/tool/parseXML.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(n){var t={};if("undefined"==typeof JSON)return t;for(var r=0;r<n.length;r++){var e=String.fromCharCode(r+32),o=(n.charCodeAt(r)-20)/100;t[e]=o}}("007LLmW'55;N0500LLLLLLLLLL00NNNLzWW\\\\WQb\\0FWLg\\bWb\\WQ\\WrWWQ000CL5LLFLL0LL**F*gLLLL5F0LF\\FFF5.5N"),r(["Function","RegExp","Date","Error","CanvasGradient","CanvasPattern","Image","Canvas"],(function(n,t){return n["[object "+t+"]"]=!0,n}),{}),r(["Int8","Uint8","Uint8Clamped","Int16","Uint16","Int32","Uint32","Float32","Float64"],(function(n,t){return n["[object "+t+"Array]"]=!0,n}),{});Array.prototype.slice;var n=function(){}.constructor,t=n?n.prototype:null;function r(n,t,r,e){if(n&&t){for(var o=0,a=n.length;o<a;o++)r=t.call(e,r,n[o],o,n);return r}}function e(n){(function(n){return"string"==typeof n})(n)&&(n=(new DOMParser).parseFromString(n,"text/xml"));var t=n;for(9===t.nodeType&&(t=t.firstChild);"svg"!==t.nodeName.toLowerCase()||1!==t.nodeType;)t=t.nextSibling;return t}t&&"function"==typeof t.bind&&t.call.bind(t.bind);export{e as parseXML};export default null;

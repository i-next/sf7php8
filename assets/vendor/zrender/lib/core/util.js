/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/util.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var t="12px sans-serif";var n,r,e=function(t){var n={};if("undefined"==typeof JSON)return n;for(var r=0;r<t.length;r++){var e=String.fromCharCode(r+32),o=(t.charCodeAt(r)-20)/100;n[e]=o}return n}("007LLmW'55;N0500LLLLLLLLLL00NNNLzWW\\\\WQb\\0FWLg\\bWb\\WQ\\WrWWQ000CL5LLFLL0LL**F*gLLLL5F0LF\\FFF5.5N"),o={createCanvas:function(){return"undefined"!=typeof document&&document.createElement("canvas")},measureText:function(u,a){if(!n){var i=o.createCanvas();n=i&&i.getContext("2d")}if(n)return r!==a&&(r=n.font=a||t),n.measureText(u);u=u||"";var f=/(\d+)px/.exec(a=a||t),c=f&&+f[1]||12,l=0;if(a.indexOf("mono")>=0)l=c*u.length;else for(var p=0;p<u.length;p++){var s=e[u[p]];l+=null==s?c:s*c}return{width:l}},loadImage:function(t,n,r){var e=new Image;return e.onload=n,e.onerror=r,e.src=t,e}},u=_(["Function","RegExp","Date","Error","CanvasGradient","CanvasPattern","Image","Canvas"],(function(t,n){return t["[object "+n+"]"]=!0,t}),{}),a=_(["Int8","Uint8","Uint8Clamped","Int16","Uint16","Int32","Uint32","Float32","Float64"],(function(t,n){return t["[object "+n+"Array]"]=!0,t}),{}),i=Object.prototype.toString,f=Array.prototype,c=f.forEach,l=f.filter,p=f.slice,s=f.map,h=function(){}.constructor,y=h?h.prototype:null,v="__proto__",g=2311;function d(){return g++}function b(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];"undefined"!=typeof console&&console.error.apply(console,t)}function m(t){if(null==t||"object"!=typeof t)return t;var n=t,r=i.call(t);if("[object Array]"===r){if(!ut(t)){n=[];for(var e=0,o=t.length;e<o;e++)n[e]=m(t[e])}}else if(a[r]){if(!ut(t)){var f=t.constructor;if(f.from)n=f.from(t);else{n=new f(t.length);for(e=0,o=t.length;e<o;e++)n[e]=t[e]}}}else if(!u[r]&&!ut(t)&&!H(t))for(var c in n={},t)t.hasOwnProperty(c)&&c!==v&&(n[c]=m(t[c]));return n}function w(t,n,r){if(!R(n)||!R(t))return r?m(n):t;for(var e in n)if(n.hasOwnProperty(e)&&e!==v){var o=t[e],u=n[e];!R(u)||!R(o)||T(u)||T(o)||H(u)||H(o)||z(u)||z(o)||ut(u)||ut(o)?!r&&e in t||(t[e]=m(n[e])):w(o,u,r)}return t}function L(t,n){for(var r=t[0],e=1,o=t.length;e<o;e++)r=w(r,t[e],n);return r}function O(t,n){if(Object.assign)Object.assign(t,n);else for(var r in n)n.hasOwnProperty(r)&&r!==v&&(t[r]=n[r]);return t}function j(t,n,r){for(var e=I(n),o=0;o<e.length;o++){var u=e[o];(r?null!=n[u]:null==t[u])&&(t[u]=n[u])}return t}var F=o.createCanvas;function x(t,n){if(t){if(t.indexOf)return t.indexOf(n);for(var r=0,e=t.length;r<e;r++)if(t[r]===n)return r}return-1}function C(t,n){var r=t.prototype;function e(){}for(var o in e.prototype=n.prototype,t.prototype=new e,r)r.hasOwnProperty(o)&&(t.prototype[o]=r[o]);t.prototype.constructor=t,t.superClass=n}function E(t,n,r){if(t="prototype"in t?t.prototype:t,n="prototype"in n?n.prototype:n,Object.getOwnPropertyNames)for(var e=Object.getOwnPropertyNames(n),o=0;o<e.length;o++){var u=e[o];"constructor"!==u&&(r?null!=n[u]:null==t[u])&&(t[u]=n[u])}else j(t,n,r)}function P(t){return!!t&&("string"!=typeof t&&"number"==typeof t.length)}function A(t,n,r){if(t&&n)if(t.forEach&&t.forEach===c)t.forEach(n,r);else if(t.length===+t.length)for(var e=0,o=t.length;e<o;e++)n.call(r,t[e],e,t);else for(var u in t)t.hasOwnProperty(u)&&n.call(r,t[u],u,t)}function W(t,n,r){if(!t)return[];if(!n)return Z(t);if(t.map&&t.map===s)return t.map(n,r);for(var e=[],o=0,u=t.length;o<u;o++)e.push(n.call(r,t[o],o,t));return e}function _(t,n,r,e){if(t&&n){for(var o=0,u=t.length;o<u;o++)r=n.call(e,r,t[o],o,t);return r}}function k(t,n,r){if(!t)return[];if(!n)return Z(t);if(t.filter&&t.filter===l)return t.filter(n,r);for(var e=[],o=0,u=t.length;o<u;o++)n.call(r,t[o],o,t)&&e.push(t[o]);return e}function N(t,n,r){if(t&&n)for(var e=0,o=t.length;e<o;e++)if(n.call(r,t[e],e,t))return t[e]}function I(t){if(!t)return[];if(Object.keys)return Object.keys(t);var n=[];for(var r in t)t.hasOwnProperty(r)&&n.push(r);return n}var S=y&&M(y.bind)?y.call.bind(y.bind):function(t,n){for(var r=[],e=2;e<arguments.length;e++)r[e-2]=arguments[e];return function(){return t.apply(n,r.concat(p.call(arguments)))}};function U(t){for(var n=[],r=1;r<arguments.length;r++)n[r-1]=arguments[r];return function(){return t.apply(this,n.concat(p.call(arguments)))}}function T(t){return Array.isArray?Array.isArray(t):"[object Array]"===i.call(t)}function M(t){return"function"==typeof t}function Q(t){return"string"==typeof t}function D(t){return"[object String]"===i.call(t)}function K(t){return"number"==typeof t}function R(t){var n=typeof t;return"function"===n||!!t&&"object"===n}function z(t){return!!u[i.call(t)]}function G(t){return!!a[i.call(t)]}function H(t){return"object"==typeof t&&"number"==typeof t.nodeType&&"object"==typeof t.ownerDocument}function J(t){return null!=t.colorStops}function $(t){return null!=t.image}function q(t){return"[object RegExp]"===i.call(t)}function B(t){return t!=t}function V(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];for(var r=0,e=t.length;r<e;r++)if(null!=t[r])return t[r]}function X(t,n){return null!=t?t:n}function Y(t,n,r){return null!=t?t:null!=n?n:r}function Z(t){for(var n=[],r=1;r<arguments.length;r++)n[r-1]=arguments[r];return p.apply(t,n)}function tt(t){if("number"==typeof t)return[t,t,t,t];var n=t.length;return 2===n?[t[0],t[1],t[0],t[1]]:3===n?[t[0],t[1],t[2],t[1]]:t}function nt(t,n){if(!t)throw new Error(n)}function rt(t){return null==t?null:"function"==typeof t.trim?t.trim():t.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"")}var et="__ec_primitive__";function ot(t){t[et]=!0}function ut(t){return t[et]}var at=function(){function t(){this.data={}}return t.prototype.delete=function(t){var n=this.has(t);return n&&delete this.data[t],n},t.prototype.has=function(t){return this.data.hasOwnProperty(t)},t.prototype.get=function(t){return this.data[t]},t.prototype.set=function(t,n){return this.data[t]=n,this},t.prototype.keys=function(){return I(this.data)},t.prototype.forEach=function(t){var n=this.data;for(var r in n)n.hasOwnProperty(r)&&t(n[r],r)},t}(),it="function"==typeof Map;var ft=function(){function t(n){var r=T(n);this.data=it?new Map:new at;var e=this;function o(t,n){r?e.set(t,n):e.set(n,t)}n instanceof t?n.each(o):n&&A(n,o)}return t.prototype.hasKey=function(t){return this.data.has(t)},t.prototype.get=function(t){return this.data.get(t)},t.prototype.set=function(t,n){return this.data.set(t,n),n},t.prototype.each=function(t,n){this.data.forEach((function(r,e){t.call(n,r,e)}))},t.prototype.keys=function(){var t=this.data.keys();return it?Array.from(t):t},t.prototype.removeKey=function(t){this.data.delete(t)},t}();function ct(t){return new ft(t)}function lt(t,n){for(var r=new t.constructor(t.length+n.length),e=0;e<t.length;e++)r[e]=t[e];var o=t.length;for(e=0;e<n.length;e++)r[e+o]=n[e];return r}function pt(t,n){var r;if(Object.create)r=Object.create(t);else{var e=function(){};e.prototype=t,r=new e}return n&&O(r,n),r}function st(t){var n=t.style;n.webkitUserSelect="none",n.userSelect="none",n.webkitTapHighlightColor="rgba(0,0,0,0)",n["-webkit-touch-callout"]="none"}function ht(t,n){return t.hasOwnProperty(n)}function yt(){}var vt=180/Math.PI;export{ft as HashMap,vt as RADIAN_TO_DEGREE,nt as assert,S as bind,m as clone,lt as concatArray,F as createCanvas,ct as createHashMap,pt as createObject,U as curry,j as defaults,st as disableUserSelect,A as each,B as eqNaN,O as extend,k as filter,N as find,d as guid,ht as hasOwn,x as indexOf,C as inherits,T as isArray,P as isArrayLike,z as isBuiltInObject,H as isDom,M as isFunction,J as isGradientObject,$ as isImagePatternObject,K as isNumber,R as isObject,ut as isPrimitive,q as isRegExp,Q as isString,D as isStringSafe,G as isTypedArray,I as keys,b as logError,W as map,w as merge,L as mergeAll,E as mixin,yt as noop,tt as normalizeCssArray,_ as reduce,V as retrieve,X as retrieve2,Y as retrieve3,ot as setAsPrimitive,Z as slice,rt as trim};export default null;

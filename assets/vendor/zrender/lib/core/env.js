/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/env.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var e=function(){this.firefox=!1,this.ie=!1,this.edge=!1,this.newEdge=!1,this.weChat=!1},t=new function(){this.browser=new e,this.node=!1,this.wxa=!1,this.worker=!1,this.svgSupported=!1,this.touchEventsSupported=!1,this.pointerEventsSupported=!1,this.domSupported=!1,this.transformSupported=!1,this.transform3dSupported=!1,this.hasGlobalWindow="undefined"!=typeof window};"object"==typeof wx&&"function"==typeof wx.getSystemInfoSync?(t.wxa=!0,t.touchEventsSupported=!0):"undefined"==typeof document&&"undefined"!=typeof self?t.worker=!0:"undefined"==typeof navigator||0===navigator.userAgent.indexOf("Node.js")?(t.node=!0,t.svgSupported=!0):function(e,t){var n=t.browser,o=e.match(/Firefox\/([\d.]+)/),i=e.match(/MSIE\s([\d.]+)/)||e.match(/Trident\/.+?rv:(([\d.]+))/),r=e.match(/Edge?\/([\d.]+)/),d=/micromessenger/i.test(e);o&&(n.firefox=!0,n.version=o[1]);i&&(n.ie=!0,n.version=i[1]);r&&(n.edge=!0,n.version=r[1],n.newEdge=+r[1].split(".")[0]>18);d&&(n.weChat=!0);t.svgSupported="undefined"!=typeof SVGRect,t.touchEventsSupported="ontouchstart"in window&&!n.ie&&!n.edge,t.pointerEventsSupported="onpointerdown"in window&&(n.edge||n.ie&&+n.version>=11),t.domSupported="undefined"!=typeof document;var s=document.documentElement.style;t.transform3dSupported=(n.ie&&"transition"in s||n.edge||"WebKitCSSMatrix"in window&&"m11"in new WebKitCSSMatrix||"MozPerspective"in s)&&!("OTransition"in s),t.transformSupported=t.transform3dSupported||n.ie&&+n.version>=9}(navigator.userAgent,t);export{t as default};
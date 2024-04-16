/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/contain/polygon.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
function r(r,n,t,e,u,a){if(a>n&&a>e||a<n&&a<e)return 0;if(e===n)return 0;var f=(a-n)/(e-n),v=e<n?1:-1;1!==f&&0!==f||(v=e<n?.5:-.5);var i=f*(t-r)+r;return i===u?1/0:i>u?v:0}var n=1e-8;function t(r,t){return Math.abs(r-t)<n}function e(n,e,u){var a=0,f=n[0];if(!f)return!1;for(var v=1;v<n.length;v++){var i=n[v];a+=r(f[0],f[1],i[0],i[1],e,u),f=i}var o=n[0];return t(f[0],o[0])&&t(f[1],o[1])||(a+=r(f[0],f[1],o[0],o[1],e,u)),0!==a}export{e as contain};export default null;

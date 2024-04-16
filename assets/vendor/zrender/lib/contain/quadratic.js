/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/contain/quadratic.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
function r(r,n){return null==r&&(r=0),null==n&&(n=0),[r,n]}var n=function(r,n){return(r[0]-n[0])*(r[0]-n[0])+(r[1]-n[1])*(r[1]-n[1])},t=Math.sqrt,u=1e-4,e=r(),a=r(),f=r();function l(r,n,t,u){var e=1-u;return e*(e*r+2*u*n)+u*u*t}function v(r,v,o,i,c,p,s,x,d){if(0===s)return!1;var h=s;if(d>v+h&&d>i+h&&d>p+h||d<v-h&&d<i-h&&d<p-h||x>r+h&&x>o+h&&x>c+h||x<r-h&&x<o-h&&x<c-h)return!1;var q=function(r,v,o,i,c,p,s,x,d){var h,q=.005,M=1/0;e[0]=s,e[1]=x;for(var b=0;b<1;b+=.05)a[0]=l(r,o,c,b),a[1]=l(v,i,p,b),(m=n(e,a))<M&&(h=b,M=m);M=1/0;for(var g=0;g<32&&!(q<u);g++){var j=h-q,k=h+q;a[0]=l(r,o,c,j),a[1]=l(v,i,p,j);var m=n(a,e);if(j>=0&&m<M)h=j,M=m;else{f[0]=l(r,o,c,k),f[1]=l(v,i,p,k);var w=n(f,e);k<=1&&w<M?(h=k,M=w):q*=.5}}return d&&(d[0]=l(r,o,c,h),d[1]=l(v,i,p,h)),t(M)}(r,v,o,i,c,p,x,d,null);return q<=h/2}export{v as containStroke};export default null;

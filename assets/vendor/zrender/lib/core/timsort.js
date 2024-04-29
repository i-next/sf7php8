/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/timsort.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var r=32,f=7;function e(r,f,e,i){var o=f+1;if(o===e)return 1;if(i(r[o++],r[f])<0){for(;o<e&&i(r[o],r[o-1])<0;)o++;!function(r,f,e){e--;for(;f<e;){var i=r[f];r[f++]=r[e],r[e--]=i}}(r,f,o)}else for(;o<e&&i(r[o],r[o-1])>=0;)o++;return o-f}function i(r,f,e,i,o){for(i===f&&i++;i<e;i++){for(var a,n=r[i],u=f,t=i;u<t;)o(n,r[a=u+t>>>1])<0?t=a:u=a+1;var v=i-u;switch(v){case 3:r[u+3]=r[u+2];case 2:r[u+2]=r[u+1];case 1:r[u+1]=r[u];break;default:for(;v>0;)r[u+v]=r[u+v-1],v--}r[u]=n}}function o(r,f,e,i,o,a){var n=0,u=0,t=1;if(a(r,f[e+o])>0){for(u=i-o;t<u&&a(r,f[e+o+t])>0;)n=t,(t=1+(t<<1))<=0&&(t=u);t>u&&(t=u),n+=o,t+=o}else{for(u=o+1;t<u&&a(r,f[e+o-t])<=0;)n=t,(t=1+(t<<1))<=0&&(t=u);t>u&&(t=u);var v=n;n=o-t,t=o-v}for(n++;n<t;){var c=n+(t-n>>>1);a(r,f[e+c])>0?n=c+1:t=c}return t}function a(r,f,e,i,o,a){var n=0,u=0,t=1;if(a(r,f[e+o])<0){for(u=o+1;t<u&&a(r,f[e+o-t])<0;)n=t,(t=1+(t<<1))<=0&&(t=u);t>u&&(t=u);var v=n;n=o-t,t=o-v}else{for(u=i-o;t<u&&a(r,f[e+o+t])>=0;)n=t,(t=1+(t<<1))<=0&&(t=u);t>u&&(t=u),n+=o,t+=o}for(n++;n<t;){var c=n+(t-n>>>1);a(r,f[e+c])<0?t=c:n=c+1}return t}function n(r,e){var i,n,u=f,t=0,v=[];function c(c){var s=i[c],b=n[c],k=i[c+1],l=n[c+1];n[c]=b+l,c===t-3&&(i[c+1]=i[c+2],n[c+1]=n[c+2]),t--;var h=a(r[k],r,s,b,0,e);s+=h,0!==(b-=h)&&0!==(l=o(r[s+b-1],r,k,l,l-1,e))&&(b<=l?function(i,n,t,c){var s=0;for(s=0;s<n;s++)v[s]=r[i+s];var b=0,k=t,l=i;if(r[l++]=r[k++],0==--c){for(s=0;s<n;s++)r[l+s]=v[b+s];return}if(1===n){for(s=0;s<c;s++)r[l+s]=r[k+s];return void(r[l+c]=v[b])}var h,w,d,R=u;for(;;){h=0,w=0,d=!1;do{if(e(r[k],v[b])<0){if(r[l++]=r[k++],w++,h=0,0==--c){d=!0;break}}else if(r[l++]=v[b++],h++,w=0,1==--n){d=!0;break}}while((h|w)<R);if(d)break;do{if(0!==(h=a(r[k],v,b,n,0,e))){for(s=0;s<h;s++)r[l+s]=v[b+s];if(l+=h,b+=h,(n-=h)<=1){d=!0;break}}if(r[l++]=r[k++],0==--c){d=!0;break}if(0!==(w=o(v[b],r,k,c,0,e))){for(s=0;s<w;s++)r[l+s]=r[k+s];if(l+=w,k+=w,0===(c-=w)){d=!0;break}}if(r[l++]=v[b++],1==--n){d=!0;break}R--}while(h>=f||w>=f);if(d)break;R<0&&(R=0),R+=2}if((u=R)<1&&(u=1),1===n){for(s=0;s<c;s++)r[l+s]=r[k+s];r[l+c]=v[b]}else{if(0===n)throw new Error;for(s=0;s<n;s++)r[l+s]=v[b+s]}}(s,b,k,l):function(i,n,t,c){var s=0;for(s=0;s<c;s++)v[s]=r[t+s];var b=i+n-1,k=c-1,l=t+c-1,h=0,w=0;if(r[l--]=r[b--],0==--n){for(h=l-(c-1),s=0;s<c;s++)r[h+s]=v[s];return}if(1===c){for(w=(l-=n)+1,h=(b-=n)+1,s=n-1;s>=0;s--)r[w+s]=r[h+s];return void(r[l]=v[k])}var d=u;for(;;){var R=0,g=0,p=!1;do{if(e(v[k],r[b])<0){if(r[l--]=r[b--],R++,g=0,0==--n){p=!0;break}}else if(r[l--]=v[k--],g++,R=0,1==--c){p=!0;break}}while((R|g)<d);if(p)break;do{if(0!==(R=n-a(v[k],r,i,n,n-1,e))){for(n-=R,w=(l-=R)+1,h=(b-=R)+1,s=R-1;s>=0;s--)r[w+s]=r[h+s];if(0===n){p=!0;break}}if(r[l--]=v[k--],1==--c){p=!0;break}if(0!==(g=c-o(r[b],v,0,c,c-1,e))){for(c-=g,w=(l-=g)+1,h=(k-=g)+1,s=0;s<g;s++)r[w+s]=v[h+s];if(c<=1){p=!0;break}}if(r[l--]=r[b--],0==--n){p=!0;break}d--}while(R>=f||g>=f);if(p)break;d<0&&(d=0),d+=2}(u=d)<1&&(u=1);if(1===c){for(w=(l-=n)+1,h=(b-=n)+1,s=n-1;s>=0;s--)r[w+s]=r[h+s];r[l]=v[k]}else{if(0===c)throw new Error;for(h=l-(c-1),s=0;s<c;s++)r[h+s]=v[s]}}(s,b,k,l))}return i=[],n=[],{mergeRuns:function(){for(;t>1;){var r=t-2;if(r>=1&&n[r-1]<=n[r]+n[r+1]||r>=2&&n[r-2]<=n[r]+n[r-1])n[r-1]<n[r+1]&&r--;else if(n[r]>n[r+1])break;c(r)}},forceMergeRuns:function(){for(;t>1;){var r=t-2;r>0&&n[r-1]<n[r+1]&&r--,c(r)}},pushRun:function(r,f){i[t]=r,n[t]=f,t+=1}}}function u(f,o,a,u){a||(a=0),u||(u=f.length);var t=u-a;if(!(t<2)){var v=0;if(t<r)i(f,a,u,a+(v=e(f,a,u,o)),o);else{var c=n(f,o),s=function(f){for(var e=0;f>=r;)e|=1&f,f>>=1;return f+e}(t);do{if((v=e(f,a,u,o))<s){var b=t;b>s&&(b=s),i(f,a,a+b,a+v,o),v=b}c.pushRun(a,v),c.mergeRuns(),t-=v,a+=v}while(0!==t);c.forceMergeRuns()}}}export{u as default};
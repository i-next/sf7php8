/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/fast-diff@1.3.0/diff.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var n=-1,t=1,r=0;function e(o,v,p,A,d){if(o===v)return o?[[r,o]]:[];if(null!=p){var M=function(n,t,r){var e="number"==typeof r?{index:r,length:0}:r.oldRange,i="number"==typeof r?null:r.newRange,l=n.length,s=t.length;if(0===e.length&&(null===i||0===i.length)){var g=e.index,h=n.slice(0,g),u=n.slice(g),a=i?i.index:null,c=g+s-l;if((null===a||a===c)&&!(c<0||c>s)){var f=t.slice(0,c);if((v=t.slice(c))===u){var b=Math.min(g,c);if((A=h.slice(0,b))===(M=f.slice(0,b)))return m(A,h.slice(b),f.slice(b),u)}}if(null===a||a===g){var o=g,v=(f=t.slice(0,o),t.slice(o));if(f===h){var p=Math.min(l-o,s-o);if((d=u.slice(u.length-p))===(x=v.slice(v.length-p)))return m(h,u.slice(0,u.length-p),v.slice(0,v.length-p),d)}}}if(e.length>0&&i&&0===i.length){var A=n.slice(0,e.index),d=n.slice(e.index+e.length);if(!(s<(b=A.length)+(p=d.length))){var M=t.slice(0,b),x=t.slice(s-p);if(A===M&&d===x)return m(A,n.slice(b,l-p),t.slice(b,s-p),d)}}return null}(o,v,p);if(M)return M}var x=l(o,v),E=o.substring(0,x);x=g(o=o.substring(x),v=v.substring(x));var w=o.substring(o.length-x),y=function(s,h){var u;if(!s)return[[t,h]];if(!h)return[[n,s]];var a=s.length>h.length?s:h,c=s.length>h.length?h:s,f=a.indexOf(c);if(-1!==f)return u=[[t,a.substring(0,f)],[r,c],[t,a.substring(f+c.length)]],s.length>h.length&&(u[0][0]=u[2][0]=n),u;if(1===c.length)return[[n,s],[t,h]];var b=function(n,t){var r=n.length>t.length?n:t,e=n.length>t.length?t:n;if(r.length<4||2*e.length<r.length)return null;function i(n,t,r){for(var e,i,s,h,u=n.substring(r,r+Math.floor(n.length/4)),a=-1,c="";-1!==(a=t.indexOf(u,a+1));){var f=l(n.substring(r),t.substring(a)),b=g(n.substring(0,r),t.substring(0,a));c.length<b+f&&(c=t.substring(a-b,a)+t.substring(a,a+f),e=n.substring(0,r-b),i=n.substring(r+f),s=t.substring(0,a-b),h=t.substring(a+f))}return 2*c.length>=n.length?[e,i,s,h,c]:null}var s,h,u,a,c,f=i(r,e,Math.ceil(r.length/4)),b=i(r,e,Math.ceil(r.length/2));if(!f&&!b)return null;s=b?f&&f[4].length>b[4].length?f:b:f;n.length>t.length?(h=s[0],u=s[1],a=s[2],c=s[3]):(a=s[0],c=s[1],h=s[2],u=s[3]);var o=s[4];return[h,u,a,c,o]}(s,h);if(b){var o=b[0],v=b[1],p=b[2],A=b[3],m=b[4],d=e(o,p),M=e(v,A);return d.concat([[r,m]],M)}return function(r,e){for(var l=r.length,s=e.length,g=Math.ceil((l+s)/2),h=g,u=2*g,a=new Array(u),c=new Array(u),f=0;f<u;f++)a[f]=-1,c[f]=-1;a[h+1]=0,c[h+1]=0;for(var b=l-s,o=b%2!=0,v=0,p=0,A=0,m=0,d=0;d<g;d++){for(var M=-d+v;M<=d-p;M+=2){for(var x=h+M,E=(R=M===-d||M!==d&&a[x-1]<a[x+1]?a[x+1]:a[x-1]+1)-M;R<l&&E<s&&r.charAt(R)===e.charAt(E);)R++,E++;if(a[x]=R,R>l)p+=2;else if(E>s)v+=2;else if(o){if((C=h+b-M)>=0&&C<u&&-1!==c[C])if(R>=(y=l-c[C]))return i(r,e,R,E)}}for(var w=-d+A;w<=d-m;w+=2){for(var y,C=h+w,L=(y=w===-d||w!==d&&c[C-1]<c[C+1]?c[C+1]:c[C-1]+1)-w;y<l&&L<s&&r.charAt(l-y-1)===e.charAt(s-L-1);)y++,L++;if(c[C]=y,y>l)m+=2;else if(L>s)A+=2;else if(!o){if((x=h+b-w)>=0&&x<u&&-1!==a[x]){var R;E=h+(R=a[x])-x;if(R>=(y=l-y))return i(r,e,R,E)}}}}return[[n,r],[t,e]]}(s,h)}(o=o.substring(0,o.length-x),v=v.substring(0,v.length-x));return E&&y.unshift([r,E]),w&&y.push([r,w]),b(y,d),A&&function(e){var i=!1,l=[],o=0,v=null,p=0,A=0,m=0,d=0,M=0;for(;p<e.length;)e[p][0]==r?(l[o++]=p,A=d,m=M,d=0,M=0,v=e[p][1]):(e[p][0]==t?d+=e[p][1].length:M+=e[p][1].length,v&&v.length<=Math.max(A,m)&&v.length<=Math.max(d,M)&&(e.splice(l[o-1],0,[n,v]),e[l[o-1]+1][0]=t,o--,p=--o>0?l[o-1]:-1,A=0,m=0,d=0,M=0,v=null,i=!0)),p++;i&&b(e);(function(n){function t(n,t){if(!n||!t)return 6;var r=n.charAt(n.length-1),e=t.charAt(0),i=r.match(h),l=e.match(h),s=i&&r.match(u),g=l&&e.match(u),b=s&&r.match(a),o=g&&e.match(a),v=b&&n.match(c),p=o&&t.match(f);return v||p?5:b||o?4:i&&!s&&g?3:s||g?2:i||l?1:0}var e=1;for(;e<n.length-1;){if(n[e-1][0]==r&&n[e+1][0]==r){var i=n[e-1][1],l=n[e][1],s=n[e+1][1],b=g(i,l);if(b){var o=l.substring(l.length-b);i=i.substring(0,i.length-b),l=o+l.substring(0,l.length-b),s=o+s}for(var v=i,p=l,A=s,m=t(i,l)+t(l,s);l.charAt(0)===s.charAt(0);){i+=l.charAt(0),l=l.substring(1)+s.charAt(0),s=s.substring(1);var d=t(i,l)+t(l,s);d>=m&&(m=d,v=i,p=l,A=s)}n[e-1][1]!=v&&(v?n[e-1][1]=v:(n.splice(e-1,1),e--),n[e][1]=p,A?n[e+1][1]=A:(n.splice(e+1,1),e--))}e++}})(e),p=1;for(;p<e.length;){if(e[p-1][0]==n&&e[p][0]==t){var x=e[p-1][1],E=e[p][1],w=s(x,E),y=s(E,x);w>=y?(w>=x.length/2||w>=E.length/2)&&(e.splice(p,0,[r,E.substring(0,w)]),e[p-1][1]=x.substring(0,x.length-w),e[p+1][1]=E.substring(w),p++):(y>=x.length/2||y>=E.length/2)&&(e.splice(p,0,[r,x.substring(0,y)]),e[p-1][0]=t,e[p-1][1]=E.substring(0,E.length-y),e[p+1][0]=n,e[p+1][1]=x.substring(y),p++),p++}p++}}(y),y}function i(n,t,r,i){var l=n.substring(0,r),s=t.substring(0,i),g=n.substring(r),h=t.substring(i),u=e(l,s),a=e(g,h);return u.concat(a)}function l(n,t){if(!n||!t||n.charAt(0)!==t.charAt(0))return 0;for(var r=0,e=Math.min(n.length,t.length),i=e,l=0;r<i;)n.substring(l,i)==t.substring(l,i)?l=r=i:e=i,i=Math.floor((e-r)/2+r);return o(n.charCodeAt(i-1))&&i--,i}function s(n,t){var r=n.length,e=t.length;if(0==r||0==e)return 0;r>e?n=n.substring(r-e):r<e&&(t=t.substring(0,r));var i=Math.min(r,e);if(n==t)return i;for(var l=0,s=1;;){var g=n.substring(i-s),h=t.indexOf(g);if(-1==h)return l;s+=h,0!=h&&n.substring(i-s)!=t.substring(0,s)||(l=s,s++)}}function g(n,t){if(!n||!t||n.slice(-1)!==t.slice(-1))return 0;for(var r=0,e=Math.min(n.length,t.length),i=e,l=0;r<i;)n.substring(n.length-i,n.length-l)==t.substring(t.length-i,t.length-l)?l=r=i:e=i,i=Math.floor((e-r)/2+r);return v(n.charCodeAt(n.length-i))&&i--,i}var h=/[^a-zA-Z0-9]/,u=/\s/,a=/[\r\n]/,c=/\n\r?\n$/,f=/^\r?\n\r?\n/;function b(e,i){e.push([r,""]);for(var s,h=0,u=0,a=0,c="",f="";h<e.length;)if(h<e.length-1&&!e[h][1])e.splice(h,1);else switch(e[h][0]){case t:a++,f+=e[h][1],h++;break;case n:u++,c+=e[h][1],h++;break;case r:var o=h-a-u-1;if(i){if(o>=0&&A(e[o][1])){var v=e[o][1].slice(-1);if(e[o][1]=e[o][1].slice(0,-1),c=v+c,f=v+f,!e[o][1]){e.splice(o,1),h--;var m=o-1;e[m]&&e[m][0]===t&&(a++,f=e[m][1]+f,m--),e[m]&&e[m][0]===n&&(u++,c=e[m][1]+c,m--),o=m}}if(p(e[h][1])){v=e[h][1].charAt(0);e[h][1]=e[h][1].slice(1),c+=v,f+=v}}if(h<e.length-1&&!e[h][1]){e.splice(h,1);break}if(c.length>0||f.length>0){c.length>0&&f.length>0&&(0!==(s=l(f,c))&&(o>=0?e[o][1]+=f.substring(0,s):(e.splice(0,0,[r,f.substring(0,s)]),h++),f=f.substring(s),c=c.substring(s)),0!==(s=g(f,c))&&(e[h][1]=f.substring(f.length-s)+e[h][1],f=f.substring(0,f.length-s),c=c.substring(0,c.length-s)));var d=a+u;0===c.length&&0===f.length?(e.splice(h-d,d),h-=d):0===c.length?(e.splice(h-d,d,[t,f]),h=h-d+1):0===f.length?(e.splice(h-d,d,[n,c]),h=h-d+1):(e.splice(h-d,d,[n,c],[t,f]),h=h-d+2)}0!==h&&e[h-1][0]===r?(e[h-1][1]+=e[h][1],e.splice(h,1)):h++,a=0,u=0,c="",f=""}""===e[e.length-1][1]&&e.pop();var M=!1;for(h=1;h<e.length-1;)e[h-1][0]===r&&e[h+1][0]===r&&(e[h][1].substring(e[h][1].length-e[h-1][1].length)===e[h-1][1]?(e[h][1]=e[h-1][1]+e[h][1].substring(0,e[h][1].length-e[h-1][1].length),e[h+1][1]=e[h-1][1]+e[h+1][1],e.splice(h-1,1),M=!0):e[h][1].substring(0,e[h+1][1].length)==e[h+1][1]&&(e[h-1][1]+=e[h+1][1],e[h][1]=e[h][1].substring(e[h+1][1].length)+e[h+1][1],e.splice(h+1,1),M=!0)),h++;M&&b(e,i)}function o(n){return n>=55296&&n<=56319}function v(n){return n>=56320&&n<=57343}function p(n){return v(n.charCodeAt(0))}function A(n){return o(n.charCodeAt(n.length-1))}function m(e,i,l,s){return A(e)||p(s)?null:function(n){for(var t=[],r=0;r<n.length;r++)n[r][1].length>0&&t.push(n[r]);return t}([[r,e],[n,i],[t,l],[r,s]])}function d(n,t,r,i){return e(n,t,r,i,!0)}d.INSERT=t,d.DELETE=n,d.EQUAL=r;var M=d,x=M.DELETE,E=M.EQUAL,w=M.INSERT;export{x as DELETE,E as EQUAL,w as INSERT,M as default};
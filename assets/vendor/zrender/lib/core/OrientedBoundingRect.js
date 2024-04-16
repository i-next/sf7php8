/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/OrientedBoundingRect.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var t=function(){function t(t,n){this.x=t||0,this.y=n||0}return t.prototype.copy=function(t){return this.x=t.x,this.y=t.y,this},t.prototype.clone=function(){return new t(this.x,this.y)},t.prototype.set=function(t,n){return this.x=t,this.y=n,this},t.prototype.equal=function(t){return t.x===this.x&&t.y===this.y},t.prototype.add=function(t){return this.x+=t.x,this.y+=t.y,this},t.prototype.scale=function(t){this.x*=t,this.y*=t},t.prototype.scaleAndAdd=function(t,n){this.x+=t.x*n,this.y+=t.y*n},t.prototype.sub=function(t){return this.x-=t.x,this.y-=t.y,this},t.prototype.dot=function(t){return this.x*t.x+this.y*t.y},t.prototype.len=function(){return Math.sqrt(this.x*this.x+this.y*this.y)},t.prototype.lenSquare=function(){return this.x*this.x+this.y*this.y},t.prototype.normalize=function(){var t=this.len();return this.x/=t,this.y/=t,this},t.prototype.distance=function(t){var n=this.x-t.x,i=this.y-t.y;return Math.sqrt(n*n+i*i)},t.prototype.distanceSquare=function(t){var n=this.x-t.x,i=this.y-t.y;return n*n+i*i},t.prototype.negate=function(){return this.x=-this.x,this.y=-this.y,this},t.prototype.transform=function(t){if(t){var n=this.x,i=this.y;return this.x=t[0]*n+t[2]*i+t[4],this.y=t[1]*n+t[3]*i+t[5],this}},t.prototype.toArray=function(t){return t[0]=this.x,t[1]=this.y,t},t.prototype.fromArray=function(t){this.x=t[0],this.y=t[1]},t.set=function(t,n,i){t.x=n,t.y=i},t.copy=function(t,n){t.x=n.x,t.y=n.y},t.len=function(t){return Math.sqrt(t.x*t.x+t.y*t.y)},t.lenSquare=function(t){return t.x*t.x+t.y*t.y},t.dot=function(t,n){return t.x*n.x+t.y*n.y},t.add=function(t,n,i){t.x=n.x+i.x,t.y=n.y+i.y},t.sub=function(t,n,i){t.x=n.x-i.x,t.y=n.y-i.y},t.scale=function(t,n,i){t.x=n.x*i,t.y=n.y*i},t.scaleAndAdd=function(t,n,i,r){t.x=n.x+i.x*r,t.y=n.y+i.y*r},t.lerp=function(t,n,i,r){var e=1-r;t.x=e*n.x+r*i.x,t.y=e*n.y+r*i.y},t}(),n=[0,0],i=[0,0],r=new t,e=new t,s=function(){function s(n,i){this._corners=[],this._axes=[],this._origin=[0,0];for(var r=0;r<4;r++)this._corners[r]=new t;for(r=0;r<2;r++)this._axes[r]=new t;n&&this.fromBoundingRect(n,i)}return s.prototype.fromBoundingRect=function(n,i){var r=this._corners,e=this._axes,s=n.x,o=n.y,h=s+n.width,y=o+n.height;if(r[0].set(s,o),r[1].set(h,o),r[2].set(h,y),r[3].set(s,y),i)for(var u=0;u<4;u++)r[u].transform(i);t.sub(e[0],r[1],r[0]),t.sub(e[1],r[3],r[0]),e[0].normalize(),e[1].normalize();for(u=0;u<2;u++)this._origin[u]=e[u].dot(r[0])},s.prototype.intersect=function(n,i){var s=!0,o=!i;return r.set(1/0,1/0),e.set(0,0),!this._intersectCheckOneSide(this,n,r,e,o,1)&&(s=!1,o)||!this._intersectCheckOneSide(n,this,r,e,o,-1)&&(s=!1,o)||o||t.copy(i,s?r:e),s},s.prototype._intersectCheckOneSide=function(r,e,s,o,h,y){for(var u=!0,x=0;x<2;x++){var a=this._axes[x];if(this._getProjMinMaxOnAxis(x,r._corners,n),this._getProjMinMaxOnAxis(x,e._corners,i),n[1]<i[0]||n[0]>i[1]){if(u=!1,h)return u;var c=Math.abs(i[0]-n[1]),f=Math.abs(n[0]-i[1]);Math.min(c,f)>o.len()&&(c<f?t.scale(o,a,-c*y):t.scale(o,a,f*y))}else if(s){c=Math.abs(i[0]-n[1]),f=Math.abs(n[0]-i[1]);Math.min(c,f)<s.len()&&(c<f?t.scale(s,a,c*y):t.scale(s,a,-f*y))}}return u},s.prototype._getProjMinMaxOnAxis=function(t,n,i){for(var r=this._axes[t],e=this._origin,s=n[0].dot(r)+e[t],o=s,h=s,y=1;y<n.length;y++){var u=n[y].dot(r)+e[t];o=Math.min(u,o),h=Math.max(u,h)}i[0]=o,i[1]=h},s}();export{s as default};

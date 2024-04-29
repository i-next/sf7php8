/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/zrender@5.5.0/lib/core/LRU.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
var t=function(t){this.value=t},e=function(){function e(){this._len=0}return e.prototype.insert=function(e){var n=new t(e);return this.insertEntry(n),n},e.prototype.insertEntry=function(t){this.head?(this.tail.next=t,t.prev=this.tail,t.next=null,this.tail=t):this.head=this.tail=t,this._len++},e.prototype.remove=function(t){var e=t.prev,n=t.next;e?e.next=n:this.head=n,n?n.prev=e:this.tail=e,t.next=t.prev=null,this._len--},e.prototype.len=function(){return this._len},e.prototype.clear=function(){this.head=this.tail=null,this._len=0},e}(),n=function(){function n(t){this._list=new e,this._maxSize=10,this._map={},this._maxSize=t}return n.prototype.put=function(e,n){var i=this._list,r=this._map,l=null;if(null==r[e]){var s=i.len(),o=this._lastRemovedEntry;if(s>=this._maxSize&&s>0){var a=i.head;i.remove(a),delete r[a.key],l=a.value,this._lastRemovedEntry=a}o?o.value=n:o=new t(n),o.key=e,i.insertEntry(o),r[e]=o}return l},n.prototype.get=function(t){var e=this._map[t],n=this._list;if(null!=e)return e!==n.tail&&(n.remove(e),n.insertEntry(e)),e.value},n.prototype.clear=function(){this._list.clear(),this._map={}},n.prototype.len=function(){return this._list.len()},n}();export{t as Entry,e as LinkedList,n as default};
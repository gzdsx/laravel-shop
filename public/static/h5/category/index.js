!function(t){var e={};function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(r,i,function(e){return t[e]}.bind(null,i));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=3)}({"/XBH":function(t,e,n){"use strict";var r=n("n1i5");n.n(r).a},"2IEv":function(t,e,n){"use strict";var r,i=(r=n("NChU"))&&r.__esModule?r:{default:r};new Vue({el:"#app",render:function(t){return t(i.default)}})},3:function(t,e,n){t.exports=n("2IEv")},"9tPo":function(t,e){t.exports=function(t){var e="undefined"!=typeof window&&window.location;if(!e)throw new Error("fixUrls requires window.location");if(!t||"string"!=typeof t)return t;var n=e.protocol+"//"+e.host,r=n+e.pathname.replace(/\/[^\/]*$/,"/");return t.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,(function(t,e){var i,o=e.trim().replace(/^"(.*)"$/,(function(t,e){return e})).replace(/^'(.*)'$/,(function(t,e){return e}));return/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(o)?t:(i=0===o.indexOf("//")?o:0===o.indexOf("/")?n+o:r+o.replace(/^\.\//,""),"url("+JSON.stringify(i)+")")}))}},CpDW:function(t,e,n){"use strict";n.r(e);var r=n("VYP6"),i=n("o0Sb");for(var o in i)"default"!==o&&function(t){n.d(e,t,(function(){return i[t]}))}(o);n("/XBH");var a=n("KHd+"),s=Object(a.a)(i.default,r.a,r.b,!1,null,"967f518e",null);e.default=s.exports},G8va:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;e.default={name:"ProductListView",props:{items:[]}}},I1BE:function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=function(t,e){var n=t[1]||"",r=t[3];if(!r)return n;if(e&&"function"==typeof btoa){var i=(a=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),o=r.sources.map((function(t){return"/*# sourceURL="+r.sourceRoot+t+" */"}));return[n].concat(o).concat([i]).join("\n")}var a;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n})).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var r={},i=0;i<this.length;i++){var o=this[i][0];"number"==typeof o&&(r[o]=!0)}for(i=0;i<t.length;i++){var a=t[i];"number"==typeof a[0]&&r[a[0]]||(n&&!a[2]?a[2]=n:n&&(a[2]="("+a[2]+") and ("+n+")"),e.push(a))}},e}},"KHd+":function(t,e,n){"use strict";function r(t,e,n,r,i,o,a,s){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=n,u._compiled=!0),r&&(u.functional=!0),o&&(u._scopeId="data-v-"+o),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):i&&(c=s?function(){i.call(this,this.$root.$options.shadowRoot)}:i),c)if(u.functional){u._injectStyles=c;var f=u.render;u.render=function(t,e){return c.call(e),f(t,e)}}else{var l=u.beforeCreate;u.beforeCreate=l?[].concat(l,c):[c]}return{exports:t,options:u}}n.d(e,"a",(function(){return r}))},NChU:function(t,e,n){"use strict";n.r(e);var r=n("Tdun"),i=n("Oy1r");for(var o in i)"default"!==o&&function(t){n.d(e,t,(function(){return i[t]}))}(o);var a=n("KHd+"),s=Object(a.a)(i.default,r.a,r.b,!1,null,"0e7a8167",null);e.default=s.exports},Oy1r:function(t,e,n){"use strict";n.r(e);var r=n("q8cP"),i=n.n(r);for(var o in r)"default"!==o&&function(t){n.d(e,t,(function(){return r[t]}))}(o);e.default=i.a},Tdun:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"container"},[n("van-tabs",{attrs:{sticky:""},on:{change:t.handleTabChange},model:{value:t.active,callback:function(e){t.active=e},expression:"active"}},t._l(t.categories,(function(t,e){return n("van-tab",{key:e,attrs:{title:t.name,name:t.catid}})})),1),t._v(" "),n("van-pull-refresh",{on:{refresh:t.onRefresh},model:{value:t.isRefreshing,callback:function(e){t.isRefreshing=e},expression:"isRefreshing"}},[n("product-list-view",{attrs:{items:t.items}})],1),t._v(" "),n("tab-bar",{attrs:{"active-index":"1"}})],1)},i=[]},VYP6:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticStyle:{height:"50px"}},[n("van-tabbar",{attrs:{fixed:"true","z-index":"999"},model:{value:t.activeIndex,callback:function(e){t.activeIndex=e},expression:"activeIndex"}},t._l(t.items,(function(e,r){return n("van-tabbar-item",{key:r,attrs:{url:e.url},scopedSlots:t._u([{key:"icon",fn:function(i){return n("img",{attrs:{src:t.activeIndex==r?e.icon.active:e.icon.normal,alt:""}})}}],null,!0)},[n("span",{class:t.activeIndex==r?"van-tabbar-item--active":""},[t._v(t._s(e.text))])])})),1)],1)},i=[]},ZpcA:function(t,e,n){"use strict";n.r(e);var r=n("G8va"),i=n.n(r);for(var o in r)"default"!==o&&function(t){n.d(e,t,(function(){return r[t]}))}(o);e.default=i.a},"aET+":function(t,e,n){var r,i,o={},a=(r=function(){return window&&document&&document.all&&!window.atob},function(){return void 0===i&&(i=r.apply(this,arguments)),i}),s=function(t,e){return e?e.querySelector(t):document.querySelector(t)},c=function(t){var e={};return function(t,n){if("function"==typeof t)return t();if(void 0===e[t]){var r=s.call(this,t,n);if(window.HTMLIFrameElement&&r instanceof window.HTMLIFrameElement)try{r=r.contentDocument.head}catch(t){r=null}e[t]=r}return e[t]}}(),u=null,f=0,l=[],d=n("9tPo");function p(t,e){for(var n=0;n<t.length;n++){var r=t[n],i=o[r.id];if(i){i.refs++;for(var a=0;a<i.parts.length;a++)i.parts[a](r.parts[a]);for(;a<r.parts.length;a++)i.parts.push(y(r.parts[a],e))}else{var s=[];for(a=0;a<r.parts.length;a++)s.push(y(r.parts[a],e));o[r.id]={id:r.id,refs:1,parts:s}}}}function v(t,e){for(var n=[],r={},i=0;i<t.length;i++){var o=t[i],a=e.base?o[0]+e.base:o[0],s={css:o[1],media:o[2],sourceMap:o[3]};r[a]?r[a].parts.push(s):n.push(r[a]={id:a,parts:[s]})}return n}function h(t,e){var n=c(t.insertInto);if(!n)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var r=l[l.length-1];if("top"===t.insertAt)r?r.nextSibling?n.insertBefore(e,r.nextSibling):n.appendChild(e):n.insertBefore(e,n.firstChild),l.push(e);else if("bottom"===t.insertAt)n.appendChild(e);else{if("object"!=typeof t.insertAt||!t.insertAt.before)throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var i=c(t.insertAt.before,n);n.insertBefore(e,i)}}function b(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t);var e=l.indexOf(t);e>=0&&l.splice(e,1)}function m(t){var e=document.createElement("style");if(void 0===t.attrs.type&&(t.attrs.type="text/css"),void 0===t.attrs.nonce){var r=function(){0;return n.nc}();r&&(t.attrs.nonce=r)}return g(e,t.attrs),h(t,e),e}function g(t,e){Object.keys(e).forEach((function(n){t.setAttribute(n,e[n])}))}function y(t,e){var n,r,i,o;if(e.transform&&t.css){if(!(o="function"==typeof e.transform?e.transform(t.css):e.transform.default(t.css)))return function(){};t.css=o}if(e.singleton){var a=f++;n=u||(u=m(e)),r=O.bind(null,n,a,!1),i=O.bind(null,n,a,!0)}else t.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(n=function(t){var e=document.createElement("link");return void 0===t.attrs.type&&(t.attrs.type="text/css"),t.attrs.rel="stylesheet",g(e,t.attrs),h(t,e),e}(e),r=w.bind(null,n,e),i=function(){b(n),n.href&&URL.revokeObjectURL(n.href)}):(n=m(e),r=C.bind(null,n),i=function(){b(n)});return r(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;r(t=e)}else i()}}t.exports=function(t,e){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");(e=e||{}).attrs="object"==typeof e.attrs?e.attrs:{},e.singleton||"boolean"==typeof e.singleton||(e.singleton=a()),e.insertInto||(e.insertInto="head"),e.insertAt||(e.insertAt="bottom");var n=v(t,e);return p(n,e),function(t){for(var r=[],i=0;i<n.length;i++){var a=n[i];(s=o[a.id]).refs--,r.push(s)}t&&p(v(t,e),e);for(i=0;i<r.length;i++){var s;if(0===(s=r[i]).refs){for(var c=0;c<s.parts.length;c++)s.parts[c]();delete o[s.id]}}}};var _,x=(_=[],function(t,e){return _[t]=e,_.filter(Boolean).join("\n")});function O(t,e,n,r){var i=n?"":r.css;if(t.styleSheet)t.styleSheet.cssText=x(e,i);else{var o=document.createTextNode(i),a=t.childNodes;a[e]&&t.removeChild(a[e]),a.length?t.insertBefore(o,a[e]):t.appendChild(o)}}function C(t,e){var n=e.css,r=e.media;if(r&&t.setAttribute("media",r),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}function w(t,e,n){var r=n.css,i=n.sourceMap,o=void 0===e.convertToAbsoluteUrls&&i;(e.convertToAbsoluteUrls||o)&&(r=d(r)),i&&(r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */");var a=new Blob([r],{type:"text/css"}),s=t.href;t.href=URL.createObjectURL(a),s&&URL.revokeObjectURL(s)}},gIIc:function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,"\n.van-tabbar-item__icon img[data-v-967f518e] {\n    height: 22px;\n}\n.van-tabbar-item--active[data-v-967f518e] {\n    color: #FF4101;\n}\n",""])},n1i5:function(t,e,n){var r=n("gIIc");"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(r,i);r.locals&&(t.exports=r.locals)},o0Sb:function(t,e,n){"use strict";n.r(e);var r=n("rRZy"),i=n.n(r);for(var o in r)"default"!==o&&function(t){n.d(e,t,(function(){return r[t]}))}(o);e.default=i.a},q8cP:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var r=a(n("CpDW")),i=a(n("yodm")),o=n("sJCR");function a(t){return t&&t.__esModule?t:{default:t}}function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function c(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var u={name:"App",components:{TabBar:r.default,ProductListView:i.default},data:function(){return{active:0,categories:[],items:[],searchFields:{catid:""},offset:0,isLoading:!0,isRefreshing:!1,isLoadMore:!1,loadMoreAble:!1}},mounted:function(){this.fetchCategories(),(0,o.bindLoadMore)(this.onLoadMore)},methods:{fetchList:function(){var t=this;this.$get("/product/batchget",function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){c(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},this.searchFields,{offset:this.offset})).then((function(e){t.isLoadMore?t.items=t.items.concat(e.data.items):t.items=e.data.items,t.isLoading=!1,t.isRefreshing=!1,t.isLoadMore=!1,t.loadMoreAble=10===e.data.items.length}))},fetchCategories:function(){var t=this;this.$get("/product/category/getall").then((function(e){t.categories=e.data.items,t.categories.length>0&&(t.searchFields.catid=t.categories[0].catid),t.fetchList()}))},handleTabChange:function(t){this.searchFields.catid=t,this.items=[],this.fetchList()},onRefresh:function(){this.isLoading||this.isLoadMore||(this.offset=0,setTimeout(this.fetchList,1e3))},onLoadMore:function(){this.isLoading||this.isRefreshing||this.isLoadMore||!this.loadMoreAble||(this.offset+=10,this.isLoadMore=!0,this.fetchList())}}};e.default=u},rRZy:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var r={name:"TabBar",data:function(){return{items:[{text:"首页",icon:{normal:"/images/app/tabbar/home.png",active:"/images/app/tabbar/home-fill.png"},url:"/h5/"},{text:"分类",icon:{normal:"/images/app/tabbar/catlog.png",active:"/images/app/tabbar/catlog-fill.png"},url:"/h5/category/"},{text:"购物车",icon:{normal:"/images/app/tabbar/cart.png",active:"/images/app/tabbar/cart-fill.png"},url:"/h5/cart/"},{text:"我的",icon:{normal:"/images/app/tabbar/my.png",active:"/images/app/tabbar/my-fill.png"},url:"/h5/user/"}]}},props:{activeIndex:{default:0,type:Number}}};e.default=r},rwkN:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"item-list-view"},[n("div",{staticClass:"items"},t._l(t.items,(function(e){return n("div",{key:e.itemid,staticClass:"item"},[n("a",{attrs:{href:e.m_url}},[n("div",{staticClass:"inner"},[n("div",{staticClass:"pic-box"},[n("img",{staticClass:"pic",attrs:{src:e.thumb,alt:""}})]),t._v(" "),n("div",{staticClass:"ctx-box"},[n("div",{staticClass:"title"},[t._v(t._s(e.title))]),t._v(" "),n("div",{staticClass:"flex"}),t._v(" "),n("div",{staticClass:"flex-row align-items-center"},[n("div",{staticClass:"price"},[t._v("￥"+t._s(e.price))]),t._v(" "),n("span",{staticClass:"sold"},[t._v("已售"+t._s(e.sold)+"件")])])])])])])})),0)])},i=[]},sJCR:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.bindLoadMore=function(t){window.addEventListener("scroll",(function(){(function(){var t=0,e=0;document.body&&(t=document.body.scrollHeight);document.documentElement&&(e=document.documentElement.scrollHeight);return t-e>0?t:e})()==function(){var t=0,e=0;document.body&&(t=document.body.scrollTop);document.documentElement&&(e=document.documentElement.scrollTop);return t-e>0?t:e}()+function(){var t=0;t="CSS1Compat"===document.compatMode?document.documentElement.clientHeight:document.body.clientHeight;return t}()&&t&&t()}),!1)}},yodm:function(t,e,n){"use strict";n.r(e);var r=n("rwkN"),i=n("ZpcA");for(var o in i)"default"!==o&&function(t){n.d(e,t,(function(){return i[t]}))}(o);var a=n("KHd+"),s=Object(a.a)(i.default,r.a,r.b,!1,null,"45799220",null);e.default=s.exports}});
!function(t){var e={};function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(r,i,function(e){return t[e]}.bind(null,i));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=4)}({"/KSa":function(t,e,n){var r=n("HIQk");"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(r,i);r.locals&&(t.exports=r.locals)},4:function(t,e,n){t.exports=n("yY8B")},"57Ny":function(t,e,n){"use strict";n.r(e);var r=n("A7O9"),i=n.n(r);for(var a in r)"default"!==a&&function(t){n.d(e,t,(function(){return r[t]}))}(a);e.default=i.a},"9tPo":function(t,e){t.exports=function(t){var e="undefined"!=typeof window&&window.location;if(!e)throw new Error("fixUrls requires window.location");if(!t||"string"!=typeof t)return t;var n=e.protocol+"//"+e.host,r=n+e.pathname.replace(/\/[^\/]*$/,"/");return t.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,(function(t,e){var i,a=e.trim().replace(/^"(.*)"$/,(function(t,e){return e})).replace(/^'(.*)'$/,(function(t,e){return e}));return/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(a)?t:(i=0===a.indexOf("//")?a:0===a.indexOf("/")?n+a:r+a.replace(/^\.\//,""),"url("+JSON.stringify(i)+")")}))}},A7O9:function(t,e,n){"use strict";var r;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"App",components:{"tab-bar":((r=n("i7Ep"))&&r.__esModule?r:{default:r}).default},mounted:function(){var t=this;this.$axios.get("/h5/item/batchget").then((function(e){t.items=e.data.items}))},data:function(){return{active:0,catlogs:catlogs,items:[]}},props:{}};e.default=i},GYuu:function(t,e,n){"use strict";n.r(e);var r=n("y2K+"),i=n("57Ny");for(var a in i)"default"!==a&&function(t){n.d(e,t,(function(){return i[t]}))}(a);var o=n("KHd+"),s=Object(o.a)(i.default,r.a,r.b,!1,null,"17f58cf1",null);e.default=s.exports},HIQk:function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,"\n.van-tabbar-item__icon img[data-v-26afbdad] {\n    height: 22px;\n}\n.van-tabbar-item--active[data-v-26afbdad] {\n    color: #30C361;\n}\n",""])},HNlf:function(t,e,n){"use strict";n.r(e);var r=n("mBi3"),i=n.n(r);for(var a in r)"default"!==a&&function(t){n.d(e,t,(function(){return r[t]}))}(a);e.default=i.a},I1BE:function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=function(t,e){var n=t[1]||"",r=t[3];if(!r)return n;if(e&&"function"==typeof btoa){var i=(o=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */"),a=r.sources.map((function(t){return"/*# sourceURL="+r.sourceRoot+t+" */"}));return[n].concat(a).concat([i]).join("\n")}var o;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n})).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var r={},i=0;i<this.length;i++){var a=this[i][0];"number"==typeof a&&(r[a]=!0)}for(i=0;i<t.length;i++){var o=t[i];"number"==typeof o[0]&&r[o[0]]||(n&&!o[2]?o[2]=n:n&&(o[2]="("+o[2]+") and ("+n+")"),e.push(o))}},e}},"KHd+":function(t,e,n){"use strict";function r(t,e,n,r,i,a,o,s){var u,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),r&&(c.functional=!0),a&&(c._scopeId="data-v-"+a),o?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},c._ssrRegister=u):i&&(u=s?function(){i.call(this,this.$root.$options.shadowRoot)}:i),u)if(c.functional){c._injectStyles=u;var f=c.render;c.render=function(t,e){return u.call(e),f(t,e)}}else{var l=c.beforeCreate;c.beforeCreate=l?[].concat(l,u):[u]}return{exports:t,options:c}}n.d(e,"a",(function(){return r}))},LvpB:function(t,e,n){"use strict";var r=n("/KSa");n.n(r).a},TXQJ:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticStyle:{height:"50px"}},[n("van-tabbar",{attrs:{fixed:"true","z-index":"999"},model:{value:t.activeIndex,callback:function(e){t.activeIndex=e},expression:"activeIndex"}},t._l(t.items,(function(e,r){return n("van-tabbar-item",{key:r,attrs:{url:e.url},scopedSlots:t._u([{key:"icon",fn:function(i){return n("img",{attrs:{src:t.activeIndex==r?e.icon.active:e.icon.normal}})}}],null,!0)},[n("span",{class:t.activeIndex==r?"van-tabbar-item--active":""},[t._v(t._s(e.text))])])})),1)],1)},i=[]},"aET+":function(t,e,n){var r,i,a={},o=(r=function(){return window&&document&&document.all&&!window.atob},function(){return void 0===i&&(i=r.apply(this,arguments)),i}),s=function(t,e){return e?e.querySelector(t):document.querySelector(t)},u=function(t){var e={};return function(t,n){if("function"==typeof t)return t();if(void 0===e[t]){var r=s.call(this,t,n);if(window.HTMLIFrameElement&&r instanceof window.HTMLIFrameElement)try{r=r.contentDocument.head}catch(t){r=null}e[t]=r}return e[t]}}(),c=null,f=0,l=[],d=n("9tPo");function p(t,e){for(var n=0;n<t.length;n++){var r=t[n],i=a[r.id];if(i){i.refs++;for(var o=0;o<i.parts.length;o++)i.parts[o](r.parts[o]);for(;o<r.parts.length;o++)i.parts.push(g(r.parts[o],e))}else{var s=[];for(o=0;o<r.parts.length;o++)s.push(g(r.parts[o],e));a[r.id]={id:r.id,refs:1,parts:s}}}}function v(t,e){for(var n=[],r={},i=0;i<t.length;i++){var a=t[i],o=e.base?a[0]+e.base:a[0],s={css:a[1],media:a[2],sourceMap:a[3]};r[o]?r[o].parts.push(s):n.push(r[o]={id:o,parts:[s]})}return n}function b(t,e){var n=u(t.insertInto);if(!n)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var r=l[l.length-1];if("top"===t.insertAt)r?r.nextSibling?n.insertBefore(e,r.nextSibling):n.appendChild(e):n.insertBefore(e,n.firstChild),l.push(e);else if("bottom"===t.insertAt)n.appendChild(e);else{if("object"!=typeof t.insertAt||!t.insertAt.before)throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var i=u(t.insertAt.before,n);n.insertBefore(e,i)}}function h(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t);var e=l.indexOf(t);e>=0&&l.splice(e,1)}function m(t){var e=document.createElement("style");if(void 0===t.attrs.type&&(t.attrs.type="text/css"),void 0===t.attrs.nonce){var r=function(){0;return n.nc}();r&&(t.attrs.nonce=r)}return y(e,t.attrs),b(t,e),e}function y(t,e){Object.keys(e).forEach((function(n){t.setAttribute(n,e[n])}))}function g(t,e){var n,r,i,a;if(e.transform&&t.css){if(!(a="function"==typeof e.transform?e.transform(t.css):e.transform.default(t.css)))return function(){};t.css=a}if(e.singleton){var o=f++;n=c||(c=m(e)),r=C.bind(null,n,o,!1),i=C.bind(null,n,o,!0)}else t.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(n=function(t){var e=document.createElement("link");return void 0===t.attrs.type&&(t.attrs.type="text/css"),t.attrs.rel="stylesheet",y(e,t.attrs),b(t,e),e}(e),r=j.bind(null,n,e),i=function(){h(n),n.href&&URL.revokeObjectURL(n.href)}):(n=m(e),r=w.bind(null,n),i=function(){h(n)});return r(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;r(t=e)}else i()}}t.exports=function(t,e){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");(e=e||{}).attrs="object"==typeof e.attrs?e.attrs:{},e.singleton||"boolean"==typeof e.singleton||(e.singleton=o()),e.insertInto||(e.insertInto="head"),e.insertAt||(e.insertAt="bottom");var n=v(t,e);return p(n,e),function(t){for(var r=[],i=0;i<n.length;i++){var o=n[i];(s=a[o.id]).refs--,r.push(s)}t&&p(v(t,e),e);for(i=0;i<r.length;i++){var s;if(0===(s=r[i]).refs){for(var u=0;u<s.parts.length;u++)s.parts[u]();delete a[s.id]}}}};var _,x=(_=[],function(t,e){return _[t]=e,_.filter(Boolean).join("\n")});function C(t,e,n,r){var i=n?"":r.css;if(t.styleSheet)t.styleSheet.cssText=x(e,i);else{var a=document.createTextNode(i),o=t.childNodes;o[e]&&t.removeChild(o[e]),o.length?t.insertBefore(a,o[e]):t.appendChild(a)}}function w(t,e){var n=e.css,r=e.media;if(r&&t.setAttribute("media",r),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}function j(t,e,n){var r=n.css,i=n.sourceMap,a=void 0===e.convertToAbsoluteUrls&&i;(e.convertToAbsoluteUrls||a)&&(r=d(r)),i&&(r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */");var o=new Blob([r],{type:"text/css"}),s=t.href;t.href=URL.createObjectURL(o),s&&URL.revokeObjectURL(s)}},i7Ep:function(t,e,n){"use strict";n.r(e);var r=n("TXQJ"),i=n("HNlf");for(var a in i)"default"!==a&&function(t){n.d(e,t,(function(){return i[t]}))}(a);n("LvpB");var o=n("KHd+"),s=Object(o.a)(i.default,r.a,r.b,!1,null,"26afbdad",null);e.default=s.exports},mBi3:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var r={name:"TabBar",data:function(){return{items:[{text:"首页",icon:{normal:"/images/h5/tabbar/home.png",active:"/images/h5/tabbar/home-fill.png"},url:"/h5/"},{text:"分类",icon:{normal:"/images/h5/tabbar/catlog.png",active:"/images/h5/tabbar/catlog-fill.png"},url:"/h5/catlog/"},{text:"购物车",icon:{normal:"/images/h5/tabbar/cart.png",active:"/images/h5/tabbar/cart-fill.png"},url:"/h5/cart/"},{text:"我的",icon:{normal:"/images/h5/tabbar/my.png",active:"/images/h5/tabbar/my-fill.png"},url:"/h5/user/"}]}},props:{activeIndex:{default:0,type:Number}}};e.default=r},"y2K+":function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"container"},[n("van-tabs",{attrs:{sticky:""},model:{value:t.active,callback:function(e){t.active=e},expression:"active"}},t._l(t.catlogs,(function(t,e){return n("van-tab",{key:e,attrs:{title:t.name}})})),1),t._v(" "),n("div",{staticClass:"goods-list-view"},t._l(t.items,(function(e){return n("div",{key:e.itemid,staticClass:"goods-list-item"},[n("a",{attrs:{href:e.h5_url}},[n("div",{staticClass:"display-flex"},[n("div",{staticClass:"bg-cover goods-image",style:"background-image: url("+e.thumb+");"}),t._v(" "),n("div",{staticClass:"goods-data"},[n("div",{staticClass:"title"},[t._v(t._s(e.title))]),t._v(" "),n("div",{staticClass:"flex"}),t._v(" "),n("div",{staticClass:"display-flex"},[n("div",{staticClass:"price flex"},[t._v("￥"+t._s(e.price))]),t._v(" "),n("span",{staticClass:"sold"},[t._v("已售"+t._s(e.sold)+"件")])])])])])])})),0),t._v(" "),n("tab-bar",{attrs:{"active-index":"1"}})],1)},i=[]},yY8B:function(t,e,n){"use strict";var r,i=(r=n("GYuu"))&&r.__esModule?r:{default:r};new Vue({el:"#app",render:function(t){return t(i.default)}})}});
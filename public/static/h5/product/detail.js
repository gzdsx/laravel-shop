!function(t){var e={};function n(i){if(e[i])return e[i].exports;var r=e[i]={i:i,l:!1,exports:{}};return t[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,i){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(i,r,function(e){return t[e]}.bind(null,r));return i},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=6)}({"0nZ5":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;e.default={name:"SkuView",props:{product:{}},data:function(){return{sku:{},skuList:{},skuProps:[],quantity:1,selectedProps:{}}},mounted:function(){var t=this,e=this.product,n=e.price,i=e.stock,r=e.skus;this.sku={price:n,stock:i},r.map((function(e){t.skuList[e.properties]=e}))},watch:{},methods:{handleCheckSku:function(t,e){t.attr_values.forEach((function(t,n){t.checked=e===n})),this.getSku(),this.$forceUpdate()},getSku:function(){var t=[];if(this.product.attrs.map((function(e){e.attr_values.map((function(e){e.checked&&t.push(e.attr_id)}))})),t.length>0){var e=t.join("-");this.skuList[e]&&(this.sku=this.skuList[e])}},handleSubmit:function(){if(!this.sku.sku_id)return this.$toast.fail("请选择产品型号"),!1;this.$emit("submit",{sku:this.sku,quantity:this.quantity})}}}},"563t":function(t,e,n){"use strict";n.r(e);var i=n("0nZ5"),r=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,(function(){return i[t]}))}(o);e.default=r.a},"5P8/":function(t,e,n){"use strict";n.r(e);var i=n("g+X5"),r=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,(function(){return i[t]}))}(o);e.default=r.a},6:function(t,e,n){t.exports=n("Jfsb")},"9tPo":function(t,e){t.exports=function(t){var e="undefined"!=typeof window&&window.location;if(!e)throw new Error("fixUrls requires window.location");if(!t||"string"!=typeof t)return t;var n=e.protocol+"//"+e.host,i=n+e.pathname.replace(/\/[^\/]*$/,"/");return t.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,(function(t,e){var r,o=e.trim().replace(/^"(.*)"$/,(function(t,e){return e})).replace(/^'(.*)'$/,(function(t,e){return e}));return/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(o)?t:(r=0===o.indexOf("//")?o:0===o.indexOf("/")?n+o:i+o.replace(/^\.\//,""),"url("+JSON.stringify(r)+")")}))}},BQQl:function(t,e,n){"use strict";n.r(e);var i=n("RZ5b"),r=n("563t");for(var o in r)"default"!==o&&function(t){n.d(e,t,(function(){return r[t]}))}(o);var s=n("KHd+"),a=Object(s.a)(r.default,i.a,i.b,!1,null,"0c3f0dbe",null);e.default=a.exports},Cr5q:function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,".swipe-wrapper[data-v-d49d5d84] {\n  padding-top: 80%;\n  position: relative;\n}\n.swipe-wrapper .item-swipe[data-v-d49d5d84] {\n  position: absolute;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  top: 0;\n}\n.swipe-wrapper .item-swipe-image[data-v-d49d5d84] {\n  width: 100%;\n  height: 100%;\n}",""])},I1BE:function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=function(t,e){var n=t[1]||"",i=t[3];if(!i)return n;if(e&&"function"==typeof btoa){var r=(s=i,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(s))))+" */"),o=i.sources.map((function(t){return"/*# sourceURL="+i.sourceRoot+t+" */"}));return[n].concat(o).concat([r]).join("\n")}var s;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n})).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var i={},r=0;r<this.length;r++){var o=this[r][0];"number"==typeof o&&(i[o]=!0)}for(r=0;r<t.length;r++){var s=t[r];"number"==typeof s[0]&&i[s[0]]||(n&&!s[2]?s[2]=n:n&&(s[2]="("+s[2]+") and ("+n+")"),e.push(s))}},e}},Jfsb:function(t,e,n){"use strict";var i,r=(i=n("nT01"))&&i.__esModule?i:{default:i};new Vue({el:"#app",render:function(t){return t(r.default)}})},"KHd+":function(t,e,n){"use strict";function i(t,e,n,i,r,o,s,a){var u,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),i&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),s?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},c._ssrRegister=u):r&&(u=a?function(){r.call(this,this.$root.$options.shadowRoot)}:r),u)if(c.functional){c._injectStyles=u;var d=c.render;c.render=function(t,e){return u.call(e),d(t,e)}}else{var l=c.beforeCreate;c.beforeCreate=l?[].concat(l,u):[u]}return{exports:t,options:c}}n.d(e,"a",(function(){return i}))},RZ5b:function(t,e,n){"use strict";n.d(e,"a",(function(){return i})),n.d(e,"b",(function(){return r}));var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"sku"},[n("div",{staticClass:"sku-item"},[n("img",{staticClass:"sku-item-thumb",attrs:{src:t.product.thumb,alt:""}}),t._v(" "),n("div",{staticClass:"sku-item-info"},[n("div",{staticClass:"price"},[t._v("￥"+t._s(t.sku.price))]),t._v(" "),n("p",[t._v("剩余"+t._s(t.sku.stock)+"件")]),t._v(" "),n("p",[t._v("已选择:"+t._s(t.sku.title))])])]),t._v(" "),n("div",{staticClass:"sku-attrs"},[n("div",{staticClass:"sku-attrs-content"},[t._l(t.product.attrs,(function(e,i){return n("div",{key:i,staticClass:"sku-attr-group"},[n("div",{staticClass:"attr-title"},[t._v(t._s(e.attr_title))]),t._v(" "),n("div",{staticClass:"attr-values"},t._l(e.attr_values,(function(r,o){return n("div",{key:i,staticClass:"attr-values-item",class:{active:r.checked},on:{click:function(n){return t.handleCheckSku(e,o)}}},[t._v("\n                        "+t._s(r.attr_value)+"\n                    ")])})),0)])})),t._v(" "),n("div",{staticClass:"sku-attr-group display-flex"},[n("div",{staticClass:"flex"},[t._v("购买数量")]),t._v(" "),n("van-stepper",{attrs:{max:t.sku.stock,min:1},model:{value:t.quantity,callback:function(e){t.quantity=e},expression:"quantity"}})],1)],2)]),t._v(" "),n("div",{staticClass:"sku-button-group"},[n("button",{staticClass:"v-btn",on:{click:t.handleSubmit}},[t._v("确定")])])])},r=[]},WDzw:function(t,e,n){var i=n("Cr5q");"string"==typeof i&&(i=[[t.i,i,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(i,r);i.locals&&(t.exports=i.locals)},"aET+":function(t,e,n){var i,r,o={},s=(i=function(){return window&&document&&document.all&&!window.atob},function(){return void 0===r&&(r=i.apply(this,arguments)),r}),a=function(t,e){return e?e.querySelector(t):document.querySelector(t)},u=function(t){var e={};return function(t,n){if("function"==typeof t)return t();if(void 0===e[t]){var i=a.call(this,t,n);if(window.HTMLIFrameElement&&i instanceof window.HTMLIFrameElement)try{i=i.contentDocument.head}catch(t){i=null}e[t]=i}return e[t]}}(),c=null,d=0,l=[],f=n("9tPo");function p(t,e){for(var n=0;n<t.length;n++){var i=t[n],r=o[i.id];if(r){r.refs++;for(var s=0;s<r.parts.length;s++)r.parts[s](i.parts[s]);for(;s<i.parts.length;s++)r.parts.push(y(i.parts[s],e))}else{var a=[];for(s=0;s<i.parts.length;s++)a.push(y(i.parts[s],e));o[i.id]={id:i.id,refs:1,parts:a}}}}function v(t,e){for(var n=[],i={},r=0;r<t.length;r++){var o=t[r],s=e.base?o[0]+e.base:o[0],a={css:o[1],media:o[2],sourceMap:o[3]};i[s]?i[s].parts.push(a):n.push(i[s]={id:s,parts:[a]})}return n}function h(t,e){var n=u(t.insertInto);if(!n)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var i=l[l.length-1];if("top"===t.insertAt)i?i.nextSibling?n.insertBefore(e,i.nextSibling):n.appendChild(e):n.insertBefore(e,n.firstChild),l.push(e);else if("bottom"===t.insertAt)n.appendChild(e);else{if("object"!=typeof t.insertAt||!t.insertAt.before)throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var r=u(t.insertAt.before,n);n.insertBefore(e,r)}}function m(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t);var e=l.indexOf(t);e>=0&&l.splice(e,1)}function b(t){var e=document.createElement("style");if(void 0===t.attrs.type&&(t.attrs.type="text/css"),void 0===t.attrs.nonce){var i=function(){0;return n.nc}();i&&(t.attrs.nonce=i)}return _(e,t.attrs),h(t,e),e}function _(t,e){Object.keys(e).forEach((function(n){t.setAttribute(n,e[n])}))}function y(t,e){var n,i,r,o;if(e.transform&&t.css){if(!(o="function"==typeof e.transform?e.transform(t.css):e.transform.default(t.css)))return function(){};t.css=o}if(e.singleton){var s=d++;n=c||(c=b(e)),i=w.bind(null,n,s,!1),r=w.bind(null,n,s,!0)}else t.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(n=function(t){var e=document.createElement("link");return void 0===t.attrs.type&&(t.attrs.type="text/css"),t.attrs.rel="stylesheet",_(e,t.attrs),h(t,e),e}(e),i=x.bind(null,n,e),r=function(){m(n),n.href&&URL.revokeObjectURL(n.href)}):(n=b(e),i=C.bind(null,n),r=function(){m(n)});return i(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;i(t=e)}else r()}}t.exports=function(t,e){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");(e=e||{}).attrs="object"==typeof e.attrs?e.attrs:{},e.singleton||"boolean"==typeof e.singleton||(e.singleton=s()),e.insertInto||(e.insertInto="head"),e.insertAt||(e.insertAt="bottom");var n=v(t,e);return p(n,e),function(t){for(var i=[],r=0;r<n.length;r++){var s=n[r];(a=o[s.id]).refs--,i.push(a)}t&&p(v(t,e),e);for(r=0;r<i.length;r++){var a;if(0===(a=i[r]).refs){for(var u=0;u<a.parts.length;u++)a.parts[u]();delete o[a.id]}}}};var k,g=(k=[],function(t,e){return k[t]=e,k.filter(Boolean).join("\n")});function w(t,e,n,i){var r=n?"":i.css;if(t.styleSheet)t.styleSheet.cssText=g(e,r);else{var o=document.createTextNode(r),s=t.childNodes;s[e]&&t.removeChild(s[e]),s.length?t.insertBefore(o,s[e]):t.appendChild(o)}}function C(t,e){var n=e.css,i=e.media;if(i&&t.setAttribute("media",i),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}function x(t,e,n){var i=n.css,r=n.sourceMap,o=void 0===e.convertToAbsoluteUrls&&r;(e.convertToAbsoluteUrls||o)&&(i=f(i)),r&&(i+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(r))))+" */");var s=new Blob([i],{type:"text/css"}),a=t.href;t.href=URL.createObjectURL(s),a&&URL.revokeObjectURL(a)}},"g+X5":function(t,e,n){"use strict";var i;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var r={name:"ProductDetail",components:{SkuView:((i=n("BQQl"))&&i.__esModule?i:{default:i}).default},data:function(){return{product:{},images:[],content:{},sku:{},quantity:1,showSku:!1,actionType:1}},mounted:function(){var t=this,e=pageConfig.itemid;this.$get("/api/product/get",{itemid:e}).then((function(e){var n=e.data.product,i=n.images,r=n.content;t.product=n,t.images=i,t.content=r}))},methods:{handleAddToCart:function(){this.product.skus.length>0?(this.showSku=!0,this.actionType=1):this.addToCart(this.product.itemid,1)},handleBuyNow:function(){this.product.skus.length>0?(this.showSku=!0,this.actionType=2):this.submitForm()},addToCart:function(t,e){var n=this,i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0;this.$post("/api/cart/create",{itemid:t,quantity:e,sku_id:i}).then((function(t){n.$toast.success("已成功加入购物车")}))},openKefu:function(){wx.closeWindow()},submitForm:function(){this.$refs.form.submit()},showCart:function(){window.location.replace("/h5/cart")},onSubmit:function(t){var e=this,n=this.product.itemid,i=t.sku,r=t.quantity;this.sku=i,this.quantity=r,this.showSku=!1,setTimeout((function(){1===e.actionType?e.addToCart(n,r,i.sku_id):e.submitForm()}),300)}}};e.default=r},i2qY:function(t,e,n){"use strict";n.d(e,"a",(function(){return i})),n.d(e,"b",(function(){return r}));var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"container"},[n("div",{staticClass:"swipe-wrapper"},[n("van-swipe",{staticClass:"item-swipe",attrs:{autoplay:3e3,"indicator-color":"white"}},t._l(t.images,(function(t,e){return n("van-swipe-item",{key:e},[n("div",{staticClass:"bg-cover swipe-image",style:"background-image: url("+t.image+");"})])})),1)],1),t._v(" "),n("div",{staticClass:"goods-info"},[n("div",{staticClass:"title"},[t._v(t._s(t.product.title))]),t._v(" "),n("div",{staticClass:"subtitle"},[t._v(t._s(t.product.subtitle))]),t._v(" "),n("div",{staticClass:"flex-row align-items-center",staticStyle:{"margin-top":"10px"}},[n("div",{staticClass:"price flex"},[t._v("￥"+t._s(t.product.price))]),t._v(" "),n("div",{staticClass:"sold"},[t._v("已售"+t._s(t.product.sold)+"件")])])]),t._v(" "),n("div",{staticClass:"goods-desc"},[n("div",{staticClass:"title"},[t._v("商品详情")]),t._v(" "),n("div",{staticClass:"content",domProps:{innerHTML:t._s(t.content.content)}})]),t._v(" "),n("div",{staticClass:"h50"}),t._v(" "),n("van-goods-action",[n("van-goods-action-icon",{attrs:{icon:"chat-o",text:"客服"},on:{click:t.openKefu}}),t._v(" "),n("van-goods-action-icon",{attrs:{icon:"cart-o",text:"购物车"},on:{click:t.showCart}}),t._v(" "),n("van-goods-action-button",{attrs:{type:"warning",text:"加入购物车"},on:{click:t.handleAddToCart}}),t._v(" "),n("van-goods-action-button",{attrs:{type:"danger",text:"立即购买"},on:{click:t.handleBuyNow}})],1),t._v(" "),n("van-popup",{attrs:{position:"bottom"},model:{value:t.showSku,callback:function(e){t.showSku=e},expression:"showSku"}},[n("sku-view",{attrs:{product:t.product},on:{submit:t.onSubmit}})],1),t._v(" "),n("form",{ref:"form",attrs:{action:"/h5/order/buynow"}},[n("input",{attrs:{type:"hidden",name:"token"},domProps:{value:t.$csrfToken}}),t._v(" "),n("input",{attrs:{type:"hidden",name:"itemid"},domProps:{value:t.product.itemid}}),t._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:t.sku.sku_id,expression:"sku.sku_id"}],attrs:{type:"hidden",name:"sku_id"},domProps:{value:t.sku.sku_id},on:{input:function(e){e.target.composing||t.$set(t.sku,"sku_id",e.target.value)}}}),t._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:t.quantity,expression:"quantity"}],attrs:{type:"hidden",name:"quantity"},domProps:{value:t.quantity},on:{input:function(e){e.target.composing||(t.quantity=e.target.value)}}})])],1)},r=[]},kPqi:function(t,e,n){"use strict";var i=n("WDzw");n.n(i).a},nT01:function(t,e,n){"use strict";n.r(e);var i=n("i2qY"),r=n("5P8/");for(var o in r)"default"!==o&&function(t){n.d(e,t,(function(){return r[t]}))}(o);n("kPqi");var s=n("KHd+"),a=Object(s.a)(r.default,i.a,i.b,!1,null,"d49d5d84",null);e.default=a.exports}});
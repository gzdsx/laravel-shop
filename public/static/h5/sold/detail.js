!function(e){var t={};function s(r){if(t[r])return t[r].exports;var i=t[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,s),i.l=!0,i.exports}s.m=e,s.c=t,s.d=function(e,t,r){s.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},s.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},s.t=function(e,t){if(1&t&&(e=s(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(s.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)s.d(r,i,function(t){return e[t]}.bind(null,i));return r},s.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return s.d(t,"a",t),t},s.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},s.p="/",s(s.s=10)}({"/kdL":function(e,t,s){"use strict";s.r(t);var r=s("DZ0z"),i=s("E7Sp");for(var n in i)"default"!==n&&function(e){s.d(t,e,(function(){return i[e]}))}(n);var o=s("KHd+"),a=Object(o.a)(i.default,r.a,r.b,!1,null,"081c9e12",null);t.default=a.exports},10:function(e,t,s){e.exports=s("5K43")},"1DPS":function(e,t,s){"use strict";s.d(t,"a",(function(){return r})),s.d(t,"b",(function(){return i}));var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"order-detail"},[s("div",{staticClass:"order-state"},[s("div",{staticClass:"order-state-text"},[s("span",[e._v(e._s(e.order.seller_state_des))])]),e._v(" "),s("div",{staticClass:"order-state-icon"},[1===e.order.order_state?s("span",{staticClass:"iconfont icon-pay"}):e._e(),e._v(" "),2===e.order.order_state?s("span",{staticClass:"iconfont icon-send1"}):e._e(),e._v(" "),3===e.order.order_state?s("span",{staticClass:"iconfont icon-deliver"}):e._e(),e._v(" "),4===e.order.order_state?s("span",{staticClass:"iconfont icon-evaluate"}):e._e(),e._v(" "),5===e.order.order_state?s("span",{staticClass:"iconfont icon-refund"}):e._e(),e._v(" "),6===e.order.order_state?s("span",{staticClass:"iconfont icon-close-circle"}):e._e()])]),e._v(" "),e.order.shipping?s("div",{staticClass:"shipping-address"},[e._m(0),e._v(" "),s("div",{staticClass:"flex"},[s("div",{staticClass:"display-flex"},[s("div",{staticClass:"flex"},[e._v(e._s(e.order.shipping.name))]),e._v(" "),s("div",[e._v(e._s(e.order.shipping.tel))])]),e._v(" "),s("div",[e._v("\n                "+e._s(e.order.shipping.full_address)+"\n            ")])])]):e._e(),e._v(" "),s("div",{staticClass:"order-section-title flex-row align-items-center"},[s("div",{staticClass:"flex-fill"},[e._v("商品信息")]),e._v(" "),s("div",[1===e.order.order_state?s("p",[s("a",{staticStyle:{color:"dodgerblue"},on:{click:function(t){return e.handleShowEdit(e.item)}}},[e._v("修改价格")])]):e._e()])]),e._v(" "),s("div",{staticClass:"order-items"},e._l(e.order.items,(function(t,r){return s("div",{key:r,staticClass:"item"},[s("div",{staticClass:"pic-box"},[s("img",{staticClass:"pic",attrs:{src:t.thumb,alt:""}})]),e._v(" "),s("div",{staticClass:"ctx-box"},[s("div",{staticClass:"flex-row"},[s("div",{staticClass:"title-box"},[s("div",{staticClass:"title"},[e._v(e._s(t.title))]),e._v(" "),s("div",{staticClass:"sku-title"},[e._v(e._s(t.sku_title))])]),e._v(" "),s("div",{staticClass:"right-box"},[s("p",[e._v("￥"+e._s(t.price))]),e._v(" "),s("i",[e._v("x"+e._s(t.quantity))])])]),e._v(" "),s("div",{staticClass:"flex-fill"}),e._v(" "),s("div",{staticClass:"flex-row justify-content-end"})])])})),0),e._v(" "),s("div",{staticClass:"order-info-cell"},[s("div",{staticClass:"cell-title"},[e._v("商品总价")]),e._v(" "),s("div",{staticClass:"cell-value"},[e._v("￥"+e._s(e.order.product_fee))])]),e._v(" "),s("div",{staticClass:"order-info-cell"},[s("div",{staticClass:"cell-title"},[e._v("运费")]),e._v(" "),s("div",{staticClass:"cell-value"},[e._v("+￥"+e._s(e.order.shipping_fee))])]),e._v(" "),s("div",{staticClass:"order-info-cell"},[s("div",{staticClass:"cell-title"},[e._v("优惠")]),e._v(" "),s("div",{staticClass:"cell-value"},[e._v("-￥"+e._s(e.order.discount_fee))])]),e._v(" "),s("div",{staticClass:"order-info-cell"},[s("div",{staticClass:"cell-title"},[e._v("实付金额")]),e._v(" "),s("div",{staticClass:"cell-value",staticStyle:{color:"#f40"}},[e._v("￥"+e._s(e.order.order_fee))])]),e._v(" "),s("div",{staticClass:"h20"}),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("订单编号: "+e._s(e.order.order_no))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("创建时间: "+e._s(e.order.created_at))]),e._v(" "),e.order.pay_state?s("div",{staticClass:"order-data-cell"},[e._v("付款时间: "+e._s(e.order.pay_at))]):e._e(),e._v(" "),e.order.order_state>3?s("div",{staticClass:"order-data-cell"},[e._v("成交时间: "+e._s(e.order.finished_at))]):e._e(),e._v(" "),s("div",{staticClass:"h20"}),e._v(" "),e.order.shipping_state?s("div",[s("h3",{staticStyle:{"font-size":"16px",padding:"0 10px","margin-bottom":"10px"}},[e._v("发货信息")]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("快递名称: "+e._s(e.order.shipping.express_name))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("快递单号: "+e._s(e.order.shipping.express_no))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("发货时间: "+e._s(e.order.shipping_at))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("收 货 人: "+e._s(e.order.shipping.name))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("联系电话: "+e._s(e.order.shipping.tel))]),e._v(" "),s("div",{staticClass:"order-data-cell"},[e._v("收货地址: "+e._s(e.order.shipping.full_address))]),e._v(" "),s("div",{staticClass:"h20"})]):e._e(),e._v(" "),2===e.order.order_state?s("send-view",{on:{send:e.handleSend}}):e._e(),e._v(" "),s("van-popup",{attrs:{position:"bottom",title:"修改价格",closeable:""},model:{value:e.showPopup,callback:function(t){e.showPopup=t},expression:"showPopup"}},[s("div",{staticStyle:{padding:"20px 0 40px"}},[s("van-field",{attrs:{label:"订单实付金额:",type:"number",size:"large","label-width":"110px"},model:{value:e.order_fee,callback:function(t){e.order_fee=t},expression:"order_fee"}}),e._v(" "),s("div",{staticStyle:{padding:"15px","margin-top":"30px"}},[s("van-button",{attrs:{round:"",block:"",type:"info"},on:{click:e.handleSubmit}},[e._v("\n                    提交\n                ")])],1)],1)])],1)},i=[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"shipping-address-icon"},[t("span",{staticClass:"iconfont icon-location"})])}]},"5B0s":function(e,t,s){"use strict";s.r(t);var r=s("1DPS"),i=s("GCGP");for(var n in i)"default"!==n&&function(e){s.d(t,e,(function(){return i[e]}))}(n);var o=s("KHd+"),a=Object(o.a)(i.default,r.a,r.b,!1,null,"70c0ff44",null);t.default=a.exports},"5K43":function(e,t,s){"use strict";var r,i=(r=s("5B0s"))&&r.__esModule?r:{default:r};new Vue({el:"#app",render:function(e){return e(i.default)}})},DQ1Z:function(e,t,s){"use strict";s.r(t);var r=s("zIqL"),i=s("r0pz");for(var n in i)"default"!==n&&function(e){s.d(t,e,(function(){return i[e]}))}(n);var o=s("KHd+"),a=Object(o.a)(i.default,r.a,r.b,!1,null,"464e7603",null);t.default=a.exports},DZ0z:function(e,t,s){"use strict";s.d(t,"a",(function(){return r})),s.d(t,"b",(function(){return i}));var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("van-form",{on:{submit:e.handleSubmit}},[s("div",[s("van-cell",[s("div",{staticClass:"display-flex"},[s("div",{staticClass:"w60"},[e._v("商品")]),e._v(" "),s("div",{staticClass:"flex"},[e._v(e._s(e.item.title))])])]),e._v(" "),s("van-field",{attrs:{name:"price",label:"单价",type:"number","label-width":"60px",rules:[{required:!0}]},model:{value:e.item.price,callback:function(t){e.$set(e.item,"price",t)},expression:"item.price"}}),e._v(" "),s("van-field",{attrs:{name:"quantity",label:"数量",type:"number","label-width":"60px",rules:[{required:!0}]},model:{value:e.item.quantity,callback:function(t){e.$set(e.item,"quantity",t)},expression:"item.quantity"}})],1),e._v(" "),s("div",{staticStyle:{margin:"16px"}},[s("van-button",{attrs:{round:"",block:"",type:"info","native-type":"submit"}},[e._v("\n            提交\n        ")])],1)])},i=[]},E7Sp:function(e,t,s){"use strict";s.r(t);var r=s("Yf6m"),i=s.n(r);for(var n in r)"default"!==n&&function(e){s.d(t,e,(function(){return r[e]}))}(n);t.default=i.a},GCGP:function(e,t,s){"use strict";s.r(t);var r=s("HC/8"),i=s.n(r);for(var n in r)"default"!==n&&function(e){s.d(t,e,(function(){return r[e]}))}(n);t.default=i.a},"HC/8":function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=n(s("DQ1Z")),i=n(s("/kdL"));function n(e){return e&&e.__esModule?e:{default:e}}function o(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function a(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?o(Object(s),!0).forEach((function(t){l(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function l(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var d={name:"OrderDetail",components:{SendView:r.default,EditPrice:i.default},data:function(){return a({},pageConfig,{order:{},showPopup:!1,editItem:{},order_fee:0})},props:{},mounted:function(){this.getOrder()},methods:{handleSend:function(e){var t=this;this.$axios.post("/sold/send",a({},e,{order_id:this.order.order_id})).then((function(e){t.$toast.success("发货成功"),t.getOrder()}))},handleSavePrice:function(e){this.getOrder(),this.showPopup=!1},handleShowEdit:function(e){this.editItem=e,this.showPopup=!0},getOrder:function(){var e=this;this.$get("/sold/get?order_id="+this.order_id).then((function(t){e.order=t.result.order,e.order_fee=e.order.order_fee}))},handleSubmit:function(){var e=this;if(this.total_fee<0)return this.$toast.fail("订单总价不能小于0"),!1;var t=this.order.order_id,s=this.order_fee;this.$post("/sold/adjustprice",{order_id:t,order_fee:s}).then((function(t){e.showPopup=!1,e.$toast.success("价格修改成功"),e.getOrder()}))}}};t.default=d},"KHd+":function(e,t,s){"use strict";function r(e,t,s,r,i,n,o,a){var l,d="function"==typeof e?e.options:e;if(t&&(d.render=t,d.staticRenderFns=s,d._compiled=!0),r&&(d.functional=!0),n&&(d._scopeId="data-v-"+n),o?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(o)},d._ssrRegister=l):i&&(l=a?function(){i.call(this,this.$root.$options.shadowRoot)}:i),l)if(d.functional){d._injectStyles=l;var c=d.render;d.render=function(e,t){return l.call(t),c(e,t)}}else{var u=d.beforeCreate;d.beforeCreate=u?[].concat(u,l):[l]}return{exports:e,options:d}}s.d(t,"a",(function(){return r}))},"VKn+":function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r={name:"SendView",props:{expresses:Array},data:function(){return{showPopup:!1,express_id:0,express_code:"",express_name:"",express_no:"",expresses:[]}},mounted:function(){this.fetchExpress()},methods:{fetchExpress:function(){var e=this;this.$get("/express/getall").then((function(t){e.expresses=t.result.items.map((function(e){return{text:e.name,value:e}}))}))},onSubmit:function(e){this.$emit("send",{express_id:this.express_id,express_name:this.express_name,express_no:this.express_no,express_code:this.express_code})},onConfirm:function(e){var t=e.value,s=t.id,r=t.name,i=t.code;this.express_id=s,this.express_name=r,this.express_code=i,this.showPopup=!1},onScan:function(){var e=this;wx.scanQRCode({needResult:1,scanType:["qrCode","barCode"],success:function(t){var s=t.resultStr.split(",");s[1]?e.express_no=s[1]:e.express_no=t.resultStr}})}}};t.default=r},Yf6m:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r={name:"EditPrice",data:function(){return{}},props:{item:Object},methods:{handleSubmit:function(e){var t=this,s=this.item,r=s.id,i=s.price,n=s.quantity;this.$post("/sold/editprice",{id:r,price:i,quantity:n}).then((function(e){t.$emit("save",t.item)}))}}};t.default=r},r0pz:function(e,t,s){"use strict";s.r(t);var r=s("VKn+"),i=s.n(r);for(var n in r)"default"!==n&&function(e){s.d(t,e,(function(){return r[e]}))}(n);t.default=i.a},zIqL:function(e,t,s){"use strict";s.d(t,"a",(function(){return r})),s.d(t,"b",(function(){return i}));var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("van-form",{on:{submit:e.onSubmit}},[s("van-field",{attrs:{name:"express_name",label:"快递",placeholder:"请选择快递公司",rules:[{required:!0,message:"请选择快递公司"}],readonly:""},on:{click:function(t){e.showPopup=!0}},model:{value:e.express_name,callback:function(t){e.express_name=t},expression:"express_name"}}),e._v(" "),s("van-field",{attrs:{type:"text",name:"express_no",label:"单号",placeholder:"请填写快递单号",rules:[{required:!0,message:"快递单号不能为空"}]},model:{value:e.express_no,callback:function(t){e.express_no=t},expression:"express_no"}},[s("span",{staticClass:"iconfont icon-scan font-24",attrs:{slot:"right-icon"},on:{click:e.onScan},slot:"right-icon"})]),e._v(" "),s("div",{staticStyle:{margin:"16px"}},[s("van-button",{attrs:{round:"",block:"",type:"info","native-type":"submit"}},[e._v("\n            提交\n        ")])],1),e._v(" "),s("van-popup",{attrs:{position:"bottom"},model:{value:e.showPopup,callback:function(t){e.showPopup=t},expression:"showPopup"}},[s("van-picker",{attrs:{columns:e.expresses,"show-toolbar":"",title:"选择快递公司"},on:{confirm:e.onConfirm}})],1)],1)},i=[]}});
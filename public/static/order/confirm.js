!function(t){var e={};function s(a){if(e[a])return e[a].exports;var r=e[a]={i:a,l:!1,exports:{}};return t[a].call(r.exports,r,r.exports,s),r.l=!0,r.exports}s.m=t,s.c=e,s.d=function(t,e,a){s.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},s.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(s.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)s.d(a,r,function(e){return t[e]}.bind(null,r));return a},s.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},s.p="/",s(s.s=18)}({18:function(t,e,s){t.exports=s("JrVn")},"6aaD":function(t,e,s){"use strict";s.r(e);var a=s("mmJj"),r=s.n(a);for(var i in a)"default"!==i&&function(t){s.d(e,t,(function(){return a[t]}))}(i);e.default=r.a},JrVn:function(t,e,s){"use strict";var a,r=(a=s("KvjX"))&&a.__esModule?a:{default:a};new Vue({el:"#app",render:function(t){return t(r.default)}})},"KHd+":function(t,e,s){"use strict";function a(t,e,s,a,r,i,n,d){var o,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=s,l._compiled=!0),a&&(l.functional=!0),i&&(l._scopeId="data-v-"+i),n?(o=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(n)},l._ssrRegister=o):r&&(o=d?function(){r.call(this,this.$root.$options.shadowRoot)}:r),o)if(l.functional){l._injectStyles=o;var c=l.render;l.render=function(t,e){return o.call(e),c(t,e)}}else{var u=l.beforeCreate;l.beforeCreate=u?[].concat(u,o):[o]}return{exports:t,options:l}}s.d(e,"a",(function(){return a}))},KvjX:function(t,e,s){"use strict";s.r(e);var a=s("T9C6"),r=s("Rukd");for(var i in r)"default"!==i&&function(t){s.d(e,t,(function(){return r[t]}))}(i);var n=s("KHd+"),d=Object(n.a)(r.default,a.a,a.b,!1,null,"5aeee9a5",null);e.default=d.exports},Rukd:function(t,e,s){"use strict";s.r(e);var a=s("Yg+7"),r=s.n(a);for(var i in a)"default"!==i&&function(t){s.d(e,t,(function(){return a[t]}))}(i);e.default=r.a},T9C6:function(t,e,s){"use strict";s.d(e,"a",(function(){return a})),s.d(e,"b",(function(){return r}));var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"area"},[s("div",{staticClass:"order-address"},[t._m(0),t._v(" "),s("ul",{staticClass:"address-list",attrs:{id:"address-list"}},t._l(t.addresses,(function(e){return s("li",[s("a",{staticClass:"edit-address",on:{click:function(s){return t.handleEditAddress(e)}}},[t._v("修改本地址")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.address,expression:"address"}],attrs:{title:"",type:"radio"},domProps:{value:e,checked:t._q(t.address,e)},on:{change:function(s){t.address=e}}}),t._v(" "),s("span",[t._v(t._s(e.full_address)+"  ("+t._s(e.name)+" 收) "+t._s(e.tel))])])})),0),t._v(" "),s("div",{staticClass:"use-new-address"},[s("a",{staticClass:"button",on:{click:function(e){return t.handleAddAddress()}}},[t._v("+使用新地址")])])]),t._v(" "),s("div",{staticClass:"blank"}),t._v(" "),s("div",{staticClass:"container"},[s("h3",[t._v("确认订单信息")]),t._v(" "),s("table",{staticClass:"order-table"},[t._m(1),t._v(" "),s("tbody",t._l(t.items,(function(e,a){return s("tr",{key:a},[s("td",[s("div",{staticClass:"item-info"},[s("img",{staticClass:"thumb",attrs:{src:e.thumb,alt:""}}),t._v(" "),s("div",{staticClass:"more-info"},[s("div",{staticClass:"item-title"},[t._v(t._s(e.title))]),t._v(" "),s("div",{staticClass:"item-attr"},[t._v(t._s(e.sku_title))])])])]),t._v(" "),s("td",[t._v(t._s(e.price))]),t._v(" "),s("td",[t._v(t._s(e.quantity))]),t._v(" "),s("td",[t._v("￥"+t._s(t.simpleTotal(e)))])])})),0)]),t._v(" "),s("div",{staticClass:"order-extra"},[s("div",{staticClass:"order-extra-row"},[s("div",{staticClass:"col-label"},[t._v("给掌柜留言:")]),t._v(" "),s("div",{staticClass:"col-input"},[s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.remark,expression:"remark"}],staticClass:"textarea",attrs:{placeholder:"选填:对本次交易的说明"},domProps:{value:t.remark},on:{input:function(e){e.target.composing||(t.remark=e.target.value)}}})]),t._v(" "),s("div",[t._v("合计: "),s("span",{staticClass:"total-fee"},[t._v(t._s(t.totalFee))]),t._v("元")])]),t._v(" "),s("div",{staticClass:"order-extra-row"},[s("div",{staticClass:"col-label"},[t._v("运送方式:")]),t._v(" "),s("div",{staticClass:"col-input"},[s("label",[s("input",{directives:[{name:"model",rawName:"v-model",value:t.shipping_type,expression:"shipping_type"}],attrs:{type:"radio"},domProps:{value:1,checked:t._q(t.shipping_type,1)},on:{change:function(e){t.shipping_type=1}}}),t._v(" 快递")]),t._v(" "),s("label",[s("input",{directives:[{name:"model",rawName:"v-model",value:t.shipping_type,expression:"shipping_type"}],attrs:{type:"radio"},domProps:{value:2,checked:t._q(t.shipping_type,2)},on:{change:function(e){t.shipping_type=2}}}),t._v(" 物流配送")]),t._v(" "),s("label",[s("input",{directives:[{name:"model",rawName:"v-model",value:t.shipping_type,expression:"shipping_type"}],attrs:{type:"radio"},domProps:{value:3,checked:t._q(t.shipping_type,3)},on:{change:function(e){t.shipping_type=3}}}),t._v(" 上门自取")])])])]),t._v(" "),s("div",{staticClass:"order-btns"},[s("div",{staticClass:"flex"}),t._v(" "),s("button",{staticClass:"btn-submit",attrs:{type:"button"},on:{click:function(e){return t.submit()}}},[t._v("提交订单")])])]),t._v(" "),s("address-form",{attrs:{address:t.address},on:{saved:t.handleSavedAddress},model:{value:t.showDialog,callback:function(e){t.showDialog=e},expression:"showDialog"}})],1)},r=[function(){var t=this.$createElement,e=this._self._c||t;return e("h3",{staticClass:"confirm-address"},[e("a",{staticClass:"manage-address",attrs:{href:"/user/#/address",target:"_blank"}},[this._v("管理收货地址")]),this._v(" "),e("span",[this._v("确认收货地址")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",[e("th",{staticClass:"align-left"},[this._v("宝贝")]),this._v(" "),e("th",{attrs:{width:"125"}},[this._v("单价")]),this._v(" "),e("th",{attrs:{width:"100"}},[this._v("数量")]),this._v(" "),e("th",{attrs:{width:"100"}},[this._v("小计")])])])}]},"Yg+7":function(t,e,s){"use strict";var a;function r(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,a)}return s}function i(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"ConfirmOrder",components:{AddressForm:((a=s("j5I1"))&&a.__esModule?a:{default:a}).default},data:function(){return function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?r(Object(s),!0).forEach((function(e){i(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):r(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},pageConfig,{remark:"",address:{},shipping_type:1,showDialog:!1})},mounted:function(){var t=this;this.addresses.map((function(e){e.isdefault&&(t.address_id=e.address_id)}))},computed:{totalFee:function(){return this.items.reduce((function(t,e){return t+e.quantity*e.price}),0).toFixed(2)}},methods:{decrease:function(t){t.quantity>1&&t.quantity--},increase:function(t){t.quantity++},submit:function(){if(!this.address.address_id)return this.$showToast("请选择收货地址"),!1;var t=this.items.map((function(t){return t.itemid}));this.$post("/api/order/settlement",{items:t,remark:this.remark,address:this.address}).then((function(t){var e=t.data.order;window.location.href="/order/pay?order_id="+e.order_id}))},handleAddAddress:function(){this.address={},this.showDialog=!0},handleEditAddress:function(t){this.address=t,this.showDialog=!0},handleSavedAddress:function(t){var e=this;this.address.address_id?this.addresses.map((function(s,a){s.address_id===t.address_id&&e.addresses.splice(a,1,t)})):this.addresses.push(t)},simpleTotal:function(t){return(t.price*t.quantity).toFixed(2)}}};e.default=n},j5I1:function(t,e,s){"use strict";s.r(e);var a=s("oU97"),r=s("6aaD");for(var i in r)"default"!==i&&function(t){s.d(e,t,(function(){return r[t]}))}(i);var n=s("KHd+"),d=Object(n.a)(r.default,a.a,a.b,!1,null,"fc1a2f0a",null);e.default=d.exports},mmJj:function(t,e,s){"use strict";function a(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,a)}return s}function r(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"AddressForm",model:{prop:"show",event:"change"},props:{address:{address_id:0},show:!1},data:function(){return{props:{lazy:!0,value:"name",label:"name",lazyLoad:function(t,e){var s=t.level,i=t.data?t.data.id:0;axios.get("/api/district/batchget?fid="+i).then((function(t){var i=t.data.items.map((function(t){return function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?a(Object(s),!0).forEach((function(e){r(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):a(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},t,{leaf:s>=2})}));e(i)}))}},cities:[],visiable:!1,cascader:null}},mounted:function(){},methods:{handleSave:function(){var t=this;return this.address.name?this.address.tel?0===this.cities.length?(this.$showToast("请选择所在地区"),!1):(this.address.province=this.cities[0],this.address.city=this.cities[1],this.address.district=this.cities[2],this.address.street?(this.showDialog=!1,void this.$post("/api/address/save",{address_id:this.address.address_id||0,address:this.address}).then((function(e){t.$showToast("地址保存成功"),t.visiable=!1,t.$emit("saved",e.data.address)}))):(this.$showToast("请填写详细地址"),!1)):(this.$showToast("请填写联系电话"),!1):(this.$showToast("请填写姓名"),!1)},setSascaderValue:function(){var t=this.$refs.cascader;t&&(t.panel.activePath=[],t.panel.loadCount=0,t.panel.lazyLoad())}},watch:{visiable:function(t){this.$emit("change",t)},show:function(t){this.visiable=t},address:function(t){var e=this.address;e.province&&(this.cities=[e.province,e.city,e.district]),this.$nextTick(this.setSascaderValue)}}};e.default=i},oU97:function(t,e,s){"use strict";s.d(e,"a",(function(){return a})),s.d(e,"b",(function(){return r}));var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("el-dialog",{attrs:{title:"编辑地址",visible:t.visiable,"close-on-click-modal":!1,"close-on-press-escape":!1},on:{"update:visible":function(e){t.visiable=e}}},[s("table",{staticClass:"dsxui-formtable"},[s("colgroup",[s("col",{staticClass:"w90"}),t._v(" "),s("col")]),t._v(" "),s("tbody",[s("tr",[s("td",{staticClass:"cell-label"},[t._v("收货人")]),t._v(" "),s("td",[s("el-input",{staticClass:"w300",attrs:{size:"medium"},model:{value:t.address.name,callback:function(e){t.$set(t.address,"name",e)},expression:"address.name"}})],1)]),t._v(" "),s("tr",[s("td",{staticClass:"cell-label"},[t._v("联系电话")]),t._v(" "),s("td",[s("el-input",{staticClass:"w300",attrs:{size:"medium"},model:{value:t.address.tel,callback:function(e){t.$set(t.address,"tel",e)},expression:"address.tel"}})],1)]),t._v(" "),s("tr",[s("td",{staticClass:"cell-label"},[t._v("所在地")]),t._v(" "),s("td",[s("el-cascader",{ref:"cascader",staticClass:"w300",attrs:{props:t.props,size:"medium"},on:{"update:props":function(e){t.props=e}},model:{value:t.cities,callback:function(e){t.cities=e},expression:"cities"}})],1)]),t._v(" "),s("tr",[s("td",{staticClass:"cell-label"},[t._v("详细地址")]),t._v(" "),s("td",[s("el-input",{staticClass:"w400",attrs:{size:"medium"},model:{value:t.address.street,callback:function(e){t.$set(t.address,"street",e)},expression:"address.street"}})],1)]),t._v(" "),s("tr",[s("td",{staticClass:"cell-label"},[t._v("邮政编码")]),t._v(" "),s("td",[s("el-input",{staticClass:"w300",attrs:{size:"medium"},model:{value:t.address.postalcode,callback:function(e){t.$set(t.address,"postalcode",e)},expression:"address.postalcode"}})],1)]),t._v(" "),s("tr",[s("td",{staticClass:"cell-label"}),t._v(" "),s("td",[s("el-checkbox",{attrs:{"true-label":1,"false-label":0},model:{value:t.address.isdefault,callback:function(e){t.$set(t.address,"isdefault",e)},expression:"address.isdefault"}},[t._v("设为默认地址")])],1)]),t._v(" "),s("tr",[s("td"),t._v(" "),s("td",[s("el-button",{staticClass:"w200",attrs:{size:"medium",type:"primary"},on:{click:t.handleSave}},[t._v("保存")])],1)])])])])},r=[]}});
require('../../common');
import KindEditor from '../../../components/kindeditor';
import ImagePicker from '../../../components/ImagePicker';

Vue.component('kindeditor',KindEditor);
Vue.component('ImagePicker',ImagePicker);

let app = new Vue({
    el:'#app',
    data:{
        item:item,
        catlog:catlog,
        images:images,
        content:content,
        skus:[],
        skuAttrs:[],
        selectedAttrs:[],
        rowSpans:[],
        skuRows:[],
        propNames:[],
        showImagePicker:false
    },
    created:function () {
        if (defaultAttributes.length > 0)
        {
            defaultAttributes.forEach(function (attr) {
                attr.values.forEach(function (val) {
                    var props = val.attr_id+':'+val.id;
                    if (defaultSkuAttrs[props])
                    {
                        val.checked = true;
                    } else {
                        val.checked = false;
                    }
                });
            });
            this.selectedAttrs = defaultAttributes;
            this.$nextTick(function () {
                app.buildSkuTable();
            });
        }
    },
    mounted:function(){

    },
    methods:{
        pickImage:function () {
            var $this = this;
            // Plugins.showImagePicker(function (data) {
            //     app.images.push({
            //         id:0,
            //         thumb:data.thumb,
            //         image:data.image,
            //         thumburl:data.thumburl,
            //         imageurl:data.imageurl
            //     });
            // });
            this.showImagePicker = true;
        },
        onPickedImage:function(data){
            app.images.push({
                id:0,
                thumb:data.thumb,
                image:data.image,
                thumburl:data.thumburl,
                imageurl:data.imageurl
            });
        },
        delImage:function(image){
            app.images.splice(app.images.indexOf(image), 1);
        },
        addAttribute:function () {
            var content = '<div style="height: 280px; position: relative">' +
                '<iframe src="/seller/attribute/showattributes" frameborder="0" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0;"></iframe>' +
                '</div>';
            DSXUI.dialog({
                title:'选择型号分类',
                content:content,
                showFooter:false,
                afterShow:function (dlg) {
                    window.onPickedAttribute = function (attr) {
                        dlg.close();
                        if (app.selectedAttrs.length > 2)
                        {
                            DSXUI.error('最多只能选择三个型号分类');
                            return false;
                        }
                        if (!app.hasAttribute(attr))
                        {
                            attr.values.forEach(function (val) {
                                val.checked = false;
                            });
                            app.selectedAttrs.push(attr);
                            app.buildSkuTable();
                        }
                    }
                }
            });
        },
        hasAttribute:function (arr) {
            for (var i in this.selectedAttrs)
            {
                if (this.selectedAttrs[i].attr_name == arr.attr_name)
                {
                    return true;
                }
            }
            return false;
        },
        delAttribute:function (attr) {
            this.selectedAttrs.splice(this.selectedAttrs.indexOf(attr), 1);
            this.buildSkuTable();
        },
        addValue:function (attr, index) {
            DSXUI.dialog({
                title:'添加型号',
                content:'<div><input type="text" class="form-control" id="newAttrValue"></div>',
                onConfirm:function (dlg) {
                    var value = $.trim($("#newAttrValue").val());
                    if (!value)
                    {
                        DSXUI.showToast('请填写型号名称');
                        return false;
                    }

                    dlg.close();
                    $.ajax({
                        type:'POST',
                        url:'/seller/attribute/savevalue',
                        data:{
                            attr_id:attr.attr_id,
                            value:value
                        },
                        success:function (response) {
                            value = response.value;
                            value.checked = false;
                            attr.values.push(value);
                            app.$set(app.selectedAttrs, index, attr);
                        }
                    });
                }
            });
        },
        buildSkuTable:function () {
            var $this = this;
            var skuValues = [];
            this.skuAttrs = [];
            this.propNames = [];

            this.selectedAttrs.map(function (attr) {
                if (attr.values.length > 0)
                {
                    var attrValues = [];
                    attr.values.map(function (val) {
                        if (val.checked)
                        {
                            attrValues.push(val);
                            app.skuAttrs.push({
                                attr_id:val.attr_id,
                                attr_properties:val.attr_id+':'+val.id,
                                attr_name:attr.attr_name,
                                attr_value:val.value
                            });
                        }
                    });
                    skuValues.push(attrValues);
                    app.propNames.push(attr.attr_name);
                }
            });

            if (skuValues.length > 0)
            {
                this.skus = [];
                var res = combine(skuValues.reverse());
                //合并单元格
                var row = [];
                var rowspan = res.length;
                for(var n = skuValues.length-1; n>-1; n--) {
                    row[n] = parseInt(rowspan/skuValues[n].length);
                    rowspan = row[n];
                }
                this.rowSpans = row.reverse();
                this.skuRows = res;
                this.skus = [];
                this.skuRows.map(function (sku) {
                    var props = [];
                    sku.map(function (val) {
                        props.push(val.attr_id+':'+val.id);
                    });
                    props = props.join(';');
                    if (defaultSkus[props])
                    {
                        var sku2 = defaultSkus[props];
                        app.skus.push({
                            sku_properties:sku2.sku_properties,
                            sku_price:sku2.sku_price,
                            sku_stock:sku2.sku_stock,
                            sku_code:sku2.sku_code
                        });
                    } else {
                        app.skus.push({
                            sku_properties:props,
                            sku_price:'',
                            sku_stock:'',
                            sku_code:''
                        });
                    }
                });
            }
        },
        submit:function () {
            var data = {
                itemid: itemid,
                item: this.item,
                images: this.images,
                content: this.content,
                skus: this.skus,
                sku_attrs: this.skuAttrs,
            };

            if (!item.catid)
            {
                DSXUI.showToast('请选择类目');
                return false;
            }

            if (!this.item.title)
            {
                DSXUI.showToast('请填写宝贝名称');
                return false;
            }

            if (this.images.length === 0)
            {
                DSXUI.showToast('请上传宝贝图片');
                return false;
            }

            if (!this.item.price)
            {
                DSXUI.showToast('请填写一口价');
                return false;
            }

            if (!this.item.stock)
            {
                DSXUI.showToast('请填写库存');
                return false;
            }

            if (this.skus.length > 0)
            {
                for (var i in this.skus)
                {
                    var sku = this.skus[i];

                    if (!sku.sku_price)
                    {
                        DSXUI.showToast('请填写型号价格');
                        return false;
                    }

                    if (!sku.sku_price > 0)
                    {
                        DSXUI.showToast('型号价格必须大于0');
                        return false;
                    }

                    if (!sku.sku_stock)
                    {
                        DSXUI.showToast('请填写型号库存');
                        return false;
                    }
                }
            }

            if (!this.item.freight_template)
            {
                DSXUI.showToast('请选择运费模板');
                return false;
            }

            $.ajax({
                type:'POST',
                data:data,
                success:function (response) {
                    //console.log(response);
                    window.location.href = '/seller/item/savesuccess?itemid='+response.item.itemid;
                }
            });
        },
        getEditorContent:function (html) {
            this.content.content = html;
        }
    },
    computed:{
        stock:function () {
            if (this.skus.length > 0)
            {
                this.item.stock = 0;
                this.skus.map(function (sku) {
                    this.item.stock+= parseInt(sku.sku_stock);
                });
            }
            return this.item.stock;
        },
        price:function () {
            if (this.skus.length > 0)
            {
                this.item.price = 0;
                this.skus.map(function (sku) {
                    var skuPrice = parseFloat(sku.sku_price);
                    if (skuPrice > 0)
                    {
                        if (this.item.price == 0 || this.item.price > skuPrice)
                        {
                            this.item.price = skuPrice;
                        }
                    }
                });
            }
            return this.item.price;
        }
    }
});

//排列组合
function combine(arr) {
    var r = [];
    (function f(t, a, n) {
        if (n == 0) return r.push(t);
        for (var i = 0; i < a[n-1].length; i++) {
            f(t.concat(a[n-1][i]), a, n - 1);
        }
    })([], arr, arr.length);
    return r;
}

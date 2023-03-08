<template>
    <div>
        <header class="page-header">
            <div class="page-title">编辑商品</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="edit-title">
                    <strong>基本信息</strong>
                </div>
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="cell-label w80">商品图片</td>
                        <td>第一张为宝贝主图，建议尺寸：800*800像素，拖拽图片可以调整顺序，最多上传5张。</td>
                    </tr>
                    <tr>
                        <td class="cell-label"></td>
                        <td>
                            <div class="dsxui-uploader">
                                <vuedraggable class="dsxui-uploader-files" v-model="images" draggable=".draggable">
                                    <div class="dsxui-uploader-files-item draggable"
                                         v-for="(img,idx) in images"
                                         :key="idx"
                                    >
                                        <el-image :src="img.thumb" fit="cover" class="image-item"/>
                                        <div class="iconfont icon-close_light del-icon"
                                             @click.stop="images.splice(idx,1)"></div>
                                    </div>
                                </vuedraggable>
                                <div class="dsxui-uploader-button" @click="onShowMultiplePicker"
                                     v-if="images.length<5">
                                    <i class="el-icon-plus dsxui-uploader-icon"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">商品名称</td>
                        <td>
                            <el-input type="text" size="medium" class="w500" v-model="product.title"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">商品卖点</td>
                        <td>
                            <el-input type="textarea" class="w500" v-model="product.subtitle"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">选择类目</td>
                        <td>
                            <el-cascader
                                    :options="nodes"
                                    v-model="cates"
                                    @change="onCascaderChange"
                                    size="medium"
                                    class="w500"
                                    ref="cascader"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">关联门店</td>
                        <td>
                            <el-select class="w500" size="medium" v-model="product.shop_id" placeholder="请选择">
                                <el-option
                                        v-for="(shop,index) in shopList"
                                        :key="index"
                                        :label="shop.shop_name"
                                        :value="shop.shop_id"
                                />
                            </el-select>
                        </td>
                    </tr>
                    <!--                    <tr>-->
                    <!--                        <td class="cell-label">可拼团</td>-->
                    <!--                        <td>-->
                    <!--                            <el-radio-group v-model="product.is_pin">-->
                    <!--                                <el-radio :label="1">是</el-radio>-->
                    <!--                                <el-radio :label="0">否</el-radio>-->
                    <!--                            </el-radio-group>-->
                    <!--                        </td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <td class="cell-label">拼团人数</td>-->
                    <!--                        <td>-->
                    <!--                            <el-input type="text" class="w200" v-model="product.pin_num" :min="0"-->
                    <!--                                      :max="99999999"></el-input>-->
                    <!--                        </td>-->
                    <!--                    </tr>-->
                    </tbody>
                </table>
                <div class="edit-title">
                    <strong>型号价格与库存</strong>
                </div>
                <div style="margin: 10px 0;">
                    <table class="dsxui-formtable">
                        <tbody>
                        <tr>
                            <td class="cell-label w80">商品型号</td>
                            <td>
                                <el-radio-group v-model="product.has_sku_attr">
                                    <el-radio :label="0">统一型号</el-radio>
                                    <el-radio :label="1">多级型号</el-radio>
                                </el-radio-group>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-if="product.has_sku_attr">
                        <tr>
                            <td></td>
                            <td>
                                <sku-panel
                                        :default-attr-info="defaultAttrInfo"
                                        :default-attr-list="defaultAttrList"
                                        @change="onSkuChange"
                                ></sku-panel>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td class="cell-label w80"><i class="star">*</i>产品价格</td>
                            <td>
                                <el-input type="text" class="w200" v-model="product.price" :min="0"
                                          :max="99999999"></el-input>
                            </td>
                        </tr>
                        <!--                        <tr>-->
                        <!--                            <td class="cell-label w80"><i class="star">*</i>拼团价格</td>-->
                        <!--                            <td>-->
                        <!--                                <el-input type="text" class="w200" v-model="product.pin_price" :min="0"-->
                        <!--                                          :max="99999999"></el-input>-->
                        <!--                            </td>-->
                        <!--                        </tr>-->
                        <tr>
                            <td class="cell-label"><i class="star">*</i>产品库存</td>
                            <td>
                                <el-input type="number" class="w200" v-model="product.stock" :min="0" :max="9999999"/>
                            </td>
                        </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td class="cell-label w80">划线价格</td>
                            <td>
                                <el-input
                                        type="text"
                                        class="w200"
                                        v-model="product.original_price"
                                        :min="0"
                                        :max="9999999"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="edit-title">
                    <span>其他信息</span>
                </div>
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="cell-label w80">宝贝详情</td>
                        <td>
                            <vue-editor v-model="content.content" ref="keditor"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">运费模板</td>
                        <td>
                            <el-select size="medium" v-model="product.template_id" placeholder="请选择">
                                <el-option
                                        v-for="(tpl,index) in templateList"
                                        :label="tpl.template_name"
                                        :value="tpl.template_id"
                                        :key="index"
                                />
                            </el-select>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label w80">初始销量</td>
                        <td>
                            <el-input type="text" class="w200" v-model="product.sold" :min="0" :max="99999999"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button @click="onSubmit(0)">放入仓库</el-button>
            <el-button type="primary" @click="onSubmit(1)">上架出售</el-button>
        </div>
        <image-picker v-model="showMultiplePicker" multiple :max-count="maxImageCount" @confirm="onSelectedImages"/>
    </div>
</template>

<script>
    import SkuPanel from "./SkuPanel";

    export default {
        name: "ProductEdit",
        components: {
            SkuPanel,
        },
        data() {
            let self = this;
            return {
                product: {
                    template_id: '',
                    has_sku_attr: 0,
                    is_pin: 0,
                    pin_num: 2,
                    skus: [],
                    stock: 1000,
                    sold: 100
                },
                skus: [],
                images: [],
                content: {},
                templateList: [],
                shopList: [],
                showMultiplePicker: false,
                maxImageCount: 5,
                defaultAttrList: [],
                defaultAttrInfo: {},
                nodes: [],
                cates: []
            }
        },
        methods: {
            fetchData() {
                let {itemid} = this.$route.params;
                if (!itemid) return false;
                this.$get('/ecom/product.getInfo', {itemid}).then(response => {
                    //console.log(response.result);
                    const product = response.result;
                    const {images, skus, attrs} = product;

                    this.product = product;
                    this.cates = product.cate_id;
                    if (skus) this.skus = skus;
                    if (images) this.images = images;

                    if (attrs !== null && attrs !== undefined) {
                        this.defaultAttrList = attrs;
                    }

                    if (skus.length > 0) {
                        let defaultAttrInfo = {};
                        skus.map((sku) => {
                            defaultAttrInfo[sku.properties] = sku;
                        });
                        this.defaultAttrInfo = defaultAttrInfo;
                    }

                    //setTimeout(this.$refs.cascader.panel.lazyLoad, 300);
                });

                this.$get('/ecom/product.content.getInfo', {itemid}).then(response => {
                    this.content = response.result;
                });
            },
            fetchCategoryList() {
                this.$get('/ecom/product.category.getList').then(response => {
                    this.nodes = this.serilazeProps(response.result.items);
                });
            },
            fetchTemplateList() {
                this.$get('/ecom/product.template.getList').then(response => {
                    this.templateList = response.result.items;
                });
            },
            fetchShopList() {
                this.$get('/ecom/shop.getList', {count: 50}).then(response => {
                    this.shopList = response.result.items;
                });
            },
            onShowMultiplePicker() {
                this.maxImageCount = 5 - this.images.length;
                this.showMultiplePicker = true;
            },
            onSelectedImages(images) {
                for (let img of images) {
                    if (this.images.length < 5) {
                        this.images.push({
                            id: 0,
                            thumb: img.thumb,
                            image: img.image
                        });
                    }
                }
            },
            onSkuChange(data) {
                this.skus = data.skus;
                this.product.skus = data.skus;
                this.product.attrs = data.attrs;
            },
            onSubmit(type) {
                //console.log(this.product);
                let {product, images, content, skus, cates} = this;
                let {title, price, stock, cate_id} = product;

                if (images.length === 0) {
                    this.$showToast('请至少上传一张图片');
                    return false;
                }

                if (!title) {
                    this.$showToast('请填写商品名称');
                    return false;
                }

                if (!cate_id) {
                    this.$showToast('请选择目录分类');
                    return false;
                }

                if (skus.length > 0) {
                    let prices = [];
                    let stocks = [];
                    for (var i = 0; i < skus.length; i++) {
                        if (skus[i].price === '' || skus[i].price == null) {
                            this.$showToast('产品价格不能为空');
                            return false;
                        }

                        if (skus[i].price <= 0) {
                            this.$showToast('产品价格小于等于0');
                            return false;
                        }

                        if (skus[i].stock === '' || skus[i].stock == null) {
                            this.$showToast('产品库存不能为空');
                            return false;
                        }

                        if (skus[i].stock < 0) {
                            this.$showToast('产品库存不能小于0');
                            return false;
                        }
                        prices.push(parseFloat(skus[i].price));
                        stocks.push(parseInt(skus[i].stock));
                    }

                    product.price = _.min(prices);
                    product.stock = _.sum(stocks);
                } else {
                    if (!price) {
                        this.$showToast('请填写产品价格');
                        return false;
                    }

                    if (price <= 0) {
                        this.$showToast('产品价格必须大于0');
                        return false;
                    }

                    if (stock === '' || stock == null) {
                        this.$showToast('产品库存不能为空');
                        return false;
                    }

                    if (stock < 0) {
                        this.$showToast('产品库存不能小于0');
                        return false;
                    }
                }

                product.state = type;
                product.skus = skus;
                product.images = images;
                product.content = content;
                this.$post('/ecom/product.save', {product}).then(() => {
                    let message = type === 1 ? '商品上架成功' : '商品下架成功';
                    //this.$showToast(message, this.$router.go(0));
                }).catch(reason => {
                    this.$showToast(reason.errMsg);
                });
            },
            serilazeProps(arr) {
                function t(a) {
                    return a.map(function (c) {
                        var obj = {
                            value: c.cate_id,
                            label: c.cate_name,
                        };
                        if (c.children.length > 0) {
                            obj.children = t(c.children);
                        }
                        return obj;
                    });
                }

                return t(arr);
            },
            onCascaderChange(val) {
                if (val) this.product.cate_id = val[val.length - 1];
            }
        },
        mounted() {
            this.fetchData();
            this.fetchCategoryList();
            this.fetchTemplateList();
            this.fetchShopList();
        },
    }
</script>

<style scoped>

</style>

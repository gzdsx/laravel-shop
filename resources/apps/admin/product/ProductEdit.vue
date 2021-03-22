<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>商品管理</el-breadcrumb-item>
                    <el-breadcrumb-item>编辑商品</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/product/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="edit-title">
                    <strong>基本信息</strong>
                </div>
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="cell-label w80">选择类目</td>
                        <td>
                            <el-cascader
                                    :options="nodes"
                                    size="medium"
                                    class="w500"
                                    v-model="cates"
                                    ref="cascader"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">宝贝名称</td>
                        <td>
                            <el-input type="text" size="medium" class="w500" v-model="product.title"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">宝贝卖点</td>
                        <td>
                            <el-input type="textarea" class="w500" v-model="product.subtitle"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">宝贝图片</td>
                        <td>第一张为宝贝主图，主图不能超过3MB,仅支持上传JPG格式的图片,拖拽图片可跟换顺序。</td>
                    </tr>
                    <tr>
                        <td class="cell-label"></td>
                        <td>
                            <div class="dsxui-uploader">
                                <vuedraggable class="dsxui-uploader-files" v-model="images" draggable=".draggable">
                                    <div class="dsxui-uploader-files-item draggable"
                                         v-for="(img,idx) in images"
                                         :key="idx"
                                         @click="handleChangeImage($event,idx)"
                                    >
                                        <el-image :src="img.thumb" fit="cover" class="image-item"></el-image>
                                        <div class="iconfont icon-close_light del-icon"
                                             @click.stop="images.splice(idx,1)"></div>
                                    </div>
                                </vuedraggable>
                                <div class="dsxui-uploader-button" @click="showImagePicker=true" v-if="images.length<5">
                                    <i class="el-icon-plus dsxui-uploader-icon"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="edit-title">
                    <strong>型号价格与库存</strong>
                </div>

                <div style="margin: 10px 0;" v-show="showAttrs">
                    <table class="dsxui-formtable">
                        <tbody>
                        <tr>
                            <td class="cell-name w80">产品型号</td>
                            <td>
                                <sku-panel
                                        :default-attr-info="defaultAttrInfo"
                                        :default-attr-list="defaultAttrList"
                                        @sku-change="handleSkuChange"
                                        @change="handleAttrChange"
                                ></sku-panel>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-show="!showAttrs">
                    <table class="dsxui-formtable">
                        <tbody>
                        <tr>
                            <td class="cell-label w80">产品原价</td>
                            <td>
                                <el-input
                                        type="text"
                                        class="w200"
                                        v-model="product.original_price"
                                        :min="0"
                                        :max="99999999"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-label w80"><i class="star">*</i>产品价格</td>
                            <td>
                                <el-input type="text" class="w200" v-model="product.price" :min="0"
                                          :max="99999999"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-label"><i class="star">*</i>产品库存</td>
                            <td>
                                <el-input type="number" class="w200" v-model="product.stock" :min="0"
                                          :max="99999999"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-name"></td>
                            <td>
                                <el-button size="medium" @click="showAttrs=true">
                                    <span class="iconfont icon-add"></span>
                                    <span>添加产品型号</span>
                                </el-button>
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
                            <vue-editor v-model="content.content" ref="keditor"></vue-editor>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">运费模板</td>
                        <td>
                            <el-select size="medium" v-model="product.freight_template_id">
                                <el-option :value="0" label="请选择"></el-option>
                                <el-option v-for="(tpl,index) in freightTemplates"
                                           :label="tpl.template_name"
                                           :value="tpl.template_id"
                                           :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label w80">初始销量</td>
                        <td>
                            <el-input type="text" class="w200" v-model="product.sold" :min="0"
                                      :max="99999999"></el-input>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button @click="handleSubmit(0)">放入仓库</el-button>
            <el-button type="primary" @click="handleSubmit(1)">上架出售</el-button>
        </div>
        <image-picker v-model="showImagePicker" @confirm="handlePickImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import SkuPanel from "../../lib/SkuPanel";

    export default {
        name: "ProductEdit",
        components: {
            AdminFrame,
            SkuPanel,
        },
        data: function () {
            return {
                itemid: 0,
                product: {
                    sold: 0,
                    freight_template_id: '',
                },
                images: [],
                content: {},
                skus: [],
                cates: [],
                freightTemplates: [],
                showImagePicker: false,
                defaultAttrList: [],
                defaultAttrInfo: {},
                changeImage: false,
                changeImageIndex: 0,
                showAttrs: false,
                props: {
                    lazy: true,
                    label: 'name',
                    value: 'catid',
                    lazyLoad(node, resolve) {
                        //console.log(node);
                        const {level} = node;
                        const fid = node.data ? node.data.catid : 0;
                        Axios.get('/product/category/search?fid=' + fid).then(response => {
                            resolve(response.data.items.map(c => ({
                                ...c,
                                leaf: level >= 1
                            })));
                        });
                    }
                },
                nodes: [],
            }
        },
        mounted() {
            this.fetchCategories();
            this.fetchFreightTemplates();

            let itemid = this.$route.query.itemid;
            if (itemid) {
                this.itemid = itemid;
                this.fetchData();
            } else {
                //let content = this.$refs.keditor.getCookie();
                //if (content !== null) this.content.content = content;
            }
        },
        methods: {
            fetchData() {
                this.$get('/product/get?itemid=' + this.itemid).then(response => {
                    //console.log(response.data);
                    const {product} = response.data;
                    const {images, content, skus, attrs, categories} = product;

                    this.product = product;
                    if (images) this.images = images;
                    if (content) this.content = content;
                    if (skus) this.skus = skus;

                    if (attrs !== null && attrs !== undefined) {
                        if (attrs.length) {
                            this.showAttrs = true;
                            this.defaultAttrList = attrs;
                        }
                    }

                    if (skus.length > 0) {
                        var defaultAttrInfo = {};
                        skus.map((sku) => {
                            defaultAttrInfo[sku.properties] = sku;
                        });
                        this.defaultAttrInfo = defaultAttrInfo;
                    }

                    let cates = [];
                    if (categories !== null) {
                        cates = categories.map((c) => c.catid);
                    }
                    this.cates = cates;
                });
            },
            fetchCategories() {
                this.$get('/product/category/getall').then(response => {
                    this.nodes = this.serilazeProps(response.data.items);
                });
            },
            fetchFreightTemplates() {
                this.$get('/freighttemplate/getall').then(response => {
                    this.freightTemplates = response.data.items;
                });
            },
            handleChangeImage(e, i) {
                this.changeImage = true;
                this.changeImageIndex = i;
                this.showImagePicker = true;
            },
            handlePickImage(img) {
                if (this.changeImage) {
                    this.images.splice(this.changeImageIndex, 1, {
                        ...this.images[this.changeImageIndex],
                        thumb: img.thumb,
                        image: img.image
                    });
                } else {
                    if (this.images.length < 5) {
                        this.images.push({
                            id: 0,
                            thumb: img.thumb,
                            image: img.image
                        });
                    }
                }
                this.changeImage = false;
            },
            handleSkuChange(data) {
                this.skus = data.sku_list;
                this.product.attrs = data.attr_list;
            },
            handleAttrChange(attrs) {
                if (attrs.length === 0) {
                    this.showAttrs = false;
                }
            },
            handleSubmit(type) {
                if (this.cates.length === 0) {
                    this.$showToast('请选择目录分类');
                    return false;
                }

                let product = this.product;
                let {title, price, stock} = product;
                if (!title) {
                    this.$showToast('标题不能为空');
                    return false;
                }

                if (this.images.length === 0) {
                    this.$showToast('请至少上传一张图片');
                    return false;
                }

                let skus = this.skus;
                if (skus.length > 0) {
                    var prices = [];
                    var stocks = [];
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

                product.on_sale = type;
                const itemid = this.itemid;
                this.$post('/product/save', {
                    itemid,
                    product,
                    skus: this.skus,
                    images: this.images,
                    content: this.content,
                    cates: this.cates
                }).then(response => {
                    if (response.errcode) {
                        this.$showToast(response.data.errmsg);
                    } else {
                        var message = type === 1 ? '商品上架成功' : '商品下架成功';
                        this.$showToast(message, this.$router.go(0));
                    }
                }).catch(reason => {
                    console.log(reason);
                });
            },
            serilazeProps: function (arr) {
                function t(a) {
                    return a.map(function (c) {
                        var obj = {
                            value: c.catid,
                            label: c.name,
                        };
                        if (c.children.length > 0) {
                            obj.children = t(c.children);
                        }
                        return obj;
                    });
                }

                return t(arr);
            },
            setSascaderValue() {
                let cascader = this.$refs['cascader'];
                cascader.panel.activePath = [];
                cascader.panel.loadCount = 0;
                cascader.panel.lazyLoad();
            }
        },
        watch: {}
    }
</script>

<style scoped>

</style>

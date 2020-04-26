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
                <router-link to="/item/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="edit-title">
                    <span>基本信息</span>
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
                                    v-model="item.cates"
                            ></el-cascader>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label w80">宝贝名称</td>
                        <td>
                            <el-input type="text" size="medium" class="w500" v-model="item.title"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">宝贝卖点</td>
                        <td>
                            <el-input type="textarea" class="w500" v-model="item.subtitle"></el-input>
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
                                <vuedraggable v-model="item.images" class="dsxui-uploader-files" draggable=".draggable">
                                    <div class="dsxui-uploader-files-item draggable"
                                         v-for="(img,idx) in item.images"
                                         :key="idx"
                                         @click="handleChangeImage($event,idx)"
                                    >
                                        <el-image :src="img.thumb" fit="cover" class="image-item"></el-image>
                                        <div class="iconfont icon-close_light del-icon"
                                             @click.stop="item.images.splice(idx,1)"></div>
                                    </div>
                                </vuedraggable>
                                <div class="dsxui-uploader-button" @click="showImagePicker=true"
                                     v-if="item.images.length<5">
                                    <i class="el-icon-plus dsxui-uploader-icon"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="edit-title">
                    <span>型号价格与库存</span>
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
                            <td class="cell-label w80"><i class="star">*</i>产品价格</td>
                            <td>
                                <el-input type="text" class="w200" v-model="item.price" :min="0"
                                          :max="99999999"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-label"><i class="star">*</i>产品库存</td>
                            <td>
                                <el-input type="number" class="w200" v-model="item.stock" :min="0"
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
                            <kind-editor v-model="item.content.content"></kind-editor>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">运费模板</td>
                        <td>
                            <el-select size="medium" v-model="item.freight_template_id">
                                <el-option v-for="(tpl,index) in freightTemplates"
                                           :label="tpl.template_name"
                                           :value="tpl.template_id"
                                           :key="index"
                                ></el-option>
                            </el-select>
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
        <image-picker v-model="showImagePicker" @confirm="handlePickedImage"></image-picker>
    </admin-frame>
</template>

<script>
    import vuedraggable from 'vuedraggable';
    import AdminFrame from "../common/AdminFrame";
    import SkuPanel from "../../lib/SkuPanel";
    import KindEditor from "../../lib/KindEditor";
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "ItemEdit",
        components: {
            AdminFrame,
            SkuPanel,
            KindEditor,
            vuedraggable,
            ImagePicker
        },
        data: function () {
            return {
                itemid: 0,
                item: {
                    images: [],
                    content: {},
                    skus: [],
                    cates: []
                },
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
                        console.log(node);
                        const {level} = node;
                        const fid = node.data ? node.data.catid : 0;
                        Axios.get('/admin/item/catlog/search?fid=' + fid).then(response => {
                            resolve(response.data.items.map(c => ({
                                ...c,
                                leaf: level >= 1
                            })));
                        });
                    }
                },
                nodes: []
            }
        },
        mounted() {
            let itemid = this.$route.params.itemid;
            if (itemid) {
                this.itemid = itemid;
                this.fetchItem();
                this.fetchCatlogs();
            }
            this.fetchFreightTemplates();
        },
        methods: {
            fetchItem: function (itemid) {
                this.$axios.get('/admin/item/get?itemid=' + this.itemid).then(response => {
                    //console.log(response.data);
                    this.item = response.data.item;
                    if (!this.item.images) {
                        this.item.images = [];
                    }

                    if (!this.item.content) {
                        this.item.content = {};
                    }

                    if (!this.item.skus) {
                        this.item.skus = [];
                    }
                    const {attr_list, skus, catlogs} = response.data.item;
                    if (attr_list !== null && attr_list !== undefined) {
                        if (attr_list.length) {
                            this.showAttrs = true;
                            this.defaultAttrList = attr_list;
                        }
                    }
                    if (skus.length > 0) {
                        var defaultAttrInfo = {};
                        skus.map((sku) => {
                            defaultAttrInfo[sku.properties] = sku;
                        });
                        this.defaultAttrInfo = defaultAttrInfo;
                    }

                    this.item.cates = [];
                    if (typeof catlogs == 'object') {
                        this.item.cates = catlogs.map((c) => c.catid);
                    }
                    this.$forceUpdate();
                });
            },
            fetchFreightTemplates: function () {
                this.$axios.get('/admin/freighttemplate/getall').then(response => {
                    this.freightTemplates = response.data.items;
                });
            },
            handleChangeImage: function (e, i) {
                this.changeImage = true;
                this.changeImageIndex = i;
                this.showImagePicker = true;
            },
            handlePickedImage: function (img) {
                if (this.changeImage) {
                    this.item.images.splice(this.changeImageIndex, 1, {
                        ...this.item.images[this.changeImageIndex],
                        thumb: img.thumb,
                        image: img.image
                    });
                } else {
                    if (this.item.images.length < 5) {
                        this.item.images.push({
                            id: 0,
                            thumb: img.thumb,
                            image: img.image
                        });
                    }
                }
                this.changeImage = false;
            },
            handleSkuChange: function (data) {
                this.item.skus = data.sku_list;
                this.item.attr_list = data.attr_list;
            },
            handleAttrChange: function (attrs) {
                if (attrs.length === 0) {
                    this.showAttrs = false;
                }
            },
            handleSubmit: function (type) {
                //console.log(this.cates);return ;
                const {title, cates, skus, images, price, stock} = this.item;
                if (cates === undefined || cates.length === 0) {
                    this.$showToast('请选择目录分类');
                    return false;
                }

                if (!title) {
                    this.$showToast('标题不能为空');
                    return false;
                }

                if (images.length === 0) {
                    this.$showToast('请至少上传一张图片');
                    return false;
                }

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

                    this.item.price = _.min(prices);
                    this.item.stock = _.sum(stocks);
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

                this.item.on_sale = type;

                this.$post('/admin/item/update', {
                    itemid: this.itemid,
                    item: this.item
                }).then(response => {
                    if (response.errcode) {
                        this.$toast(response.data.errmsg);
                    } else {
                        var message = type === 1 ? '商品上架成功' : '商品下架成功';
                        this.$showToast(message, this.$router.go(0));
                    }
                }).catch(reason => {
                    console.log(reason.response);
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/admin/item/catlog/getall').then(response => {
                    this.nodes = this.serilazeProps(response.data.items);
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
            }

        },
        watch: {}
    }
</script>

<style scoped>

</style>

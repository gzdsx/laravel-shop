<template>
    <div>
        <header class="page-header">
            <div class="flex-fill">
                <div class="page-title">编辑门店</div>
            </div>
            <div>
                <router-link to="/shop/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="w60">门头照片</td>
                        <td class="w500">
                            <div class="w120" @click="showImagePicker=true">
                                <el-image :src="shop.logo" fit="cover" class="img-90" v-if="shop.logo"/>
                                <div class="img-90 img-placeholder" v-else></div>
                            </div>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>店铺名称</td>
                        <td>
                            <el-input size="medium" class="w500" v-model="shop.shop_name"></el-input>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>客服电话</td>
                        <td>
                            <el-input size="medium" class="w500" v-model="shop.tel"></el-input>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>客服微信</td>
                        <td>
                            <el-input size="medium" class="w500" v-model="shop.weixin"></el-input>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>所在地区</td>
                        <td>
                            <el-input size="medium" class="w500" readonly v-model="region"
                                      @focus="showMap=true"></el-input>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>详细地址</td>
                        <td>
                            <el-input size="medium" class="w500" v-model="shop.street"></el-input>
                        </td>
                        <td class="cell-tips"></td>
                    </tr>
                    <tr>
                        <td>店内照片</td>
                        <td colspan="2">
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
                                     v-if="images.length<10">
                                    <i class="el-icon-plus dsxui-uploader-icon"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>门店介绍</td>
                        <td colspan="2">
                            <el-input type="textarea" class="w500" rows="10" v-model="shop.description"></el-input>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button class="w100" @click="$router.go(-1)">取消</el-button>
            <el-button class="w100" type="primary" @click="onSubmit">保存</el-button>
        </div>
        <image-picker v-model="showImagePicker" @confirm="onChooseImage" :params="{'width':500,fit:true}"/>
        <image-picker v-model="showMultiplePicker" multiple :max-count="maxImageCount" @confirm="onSelectedImages"/>
        <location-picker v-model="showMap" @confirm="onChooseLocation"/>
    </div>
</template>

<script>
    export default {
        name: "ShopEdit",
        data() {
            return {
                showImagePicker: false,
                showMultiplePicker: false,
                shop: {
                    is_recommend: 0,
                    views: 0,
                    sort_num: 0
                },
                categoryList: [],
                region: '',
                shop_id: 0,
                showMap: false,
                images: [],
                changeImage: false,
                changeImageIndex: 0,
                maxImageCount: 10
            }
        },
        methods: {
            fetchData() {
                let {shop_id} = this.$route.params;
                if (!shop_id) return;
                this.$get('/ecom/shop.getInfo', {shop_id}).then(response => {
                    this.shop = response.result;
                    let {province, city, district, street, images} = response.result;
                    this.region = province + city + district;
                    this.images = images;
                });
            },
            onSubmit() {
                let {shop, images} = this;
                if (!shop.shop_name) {
                    this.$showToast('请填写店铺名称');
                    return false
                }

                let {shop_id} = this.$route.params;
                this.$post('/ecom/shop.save', {shop_id, shop, images}).then(response => {
                    this.$showToast('信息保存成功', () => this.$router.history.go(-1));
                });
            },
            onChooseLocation(position) {
                let {shop} = this;
                let {province, city, district, street, street_number} = position;
                this.region = province + city + district;
                this.showMap = false;
                this.shop = {
                    ...shop,
                    ...position
                }
            },
            onChooseImage(data) {
                this.shop.logo = data.image;
            },
            onSelectedImages(images) {
                for (let img of images) {
                    if (this.images.length < 10) {
                        this.images.push({
                            id: 0,
                            thumb: img.thumb,
                            image: img.image
                        });
                    }
                }
            },
            onShowMultiplePicker() {
                this.maxImageCount = 10 - this.images.length;
                this.showMultiplePicker = true;
            }
        },
        mounted() {
            this.fetchData();
        },
    }
</script>

<style scoped>

</style>

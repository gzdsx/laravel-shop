<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex-fill">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>直播管理</el-breadcrumb-item>
                    <el-breadcrumb-item>编辑话题</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/live/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="w60">直播话题</td>
                        <td>
                            <el-input size="medium" class="w500" v-model="live.title"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>所属频道</td>
                        <td>
                            <el-select size="medium" class="w300" v-model="live.channel_id">
                                <el-option
                                        v-for="(channel,index) in channels"
                                        :value="channel.channel_id"
                                        :label="channel.name"
                                        :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                    </tr>
                    <tr>
                        <td>开播时间</td>
                        <td>
                            <el-date-picker
                                    v-model="live.start_at"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    format="yyyy-MM-dd HH:mm:ss"
                                    size="medium"
                                    class="w300"
                            >
                            </el-date-picker>
                        </td>
                    </tr>
                    <tr>
                        <td>直播海报</td>
                        <td>
                            <div class="w120" @click="showPicker=true">
                                <el-image :src="live.image" fit="cover" class="img-110" v-if="live.image"></el-image>
                                <div class="img-110 img-placeholder" v-else></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>观看方式</td>
                        <td>
                            <el-radio v-model="live.watch_mode" :label="1">免费</el-radio>
                            <el-radio v-model="live.watch_mode" :label="2">收费</el-radio>
                        </td>
                    </tr>
                    <tr v-if="live.watch_mode==2">
                        <td>门票价格</td>
                        <td>
                            <el-input size="medium" class="w200" v-model="live.price"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>直播状态</td>
                        <td>
                            <el-radio v-model="live.state" :label="0">未开播</el-radio>
                            <el-radio v-model="live.state" :label="1">直播中</el-radio>
                            <el-radio v-model="live.state" :label="2">已结束</el-radio>
                        </td>
                    </tr>
                    <tr>
                        <td>直播内容</td>
                        <td>
                            <el-input type="textarea" class="w500" rows="10" v-model="live.content"></el-input>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button class="w100" @click="$router.go(-1)">取消</el-button>
            <el-button class="w100" type="primary" @click="handleSubmit">保存</el-button>
        </div>
        <image-picker v-model="showPicker" @confirm="handlePickedImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import KindEditor from "../../lib/KindEditor";

    export default {
        name: "LiveEdit",
        components: {
            AdminFrame,
            KindEditor,
        },
        data() {
            return {
                id: 0,
                live: {
                    state: 0,
                    price: 0,
                    watch_mode: 1
                },
                channels: [],
                showPicker: false
            }
        },
        mounted() {
            this.id = this.$route.query.id || 0;
            if (this.id) this.fetchData();
            this.fetchChannels();
        },
        methods: {
            fetchData() {
                this.$get('/live/get?id=' + this.id).then(response => {
                    this.live = response.data.live;
                });
            },
            fetchChannels() {
                this.$get('/live/channel/getall').then(response => {
                    this.channels = response.data.items;
                });
            },
            handlePickedImage(data) {
                this.live.image = data.image;
            },
            handleSubmit() {
                const live = this.live;
                if (!live.title) {
                    this.$showToast('请填写话题');
                    return false;
                }

                if (!live.channel_id) {
                    this.$showToast('请选择频道');
                    return false;
                }

                if (!live.start_at) {
                    this.$showToast('请选择开播时间');
                    return false;
                }

                if (!live.image) {
                    this.$showToast('请上传海报');
                    return false;
                }

                const id = this.id;
                this.$post('/live/save', {id, live}).then(response => {
                    this.$showToast('话题保存成功!', () => this.$router.go(0));
                });
            }
        }
    }
</script>

<style scoped>

</style>

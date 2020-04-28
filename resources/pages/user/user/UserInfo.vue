<template>
    <div class="content-block">
        <div class="console-title">
            <h2>资料设置</h2>
        </div>
        <section style="display: flex;">
            <div class="avatar-div">
                <div class="avatar"><img id="avatar-image" :src="user.avatar+'?'+Math.random()"></div>
                <div class="avatar-content">
                    <a @click="showPicker=true">
                        更换头像
                    </a>
                </div>
                <div class="avatar-content">支持JPG,JPEG,GIF,PNG格式</div>
            </div>
            <div class="flex">
                <table class="dsxui-formtable">
                    <colgroup>
                        <col class="w70 cell-label">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">真实姓名</td>
                        <td>
                            <el-input size="medium" class="w300" v-model="userinfo.fullname"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">性别</td>
                        <td>
                            <el-radio :label="1" v-model="userinfo.gender">男</el-radio>
                            <el-radio :label="2" v-model="userinfo.gender">女</el-radio>
                            <el-radio :label="3" v-model="userinfo.gender">其他</el-radio>
                        </td>

                    </tr>
                    <tr>
                        <td class="cell-label">生日</td>
                        <td>
                            <el-date-picker
                                    class="w300"
                                    v-model="userinfo.birthday"
                                    type="date"
                                    placeholder="选择日期">
                            </el-date-picker>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">所在地</td>
                        <td>
                            <el-cascader :props="props" class="w400" v-model="cities" ref="district"></el-cascader>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-label">个人描述</td>
                        <td>
                            <el-input type="textarea" rows="3" v-model="userinfo.introduction"
                                      placeholder="一句话介绍自己"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <el-button type="primary" size="medium" class="w100" @click="handleSave">更新资料</el-button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <image-picker v-model="showPicker" @confirm="handleSaveAvatar"></image-picker>
    </div>
</template>

<script>
    import ImagePicker from "../../lib/ImagePicker";
    export default {
        name: "UserInfo",
        components:{
            ImagePicker
        },
        data: function () {
            return {
                user,
                userinfo: {},
                props: {
                    lazy: true,
                    value: 'name',
                    label: 'name',
                    lazyLoad(node, resolve) {
                        const {level} = node;
                        const fid = node.data ? node.data.id : 0;
                        axios.get('/webapi/district/batchget?fid=' + fid).then(response => {
                            const items = response.data.items.map((o) => ({
                                ...o,
                                leaf: level >= 2
                            }));
                            resolve(items);
                        });
                    }
                },
                cities: [],
                showPicker:false
            }
        },
        mounted() {
            this.$get('/user/info').then(response => {
                const userinfo = response.data.userinfo;
                this.userinfo = userinfo;
                this.cities = [
                    userinfo.province,
                    userinfo.city,
                    userinfo.district
                ];
                this.$nextTick(() => {
                    this.setSascaderValue();
                });
            });
        },
        methods: {
            handleSave() {
                this.userinfo.province = this.cities[0];
                this.userinfo.city = this.cities[1];
                this.userinfo.district = this.cities[2];
                this.$post('/user/info/update', {
                    userinfo: this.userinfo
                }).then(response => {
                    this.$showToast('资料更新成功', () => this.$router.go(0));
                })
            },
            handleSaveAvatar(d){
                this.$post('/user/avatar/update',d).then(response=>{
                    //this.$router.go(0);
                });
            },
            setSascaderValue() {
                let cascader = this.$refs['district'];
                cascader.panel.activePath = [];
                cascader.panel.loadCount = 0;
                cascader.panel.lazyLoad();
            }
        },
        updated() {

        }
    }
</script>

<style scoped>

</style>

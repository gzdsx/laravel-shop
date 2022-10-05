<template>
    <div class="container">
        <van-cell-group>
            <van-cell
                    title="头像"
                    size="large"
                    is-link
                    center
                    :clickable="false"
            >
                <van-uploader
                        accept="image/png, image/jpeg, image/jpg, image/gif"
                        :after-read="afterReadFile"
                >
                    <img :src="userInfo.avatar" class="img-40 img-round" alt="">
                </van-uploader>
            </van-cell>
            <van-cell
                    title="姓名"
                    size="large"
                    is-link
                    center
                    :value="userInfo.username"
                    to="/home/update-username"
            />
            <van-cell
                    title="手机号"
                    size="large"
                    is-link
                    center
                    :value="userInfo.phone"
                    to="/home/bind-mobile"
            />
            <van-cell
                    title="邮箱"
                    size="large"
                    is-link
                    center
                    :value="userInfo.email"
                    to="/home/bind-email"
            />
        </van-cell-group>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import {USERDIDCHANGE} from "../vuex/types";

    export default {
        name: "UserProfile",
        data() {
            return {}
        },
        computed: {
            ...mapState(['userInfo'])
        },
        mounted() {
            this.setBackgroundColor('#f5f5f5');
        },
        methods: {
            afterReadFile(e) {
                let data = new FormData();
                data.append('file', e.file);

                this.$post('/material/upload?type=image', data, {
                    headers: {'Content-Type': 'multipart/form-data'}
                }).then((response) => {
                    let {image} = response.result;
                    this.$post('/user/avatar.update', {
                        avatar: image
                    }).then(res => {
                        let {userInfo} = this.$store.state;
                        userInfo.avatar = res.result;
                        this.$store.commit(USERDIDCHANGE, userInfo);
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>

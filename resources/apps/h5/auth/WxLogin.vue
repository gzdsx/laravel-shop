<template>

</template>

<script>
    import {LOGIN} from "../vuex/types";

    export default {
        name: "WxLogin",
        data() {
            return {}
        },
        methods: {
            goLogin(code) {
                this.$post('/user/officialaccount.login', {code}).then(response => {
                    let {openid, access_token} = response.result;
                    if (access_token) {
                        localStorage.setItem('openid', openid);
                        localStorage.setItem('accessToken', access_token);
                        //this.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
                        //this.$store.commit(LOGIN, response.result);
                        let redirect = localStorage.getItem('redirect');
                        if (redirect) {
                            window.location.href = redirect;
                        } else {
                            let {origin, pathname} = window.location;
                            window.location.href = origin + pathname;
                        }
                    }
                }).catch(() => {
                    this.$toast('登录失败');
                });
            },
            goAuth() {
                if (!window.appId) {
                    return;
                }
                let redirectURL = encodeURIComponent(window.location.href); //获取地址
                let base = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=';
                let scope = "snsapi_userinfo";
                window.location.href = base + window.appId + '&redirect_uri=' + redirectURL + '&response_type=code&scope=' + scope +
                    '&state=STATE' + '#wechat_redirect';
            },
            getCode() {
                var reg = new RegExp("(^|&)code=([^&]*)(&|$)");
                var rrr = decodeURIComponent(window.location.search);
                var r = rrr.substr(1).match(reg);
                if (r != null) {
                    return unescape(r[2]);
                } else {
                    return null;
                }
            }
        },
        mounted() {
            let code = this.getCode();
            if (code) {
                this.goLogin(code);
            } else {
                this.goAuth();
            }
        },
    }
</script>

<style scoped>

</style>

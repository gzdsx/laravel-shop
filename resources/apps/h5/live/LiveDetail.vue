<template>
    <van-loading v-if="loading"></van-loading>
    <div class="live-container" v-else>
        <div class="live-detail">
            <div class="live-player">
                <div class="live-player-content" v-if="live.state===0">
                    <div class="title">直播尚未开始</div>
                </div>
                <template v-else>
                    <live-player :live="live" v-if="ticket"/>
                    <div class="live-player-content" v-else>
                        <div class="btn-area">
                            <span class="btn" @click="buyTicket">购买本场门票</span>
                        </div>
                    </div>
                </template>
            </div>
            <div class="live-tabs">
                <div class="tab-item" :class="{'active':tab==='hudong'}" @click="onClickTab('hudong')">互动</div>
                <div class="tab-item" :class="{'active':tab==='jieshao'}" @click="onClickTab('jieshao')">介绍</div>
                <div class="tab-item" :class="{'active':tab==='hezuo'}" @click="onClickTab('hezuo')">合作</div>
                <div class="subscribe" @click="showQrcode=true">+关注</div>
            </div>
            <div class="live-body">
                <div class="live-content" v-show="tab==='hudong'">
                    <div class="content" id="chat">
                        <div class="chat-room" id="chat-room">
                            <div class="chat-message" v-for="(msg,idx) in messages" :key="idx">
                                <div class="time">{{msg.created_at}}</div>
                                <div class="wellcome-msg" v-if="msg.type===2">{{msg.message}}</div>
                                <div class="chat-flex" v-else>
                                    <img :src="msg.avatar" class="avatar" alt="">
                                    <div class="flex">
                                        <div class="username">{{msg.username}}</div>
                                        <div><span class="message">{{msg.message}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h60"></div>
                    </div>
                </div>
                <div class="live-content" v-show="tab==='jieshao'">
                    <div class="content" v-html="live.content"></div>
                </div>
                <div class="live-content" v-show="tab==='hezuo'">
                    <div class="content">商务合作内容</div>
                </div>
            </div>
        </div>
        <div class="tabbar" v-show="tab==='hudong'">
            <div class="bar">
                <div class="bar-inner">
                    <div class="comment" @click="showDialog=true">说点什么吧...</div>
                </div>
            </div>
        </div>
        <van-dialog
                v-model="showDialog"
                title="发表评论"
                :show-cancel-button="true"
                @confirm="handleSend"
                get-container="body"
        >
            <van-field v-model="message" type="textarea" placeholder="请输入评论内容"/>
        </van-dialog>
        <van-dialog
                v-model="showQrcode"
                :show-confirm-button="false"
                :close-on-click-overlay="true"
                style="width: 260px;"
        >
            <div class="dialog-qrcode">
                <img :src="qrcode" alt="">
                <p>长按识别上方二维码关注公众号</p>
            </div>
        </van-dialog>
        <van-popup v-model="showPoster" closeable class="live-poster-popup">
            <img :src="'/h5/live/poster/'+live.id" class="live-poster">
        </van-popup>
        <div class="live-invite" @click="showPoster=true">
            <img src="/images/app/yaoqing.png">
        </div>
    </div>
</template>

<script>
    import LivePlayer from "./LivePlayer";

    export default {
        name: "LiveDetail",
        components: {
            LivePlayer
        },
        data() {
            return {
                loading: true,
                showDialog: false,
                showQrcode: false,
                message: null,
                tab: 'hudong',
                player: null,
                websocket: null,
                messages: [],
                ticket: false,
                qrcode: window.qrcode,
                showPoster: false
            }
        },
        mounted() {
            this.fetchTicket();
            this.fetchData();
        },
        methods: {
            fetchTicket() {
                const id = pageConfig.id;
                this.$get('/live/getticket', {id}).then(response => {
                    if (response.result.ticket) {
                        this.ticket = response.result.ticket;
                    }
                });
            },
            fetchData() {
                const id = pageConfig.id;
                this.$get('/live/get', {id}).then(response => {
                    this.live = response.result.live;
                    this.loading = false;
                    this.initWebsocket();
                    this.setShareData();
                });
            },
            showFormDialog() {
                this.showDialog = true;
            },
            hideFormDialog() {
                this.showDialog = false;
            },
            onClickTab(tab) {
                this.tab = tab;
            },
            initWebsocket() {
                var _this = this;
                var tid = this.live.id;
                var {uid, username} = window.pageConfig;
                var url = `wss://shop.gzdsx.cn/ws/vfrom=wx&tid=${tid}&uid=${uid}&username=${username}`;
                var websocket = new WebSocket(url);
                websocket.onopen = function (evt) {
                    console.log("Connected to WebSocket server.");
                    _this.sendMessage(username + '进入了直播间', 2);
                };

                websocket.onclose = function (evt) {
                    console.log("Disconnected");
                };

                websocket.onmessage = function (evt) {
                    //console.log('Retrieved data from server: ' + evt.data);
                    if (_this.messages.length > 99) {
                        _this.messages.shift();
                    }
                    _this.messages.push(JSON.parse(evt.data));
                    setTimeout(() => {
                        var div = document.getElementById('chat');
                        div.scrollTop += div.clientHeight;
                    }, 100);
                };

                websocket.onerror = function (evt, e) {
                    console.log('Error occured: ' + evt.data);
                };
                this.websocket = websocket;
                setTimeout(() => {
                    websocket.send('ping');
                }, 30000);
            },
            sendMessage(message, type) {
                const tid = this.live.id;
                const {uid, username, avatar} = window.pageConfig;
                var data = {
                    tid,
                    uid,
                    username,
                    avatar,
                    message,
                    type
                }
                this.websocket.send(JSON.stringify(data));
            },
            handleSend() {
                if (!this.message) {
                    this.$toast.fail({message: '评论内容不能为空', className: 'w150'});
                    return false;
                }
                this.sendMessage(this.message, 1);
                this.message = null;
                //this.showDialog = false;
            },
            buyTicket() {
                const id = this.live.id;
                const openid = window.openid;
                this.$post('/live/buyticket', {
                    id,
                    openid,
                    appid: 1
                }).then(response => {
                    var config = response.result.config;
                    if (!config.timestamp) {
                        config.timestamp = config.timeStamp;
                    }
                    config.success = (res) => {
                        this.$toast.success('付款成功');
                        this.fetchTicket();
                    };
                    wx.chooseWXPay(config);
                });
            },
            setShareData() {
                const live = this.live;
                const {username} = window.pageConfig;
                wx.ready(function () {
                    wx.updateAppMessageShareData({
                        title: live.title, // 分享标题
                        desc: username+'邀请您来一起看直播', // 分享描述
                        link: live.m_url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: live.image, // 分享图标
                        success: function () {
                            // 设置成功
                            console.log('设置成功');
                        }
                    });

                    wx.updateTimelineShareData({
                        title: live.title, // 分享标题
                        link: live.m_url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: live.image, // 分享图标
                        success: function () {
                            // 设置成功
                        }
                    });
                });
            }
        },
        computed: {}
    }
</script>

<style scoped>

</style>

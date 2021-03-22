<template>
    <div id="dplayer" class="dplayer"></div>
</template>

<script>
    export default {
        name: "LivePlayer",
        props: {
            live: {}
        },
        mounted() {
            this.initPlayer();
        },
        methods: {
            initPlayer() {
                const {hls, hls_low, hls_hd, image, video_url, hls_play_url} = this.live;
                let options = {
                    container: document.getElementById('dplayer'),
                    video: {},
                    live: true,
                    lang: 'zh-cn',
                    autoplay: true,
                    volume: 1,
                };

                if (this.live.state === 1) {
                    options.live = true;
                    options.video = {
                        pic: image,
                        quality: [
                            {
                                name: '高清',
                                url: hls_hd,
                                type: 'hls',
                            },
                            {
                                name: '标清',
                                url: hls,
                                type: 'hls',
                            },
                            {
                                name: '流畅',
                                url: hls_low,
                                type: 'hls',
                            },
                        ],
                        defaultQuality: 1
                    }
                }

                if (this.live.state === 2) {
                    options.live = false;
                    options.playbackSpeed = [0.5, 0.75, 1, 1.25, 1.5, 2];
                    options.video = {
                        pic: image,
                        url: hls_play_url,
                        type: 'hls'
                    }
                }

                this.player = new DPlayer(options);
            },
        },
        watch: {
            live: (val, oldVal) => {
                this.initPlayer();
            }
        }
    }
</script>

<style scoped>

</style>

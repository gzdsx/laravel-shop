<template>
    <div>
        <van-cell-group>
            <van-cell
                    v-for="(kf,index) in items"
                    :key="index"
                    :title="kf.title"
                    size="large"
                    is-link
                    @click="callPhone(kf.phone)"
            />
        </van-cell-group>
    </div>
</template>

<script>
    export default {
        name: "KefuList",
        data() {
            return {
                items: []
            }
        },
        mounted() {
            this.$get('/kefu/list').then(response => {
                let {items} = response.result;
                this.items = items;
            });
        },
        methods: {
            callPhone(phone) {
                window.location.href = 'tel://' + phone;
            }
        }
    }
</script>

<style scoped>
    .van-cell--large {
        padding-top: 16px;
        padding-bottom: 16px;
    }
</style>

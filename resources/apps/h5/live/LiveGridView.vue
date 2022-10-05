<template>
    <div class="live-grid-view">
        <div class="live-list">
            <div class="live-list-item" v-for="(item,index) in items" :key="index">
                <a :href="item.m_url">
                    <div class="inner">
                        <div class="pic-box">
                            <img :src="item.image" alt="">
                        </div>
                        <div class="ctx-box">
                            <div class="title">{{item.title}}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LiveGridView",
        props: {
            items: []
        }
    }
</script>

<style scoped>

</style>

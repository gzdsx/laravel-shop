<template>
    <div class="van-loading-wrapper" :class="{'van-loading-fixed':fixed}">
        <van-loading :vertical="vertical" :color="color" :type="type"/>
    </div>
</template>

<script>
    export default {
        name: "LoadingView",
        props: {
            fixed: {
                type: Boolean,
                default: true
            },
            vertical: {
                type: Boolean,
                default: true
            },
            color: {
                type: String,
                default: '#c9c9c9'
            },
            type: {
                type: String,
                default: 'circular'
            }
        }
    }
</script>

<style scoped>

</style>

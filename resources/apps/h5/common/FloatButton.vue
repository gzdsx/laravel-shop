<template>
    <div>
        <div class="float-button">
            <router-link :to="to">
                <div class="title">{{title}}</div>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FloatButton",
        props: {
            to: {
                type: String,
                default: ''
            },
            title:{
                type: String,
                default: '发布'
            }
        },
        data() {
            return {}
        },
        methods: {
        }
    }
</script>

<style lang="scss" scoped>

</style>

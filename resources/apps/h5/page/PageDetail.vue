<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <div class="page-content">
            <div v-html="page.content"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PageDetail",
        data() {
            return {
                loading: true,
                page: {}
            }
        },
        methods: {
            fetchData() {
                let {id} = this.$route.params;
                this.$get('/page/info', {id}).then(response => {
                    document.title = response.result.title;
                    this.page = response.result;
                    this.loading = false;
                });
            }
        },
        mounted() {
            this.fetchData();
        }
    }
</script>

<style scoped>
    .page-content {
        margin: 15px;
        font-size: 16px;
        text-align: justify;
        color: #666666;
        overflow: hidden;
    }

    .page-content * {
        max-width: 100%;
    }
</style>

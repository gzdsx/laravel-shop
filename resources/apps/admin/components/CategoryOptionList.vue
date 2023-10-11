<template>
    <div>
        <template v-for="category in categories">
            <el-option :value="category.cate_id" :label="lines+''+category.name"/>
            <category-option-list :categories="category.children" :level="level+1"/>
        </template>
    </div>
</template>

<script>
export default {
    name: "CategoryOptionList",
    props: {
        categories: [],
        disbaled: 0,
        level: 0
    },
    computed: {
        lines() {
            if (this.level > 0) {
                var str = '';
                for (let i = 0; i <= this.level; i++) {
                    str += '-'
                }

                return str;
            }

            return '';
        }
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
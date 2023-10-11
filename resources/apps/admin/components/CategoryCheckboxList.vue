<template>
    <ul class="category-checkbox-list">
        <li v-for="(category,index) in categories" :key="category.cate_id">
            <label>
                <el-checkbox :label="category.cate_id">{{ category.name }}</el-checkbox>
            </label>
            <category-checkbox-list :categories="category.children"/>
        </li>
    </ul>
</template>

<script>
export default {
    name: "CategoryCheckboxList",
    props: {
        categories: []
    }
}
</script>

<style scoped>

</style>
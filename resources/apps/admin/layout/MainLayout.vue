<template>
<div>
    <header class="page-header">
        <slot name="header"></slot>
    </header>
    <main class="page-body">
        <slot></slot>
    </main>
    <slot name="footer"></slot>
</div>
</template>

<script>
export default {
    name: "MainLayout"
}
</script>

<style scoped>

</style>
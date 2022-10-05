<template>
    <div>
        <div :style="{height:height+'px'}"></div>
        <div class="bottom-fixed-bar" :style="{'bottom':bottom+'px'}">
            <div class="bar" :class="barClass" :style="{'background-color':backgroundColor}">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FixedBottom",
        props: {
            barClass: {
                type: String,
                default: ''
            },
            backgroundColor: {
                type: String,
                default: '#fff'
            },
            height: {
                type: Number,
                default: 60
            },
            bottom: {
                type: Number,
                default: 0
            }
        }
    }
</script>

<style scoped>

</style>

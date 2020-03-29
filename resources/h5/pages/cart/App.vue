<template>
    <div class="container" style="background-color: #fff;">
        <div class="cart">
            <van-checkbox-group v-model="result">
                <div class="cart-item" v-for="item in cart_DATA" :key="item.id">
                    <div class="checkbox-view">
                        <van-checkbox :name="item.id" ref="checkboxes"/>
                    </div>
                    <div class="bg-cover image" :style="'background-image: url('+item.thumb+')'"></div>
                    <div class="data">
                        <div class="title">{{item.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="price">￥{{item.price}}</div>
                            <div>
                                <van-stepper
                                        v-model="item.quantity"
                                        :default-value="item.quantity"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </van-checkbox-group>
        </div>
        <tab-bar active-index="2"/>
    </div>
</template>

<script>
    import TabBar from "../../components/TabBar";
    import {Stepper, Checkbox, CheckboxGroup} from 'vant';

    Vue.use(Stepper);
    Vue.use(Checkbox);
    Vue.use(CheckboxGroup);

    export default {
        name: "App",
        components: {
            'tab-bar': TabBar
        },
        data: function () {
            return {
                cart_DATA,
                result: []
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>

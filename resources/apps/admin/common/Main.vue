<template>
    <div class="admin-wrapper">
        <div class="sidebar">
            <div class="v-common-menu-wrapper">
                <div class="v-common-main-nav">
                    <div class="v-common-logo">
                        <img :src="'/images/common/favicon.png'" class="logo" alt="">
                    </div>
                    <div class="v-common-menu-list">
                        <div class="v-common-menu">
                            <div
                                    class="v-common-nav-model"
                                    v-for="(nav,index) in navs"
                                    :key="index"
                                    :class="{'v-common-nav-model-active':index===current}"
                                    @click="onClickNav(index)"
                            >
                                <a class="v-common-nav-model-link">
                                    <div class="v-common-icon iconfont" :class="nav.icon"></div>
                                    <div class="v-common-menu-name">{{nav.name}}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="v-common-second-nav">
                    <div class="v-common-second-nav-title">{{currentNav.fullName}}</div>
                    <div class="v-common-second-nav-wrapper">
                        <div class="v-common-second-nav-name" v-for="(nav2,idx) in currentNav.children" :key="idx">
                            <a :href="nav2.path" target="_blank" v-if="nav2.isLink">{{nav2.name}}</a>
                            <router-link :to="nav2.path" v-else>{{nav2.name}}</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainframe">
            <div class="mainframe-container" id="app">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
    import navs from "../navs";

    export default {
        name: "Main",
        data() {
            return {
                current: 0,
                currentNav: {
                    name: '',
                    fullName: '',
                    icon: '',
                    path: '',
                    group: '',
                    children: []
                },
                navs
            }
        },
        mounted() {
            let {group} = this.$route.meta;
            this.navs.map((nav, i) => {
                if (nav.group === group) {
                    this.current = i;
                    this.currentNav = this.navs[i];
                }
            });
            //this.currentNav = this.navs[0];
        },
        methods: {
            onClickNav(index) {
                this.current = index;
                this.currentNav = this.navs[index];
                this.$router.push(this.currentNav.path);
            }
        }
    }
</script>

<style scoped>

</style>

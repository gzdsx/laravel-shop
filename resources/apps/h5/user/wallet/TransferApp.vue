<template>
    <div class="transfer">
        <div class="transfer-header">
            <div class="input-container">
                <input type="tel" v-model="name" class="input" placeholder="输入对方姓名或手机号">
                <button class="button" @click="search">确定</button>
            </div>
        </div>
        <div class="transfer-commonly">
            <div class="transfer-commonly-header">常用联系人</div>
            <div class="transfer-commonly-list">
                <div class="list-item" v-for="(user,index) in items" :key="index" @click="showFill(user.uid)">
                    <img :src="user.avatar" class="avatar" alt="">
                    <div class="flex-fill">
                        <div class="username">{{user.username}}</div>
                        <div class="tel">{{user.phone}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TransferApp",
        data() {
            return {
                name: '',
                items: []
            }
        },
        methods: {
            search() {
                let {name} = this;
                if (!name) {
                    this.$toast.fail('请输入对方姓名或手机号');
                    return false;
                }

                this.$get('/user/transfer.search', {name}).then(response => {
                    let {uid} = response.result.user;
                    this.showFill(uid);
                }).catch(reason => {
                    this.$toast.fail('您输入的联系人不存在');
                });
            },
            showFill(uid) {
                this.$router.push({path: '/transfer/fill', query: {uid}});
            },
            fetchList() {
                this.$get('/user/transfer.commonly').then(response => {
                    let {items} = response.result;
                    this.items = items;
                });
            }
        },
        mounted() {
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>

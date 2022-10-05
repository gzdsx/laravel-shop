<template>
    <van-form @submit="onSubmit">
        <van-field
                v-model="title"
                name="title"
                placeholder="请填写你要反馈的问题"
                :rules="[{ required: true}]"
                class="van-field-large"
        />
        <van-field
                v-model="message"
                type="textarea"
                name="message"
                placeholder="请简单描述一下你的问题"
                :rules="[{ required: true }]"
                class="van-field-large"
                :rows="5"
        />
        <div style="margin: 16px;">
            <van-button block type="info" native-type="submit">
                提交
            </van-button>
        </div>
    </van-form>
</template>

<script>
    export default {
        name: "FeedBack",
        data: function () {
            return {
                title: '',
                message: ''
            }
        },
        methods: {
            onSubmit: function (e) {
                const {title,message} = e;
                if (title && message){
                    this.$axios.post('/h5/feedback',{title,message}).then(response=>{
                        this.$toast.success('你的信息已提交');
                        this.title = '';
                        this.message = '';
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>

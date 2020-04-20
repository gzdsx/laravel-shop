<template>
    <van-form @submit="onSubmit">
        <van-field
                v-model="title"
                name="title"
                label="标题"
                placeholder="请填写你要反馈的问题"
                :rules="[{ required: true}]"
        />
        <van-field
                v-model="message"
                type="textarea"
                name="message"
                label="内容"
                placeholder="请简单描述一下你的问题"
                :rules="[{ required: true }]"
                style="height: 200px;"
        />
        <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
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

@extends('layouts.h5')

@section('title', '添加银行卡')

@section('content')
    <div class="bank-card" id="app">
        <div class="weui-cells weui-cells_form margin-0">
            <div class="weui-cell">
                <div class="weui-cell__hd cell-label">真实姓名</div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" v-model='card.name' required placeholder="请输入真实姓名">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd cell-label">手机号码</div>
                <div class="weui-cell__bd">
                    <input type="text" v-model="card.phone" class="weui-input" required placeholder="请输入手机号码">
                </div>
            </div>
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__hd cell-label no-asterisk">卡类型</div>
                <div class="weui-cell__bd">
                    银行卡
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd cell-label">开户银行</div>
                <div class="weui-cell__bd">
                    <input type="text" v-model="card.bank" class="weui-input" required placeholder="请输入开户银行">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd cell-label">卡号</div>
                <div class="weui-cell__bd">
                    <input type="text" v-model="card.account_id" class="weui-input" required placeholder="请输入卡号">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd cell-label">支行信息</div>
                <div class="weui-cell__bd">
                    <input type="text" v-model="card.branch" class="weui-input" required placeholder="请输入支行信息">
                </div>
            </div>
        </div>

        <div class="fixed-bottom">
            <div class="fixed" style="padding: 10px;">
                <div class="btn-square btn-square-warn btn-square-big" v-on:click="submit()">保存</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                card:{
                    name:'',
                    phone:'',
                    type:1,
                    bank:'',
                    account_id:'',
                    branch:''
                },
                submiting:false
            },
            methods:{
                submit:function () {
                    if (this.submiting) return;
                    var card = this.card;

                    if (!card.name)
                    {
                        weui.topTips('请输入姓名');
                        return false;
                    }

                    if (!card.phone)
                    {
                        weui.topTips('请输入手机号码');
                        return false;
                    }

                    if (!card.bank)
                    {
                        weui.topTips('请输入开户银行');
                        return false;
                    }

                    if (!card.account_id)
                    {
                        weui.topTips('请输入卡号');
                        return false;
                    }

                    if (!card.branch)
                    {
                        weui.topTips('请输入支行信息');
                        return false;
                    }

                    this.submiting = true;
                    $.ajax({
                        type:'POST',
                        url:'/h5/card/store',
                        data:{card:card},
                        success:function (response) {
                            weui.toast('卡片添加成功',{
                                callback:function () {
                                    window.history.back();
                                }
                            });
                        }
                    });
                }
            }
        });
    </script>
@stop

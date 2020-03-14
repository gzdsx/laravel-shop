@extends('layouts.h5')

@section('title', '茶多分')

@section('content')
    <div class="app" id="app">
        <div class="game-fen">
            <p>当前茶多分</p>
            <h3>{{$wallet['points']}}</h3>
            <div class="zengsong">
                <a v-on:click="dialogShow=true">茶多分赠送</a>
            </div>
        </div>
        <div class="game-row">
            茶多分是什么
        </div>
        <div class="game-row">
            茶多分是证品荟生态中的积分，可以用于生态的商品兑换等。
        </div>
        <h3 class="game-fen-records-title">茶多分记录</h3>
        <ul class="game-fen-records">
            <li v-for="item in items">
                <div class="fen" v-if="item.trade_type">+@{{ item.points }}</div>
                <div class="fen" style="color: red;" v-if="!item.trade_type">-@{{ item.points }}</div>
                <div class="fen-detail">
                    <div class="subject">@{{ item.body }}</div>
                    <div class="time">@{{ item.created_at }}</div>
                </div>
            </li>
        </ul>
        <!--弹出赠送积分-->
        <div v-show="dialogShow">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__hd">
                    <div class="weui-dialog__title">赠送茶多分</div>
                </div>
                <div class="weui-dialog__bd">
                    <div class="dialog-cell">
                        <input class="weui-input" type="text" v-model="transfer.mobile" placeholder="请输入赠送人手机号"/>
                    </div>
                    <div class="dialog-cell">
                        <input class="weui-input" type="text" v-model="transfer.points" placeholder="转赠茶多分数量"/>
                    </div>
                    <div class="dialog-cell">
                        <input class="weui-input" type="password" v-model="transfer.jypass" placeholder="请输入交易密码"/>
                    </div>
                </div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default" v-on:click="dialogShow=false">取消</a>
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" v-on:click="doTransfer()">确定</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                dialogShow:false,
                transfer:{
                    mobile:'',
                    jypass:'',
                    points:''
                }
            },
            mounted:function(){
                this.loadRecords();
            },
            methods:{
                loadRecords:function(){
                    var $this = this;
                    $.ajax({
                        url:'/h5/game/getrecords',
                        success:function (response) {
                            $this.items = response.items;
                        }
                    });
                },
                doTransfer:function () {
                    //确认操作
                    var transfer = this.transfer;
                    if (!transfer.mobile)
                    {
                        weui.topTips('请填写对方手机号');
                        return false;
                    }

                    if (!transfer.points)
                    {
                        weui.topTips('请填写积分数量');
                        return false;
                    }
                    if (!transfer.jypass)
                    {
                        weui.topTips('请填写交易密码');
                        return false;
                    }

                    //隐藏对话框
                    this.dialogShow = false;
                    $.ajax({
                        url:'/h5/game/transfer',
                        data:{transfer:transfer},
                        type:'POST',
                        success:function (response) {
                            if (response.errcode)
                            {
                                weui.topTips(response.errmsg);
                            } else {
                                weui.toast('积分转让成功', {
                                    callback:function () {
                                        DSXUtil.reFresh();
                                    }
                                });
                            }
                        }
                    });
                }
            }
        });
    </script>
@stop

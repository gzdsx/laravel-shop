@extends('layouts.h5')

@section('title', '申请提现')

@section('content')
    <div class="commission" id="app">
        <div class="weui-cells weui-cells_form margin-0">
            <div class="weui-cell">
                <div class="weui-cell__hd margin-right-10">可提现金额</div>
                <div class="weui-cell__bd money">￥{{$wallet['commission']}}</div>
            </div>
            <div class="weui-cell weui-cell_access" data-link="{{url('h5/card')}}">
                <div class="weui-cell__bd">添加提现账号</div>
                <div class="weui-cell__ft"></div>
            </div>
            <div class="weui-cell weui-cell_access" v-on:click="pickBank()">
                <div class="weui-cell__hd asterisk">收款账号</div>
                <div class="weui-cell__bd">
                    @{{ bankName }}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd asterisk">提现金额</div>
                <div class="weui-cell__bd">
                    <input type="number" v-model="amount" class="weui-input" placeholder="请输入提现金额">
                </div>
            </div>
        </div>

        <div class="fixed-bottom">
            <div class="fixed" style="padding: 10px;">
                <div class="btn-square btn-square-warn btn-square-big" v-on:click="submit()">立即申请</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var balance = parseFloat('{{$wallet['commission']}}');
        var app = new Vue({
            el:'#app',
            data:{
                bankName:'',
                card_id:0,
                amount:'',
                submiting:false
            },
            methods:{
                pickBank:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/card/getjson',
                        success:function (response) {
                            var data = [];
                            response.items.forEach(function (item) {
                                data.push({
                                    label:item.bank,
                                    value:item.id
                                });
                            });

                            if (data.length > 0)
                            {
                                weui.picker(data, {
                                    onConfirm:function (result) {
                                        $this.card_id = result[0].value;
                                        $this.bankName = result[0].label;
                                    }
                                });
                            } else {
                                window.location.href = '{{url('h5/card')}}';
                            }
                        }
                    });
                },
                submit:function () {
                    if (!this.card_id)
                    {
                        weui.topTips('请选择收款账号');
                        return false;
                    }

                    if (!this.amount)
                    {
                        weui.topTips('请输入提现金额');
                        return false;
                    }

                    if (isNaN(this.amount))
                    {
                        weui.topTips('金额输入有误');
                        return false;
                    }

                    if (this.amount < 100)
                    {
                        weui.topTips('金额不能小于100元');
                        return false;
                    }

                    // if (this.amount%100 !== 0)
                    // {
                    //     weui.topTips('金额必须是100的倍数');
                    //     return false;
                    // }

                    if (this.amount > balance)
                    {
                        weui.topTips('余额不足');
                        return false;
                    }

                    if (this.submiting)
                    {
                        return false;
                    } else  {
                        this.submiting = true;
                    }

                    var loading;
                    $.ajax({
                        type:'POST',
                        url:'/h5/commission/applywithdraw',
                        data:{
                            card_id:this.card_id,
                            amount: this.amount
                        },
                        beforeSend:function () {
                            loading = weui.loading('处理中');
                        },
                        success:function (response) {
                            setTimeout(function () {
                                loading.hide();
                                weui.toast('申请已提交',
                                    {
                                        callback:function () {
                                            window.location.href = '/h5/commission';
                                        }
                                    })
                            });
                        }
                    });
                }
            }
        });
    </script>
@stop

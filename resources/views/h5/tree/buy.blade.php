@extends('layouts.h5')

@section('title', '购买茶树')

@section('content')
    <div class="app" id="app">
        <div class="buytree">
            <div class="list-item" v-for="item in items">
                <div class="image bg-cover" :style="{'background-image':'url('+item.image+')'}"></div>
                <div class="content">
                    <div class="title">@{{ item.title }}</div>
                    <p>共释放: @{{ item.bubbles }}茶多分</p>
                    <p>是否周期: @{{ item.days }}天</p>
                    <p>所需积分: <span class="money">@{{ item.points }}积分</span></p>
                    <div class="quantity-box">
                        <div class="quantity-control">
                            <div class="ac" v-on:click="decrease(item)">-</div>
                            <div><input type="text" class="textfield" v-model="item.quantity"></div>
                            <div class="ac" v-on:click="increase(item)">+</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed-bottom">
            <div class="fixed">
                <div class="display-flex">
                    <div class="flex display-flex" style="padding: 0 15px; line-height: 3;">
                        <p class="flex fontsize-14">剩余积分:@{{ restPoints }}</p>
                        <p class="fontsize-14">合计:<span class="money">@{{ totalPoints }}</span>积分</p>
                    </div>
                    <div class="weui-btn weui-btn_warn" style="width: 25%; border-radius: 0;" v-on:click="settlement()">结算</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script>var trees = @json($trees);</script>
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:trees,
                balance:parseFloat('{{$wallet['bonus_points']}}').toFixed(2)
            },
            computed:{
                totalPoints:function () {
                    var totalP = 0;
                    this.items.forEach(function (item) {
                        totalP+= item.points * item.quantity;
                    });
                    return totalP;
                },
                restPoints:function () {
                    if (this.balance >= this.totalPoints)
                    {
                        return this.balance - this.totalPoints;
                    } else {
                        return 0;
                    }
                }
            },
            methods:{
                decrease:function (item) {
                    if (item.quantity > 0){
                        item.quantity--;
                    }
                },
                increase:function (item) {
                    item.quantity++;
                },
                settlement:function () {
                    if (this.totalPoints > this.balance)
                    {
                        weui.toast('积分余额不足');
                        return false;
                    }

                    var trees = [];
                    this.items.forEach(function (item) {
                        if (item.quantity > 0)
                        {
                            trees.push({
                                treeid:item.treeid,
                                quantity:item.quantity
                            });
                        }
                    });

                    if (trees.length == 0)
                    {
                        weui.toast('请选择树');
                        return false;
                    }

                    var loading;
                    $.ajax({
                        type:'POST',
                        url:'/h5/tree/buy',
                        data:{trees:trees},
                        beforeSend:function () {
                            loading = weui.loading('处理中...');
                        },
                        success:function (response) {
                            //alert(JSON.stringify(response));
                            setTimeout(function () {
                                loading.hide();
                                weui.toast('购买成功', {
                                    callback:function () {
                                        window.location.href = '/h5/tree';
                                    }
                                });
                            }, 500);
                        }
                    });
                }
            }
        });
    </script>
@stop

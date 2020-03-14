@extends('layouts.h5')

@section('title', '购物车')

@section('content')
    <div class="app" id="app">
        <div class="h5-cart">
            <form method="post" action="{{url('h5/auction/confirmorder')}}" id="Form">
                @csrf
                <div class="list-item" v-for="item in items">
                    <a class="delete" v-on:click="delItem(item)">&times;</a>
                    <div class="cell-checkbox">
                        <div :class="{checked:item.checked}" v-on:click="checkItem(item)">
                            <span class="iconfont icon-roundcheck" v-show="!item.checked"></span>
                            <span class="iconfont icon-roundcheckfill" v-show="item.checked"></span>
                            <input type="checkbox" name="items[]" :value="item.itemid" :checked="item.checked" style="display: none;">
                        </div>
                    </div>
                    <div class="image bg-cover" :style="{'background-image':'url('+item.thumb+')'}"></div>
                    <div class="cell-content">
                        <div class="title" style="margin-right: 30px;">@{{ item.title }}</div>
                        <div class="sku-name">[产品规格]</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="price flex">￥@{{ item.price }}</div>
                            <div class="quantity-control">
                                <div class="ac" v-on:click="decrease(item)">-</div>
                                <div><input type="text" class="textfield" style="width: 30px;" v-model="item.quantity" v-on:blur="quantityChanged(item)"></div>
                                <div class="ac" v-on:click="increase(item)">+</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="h5-cart-bottom">
            <div class="content" id="settlementBar">
                <div class="flex display-flex info-bar">
                    <div class="flex" v-on:click="checkAll()">
                        <i class="iconfont icon-roundcheckfill checked" style="font-size: 22px;" v-show="checkall"></i>
                        <i class="iconfont icon-roundcheck" style="font-size: 22px;" v-show="!checkall"></i>
                        <span>已选(@{{ checkedCount }})</span>
                    </div>
                    <div>
                        <span>合计:</span>
                        <span class="money" id="totalFee">￥@{{ totalFee }}</span>
                    </div>
                </div>
                <div class="settlement" v-on:click="settlement()">结算</div>
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
                checkall:false,
                checkedCount:0,
                totalFee:'0.00'
            },
            mounted:function(){
                this.loadItems();
            },
            methods:{
                loadItems:function(){
                    var self = this;
                    $.ajax({
                        url:'/h5/cart/getjson',
                        success:function (response) {
                            self.items = response.items;
                        }
                    });
                },
                decrease:function (item) {
                    if (item.quantity > 1) {
                        item.quantity--;
                        this.quantityChanged(item);
                        this.total();
                    }
                },
                increase:function (item) {
                    item.quantity++;
                    this.quantityChanged(item);
                    this.total();
                },
                checkItem:function (item) {
                    item.checked = !item.checked;
                    this.total();
                },
                checkAll:function(){
                    var self = this;
                    this.checkall = !this.checkall;
                    this.items.forEach(function (item) {
                        item.checked = self.checkall;
                    });
                    this.total();
                },
                total:function () {
                    var totalFee = 0;
                    var totalCount = 0;
                    var checkedCount = 0;
                    this.items.forEach(function (item) {
                        totalCount+= item.quantity;
                        if (item.checked){
                            totalFee+= item.price * item.quantity;
                            checkedCount+= item.quantity;
                        }
                    });

                    this.checkall = checkedCount == totalCount ? true : false;
                    this.totalFee = totalFee.toFixed(2);
                    this.checkedCount = checkedCount;
                },
                settlement:function () {
                    var items = [];
                    this.items.forEach(function (item) {
                        if (item.checked){
                            items.push(item.itemid);
                        }
                    });

                    if (items.length === 0) {
                        weui.toast('请选择商品');
                        return false;
                    } else {
                        $("#Form").submit();
                    }
                },
                delItem:function (item) {
                    var self = this;
                    weui.confirm('确认删除此宝贝吗?', function () {
                        $.ajax({
                            type:'POST',
                            data:{itemid:item.itemid},
                            url:'/h5/cart/delete',
                            success:function (response) {
                                self.loadItems();
                            },
                            complete:function (xhr) {
                                //alert(JSON.stringify(xhr));
                            }
                        });
                    });
                },
                quantityChanged:function (item) {
                    $.ajax({
                        url:'/h5/cart/updatequantity',
                        data:item,
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                }
            }
        });
    </script>
@stop

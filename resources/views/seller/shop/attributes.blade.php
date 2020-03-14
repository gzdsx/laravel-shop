<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>选择型号分类</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/boot.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <style type="text/css">
        .h3-title{
            font-size: 14px;
        }
        .names{
            display: block;
        }
        .names ul{
            padding: 15px 0;
        }
        .names .list-item{
            line-height: 2;
            border: 1px #ccc solid;
            border-radius: 6px;
            float: left;
            margin-right: 10px;
            text-align: center;
            padding: 0 15px;
            font-size: 12px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .form-control{
            display: inline-block;
            vertical-align: 0;
        }
    </style>
</head>
<body>
<div id="app">
    <h3 class="h3-title">选择型号</h3>
    <div class="names">
        <ul>
            <li class="list-item" v-for="item in items" v-on:click="onClickItem(item)">@{{ item.attr_name }}</li>
        </ul>
    </div>
    <div>
        <input type="text" class="form-control w200" v-model="attr_name">
        <button class="btn btn-default" v-on:click="saveAttribute()">添加新分类</button>
    </div>
</div>
<script type="text/javascript">
    var app = new Vue({
        el:'#app',
        data:{
            items:[],
            attr_name:''
        },
        mounted:function () {
            this.loadItems();
        },
        methods:{
            loadItems:function () {
                $.ajax({
                    url:'/seller/attribute/getattributes',
                    success:function (response) {
                        app.items = response.items;
                    }
                });
            },
            saveAttribute:function () {
                if (!this.attr_name)
                {
                    DSXUI.error('请填写分类名称');
                    return false;
                }

                $.ajax({
                    type:'POST',
                    data: {
                        attr_name:this.attr_name
                    },
                    url:'/seller/attribute/saveattribute',
                    success:function () {
                        app.attr_name = '';
                        app.loadItems();
                    }
                });
            },
            onClickItem:function (attr) {
                if (window.top.onPickedAttribute)
                {
                    window.top.onPickedAttribute(attr);
                }
            }
        }
    });
</script>
</body>
</html>

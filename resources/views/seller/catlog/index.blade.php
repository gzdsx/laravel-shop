@extends('layouts.seller')

@section('title', '商品分类')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a @click="showModal()">
                <span class="btn btn-danger">添加分类</span>
            </a>
        </div>
        <h2>商品分类</h2>
    </div>
    <div class="content-div">
        <div class="catlog-table">
            <div class="table-tr">
                <div class="table-th th1">分类名称</div>
                <div class="table-th th2">操作</div>
            </div>

            <div class="table-tr-group" v-for="item in items" :key="item.catid">
                <div class="table-tr">
                    <div class="table-th th1">@{{ item.name }}</div>
                    <div class="table-th th2">
                        <a @click="delCatlog(item)">删除分类</a>
                        <a @click="editCatlog(item)">修改名称</a>
                        <a @click="showItems(item)" v-if="item.children.length==0">商品管理</a>
                    </div>
                </div>
                <div class="table-tr" v-for="child in item.children" :key="child.catid">
                    <div class="table-td th1 child-catlog">@{{ child.name }}</div>
                    <div class="table-td th2">
                        <a @click="delCatlog(child)">删除分类</a>
                        <a @click="editCatlog(child)">修改名称</a>
                        <a @click="showItems(child)">商品管理</a>
                        <a @click="changeToTop(child)">变为一级</a>
                    </div>
                </div>
                <div class="table-tr">
                    <div class="add-child">
                        <div class="btn btn-default" @click="addChildCatlog(item.catid)">+添加子分类</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="catlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@{{ modalTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>分类名称</p>
                    <input type="text" class="form-control" placeholder="" v-model="catlog.name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" @click="saveCatlog()">保存</button>
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
                catid:0,
                catlog:{
                    name:'',
                    fid:0,
                    displayorder:0
                },
                oriCatlog:{
                    name:'',
                    fid:0,
                    displayorder:0
                },
                modalTitle:'编辑分类',
            },
            created:function(){
                this.loadItems();
            },
            methods:{
                loadItems:function(){
                    $.ajax({
                        url:'/seller/catlog/getcatloglist',
                        success:function (response) {
                            app.items = response.items;
                        }
                    });
                },
                showModal:function () {
                    $("#catlogModal").modal('show');
                },
                addChildCatlog:function(fid){
                    this.catlog.fid = fid;
                    $("#catlogModal").modal('show');
                },
                saveCatlog:function () {
                    var catlog = this.catlog;
                    if (!catlog.name)
                    {
                        DSXUI.showToast('请填写分类名称');
                        return false;
                    }

                    $.ajax({
                        type:'POST',
                        url:'{{url('seller/catlog/save')}}',
                        data:{catlog:catlog, catid:app.catid},
                        success:function (response) {
                            $("#catlogModal").modal('hide');
                            app.loadItems();
                            app.catlog = app.oriCatlog;
                        }
                    });
                },
                changeToTop:function (catlog) {
                    $.ajax({
                        url:'/seller/catlog/changetotop',
                        data:{catid:catlog.catid},
                        success:function (response) {
                            app.loadItems();
                        }
                    });
                },
                delCatlog:function (catlog) {
                    DSXUI.showConfirm('确认要删除吗?', function () {
                        $.ajax({
                            url:'/seller/catlog/delete',
                            data:{catid:catlog.catid},
                            success:function (response) {
                                app.loadItems();
                            }
                        });
                    });
                },
                editCatlog:function (catlog) {
                    this.catlog = catlog;
                    this.catid = catlog.catid;
                    $("#catlogModal").modal('show');
                },
                showItems:function (catlog) {
                    window.location.href = '/seller/catlog/items?catid='+catlog.catid;
                }
            }
        });
    </script>
@stop

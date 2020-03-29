@extends('layouts.admin')

@section('title', '商品管理')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">商品管理</li>
        <li class="breadcrumb-item active">商品列表</li>
    </ol>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">店铺名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="shop_name" value="{{$shop_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">卖家账号:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="seller_name" value="{{$seller_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">销售状态:</div>
                    <div class="field">
                        <select title="" class="form-control custom-select w200" name="sale_state">
                            <option value="0">全部</option>
                            <option value="on_sale"{{$sale_state=='on_sale' ? ' selected="selected"': ''}}>出售中</option>
                            <option value="off_sale"{{$sale_state=='off_sale' ? ' selected="selected"': ''}}>已下架</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">产品名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="title" value="{{$title}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">价格区间:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control w100" name="min_price" value="{{$min_price}}"> </label>
                        <label class="seperator">-</label>
                        <label><input type="text" title="" class="form-control w100" name="max_price" value="{{$max_price}}"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">商品ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="itemid" value="{{$itemid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">目录分类:</div>
                    <div class="field">
                        <select title="" class="form-control custom-select w200" name="catid">
                            <option value="0">全部</option>
                            {!! $catlogOptions !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <label><button type="submit" class="btn btn-primary">搜索</button></label>
                        <label><button type="reset" class="btn btn-default">重置</button></label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkmark" data-action="checkall"></th>
                    <th width="80">图片</th>
                    <th>商品名称</th>
                    <th>目录分类</th>
                    <th>价格</th>
                    <th>销量</th>
                    <th>推荐</th>
                    <th width="80">状态</th>
                    <th width="160">上架时间</th>
                    <th width="60">选项</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark itemid" name="items[]" value="{{$item['itemid']}}"></td>
                    <td>
                        <a href="{{$item['itemid']}}" title="商品ID:{{$item['itemid']}}" target="_blank">
                            <div class="bg-cover" style="background-image: url({{$item['thumb']}}); width: 60px; height: 60px;"></div>
                        </a>
                    </td>
                    <td>
                        <h4><a href="{{$item['url']}}" target="_blank">{{$item['title']}}</a></h4>
                        <p style="color:#f00; margin-top: 5px;">{{$item['subtitle']}}</p>
                    </td>
                    <td>{{$item['catlog']['name']}}</td>
                    <td><p><strong style="color: #f40;">{{$item['price']}}</strong></p></td>
                    <td>{{$item['sold']}}</td>
                    <td>
                        @if ($item['is_best'])
                            <span class="iconfont icon-check"></span>
                        @else
                            <span class="iconfont icon-close"></span>
                        @endif
                    </td>
                    <td>{{$item->on_sale ? '出售中' : '已下架'}}</td>
                    <td>{{$item['created_at']}}</td>
                    <td><a href="{{admin_url('item/edit?itemid='.$item->itemid)}}">编辑</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="pagination float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label class="form-check-label"><input type="checkbox" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="delete">批量删除</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="onSale">批量上架</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="offSale">批量下架</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="toBest">首页推荐</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="offBest">取消推荐</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="move">批量移动</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="moveModal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">移动商品到分类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="mobile" class="col-form-label">选择目标分类</label>
                            <div class="input-group">
                                <select title="" class="form-control w200" id="moveTarget">
                                    {!! $catlogOptions !!}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnMove">确认</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                $(".btn-action").prop('disabled',$(".itemid:checked").length === 0);
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选宝贝吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('item/batchdelete')}}',
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });

            $("#onSale").on('click', function () {
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('item/batchonsale')}}',
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });

            $("#offSale").on('click', function () {
                DSXUI.showConfirm('确认要下架所选宝贝吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('item/batchoffsale')}}',
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });

            $("#toBest").on('click', function () {
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('item/togglebest')}}',
                    data:{is_best:1},
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });

            $("#offBest").on('click', function () {
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('item/togglebest')}}',
                    data:{is_best:0},
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });

            $("#move").on('click', function () {
                $("#moveModal").modal();
            });

            $("#btnMove").on('click', function () {
                $("#moveModal").modal('hide');
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('item/batchmove')}}',
                    data:{target:$("#moveTarget").val()},
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });
        });
    </script>
@stop

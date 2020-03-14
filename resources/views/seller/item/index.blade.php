@extends('layouts.seller')

@section('title', '宝贝管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form>
                <div class="input-group">
                    <input type="text" name="q" value="{{$q ?? ''}}" class="form-control w200" placeholder="商品名称">
                    <div class="input-group-append">
                        <button class="btn btn-danger">搜索</button>
                    </div>
                </div>
            </form>
        </div>
        <h2>商品管理</h2>
    </div>
    <div class="dsxui-tabs-container">
        <div class="dsxui-tabs">
            <div class="float-right">
                <a href="{{seller_url('item/publish')}}">
                    <span class="btn btn-danger w100">添加商品</span>
                </a>
            </div>
            <div class="tab-item">
                <a href="{{seller_url('item')}}" class="tab-link{{$tab=='all' ? ' active' : ''}}">全部</a>
            </div>
            <div class="tab-item">
                <a href="{{seller_url('item?tab=onSale')}}" class="tab-link{{$tab=='onSale' ? ' active' : ''}}">出售中</a>
            </div>
            <div class="tab-item">
                <a href="{{seller_url('item?tab=soldOut')}}" class="tab-link{{$tab=='soldOut' ? ' active' : ''}}">已售完</a>
            </div>
            <div class="tab-item">
                <a href="{{seller_url('item?tab=offShelf')}}" class="tab-link{{$tab=='offShelf' ? ' active' : ''}}">已下架</a>
            </div>
        </div>
    </div>
    <div class="content-div">
        <form method="post" id="Form" autocomplete="off">
            @csrf
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="30" class="first"><input title="" type="checkbox" class="checkmark" data-action="checkall"></th>
                    <th width="80">图片</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>销量</th>
                    <th>库存</th>
                    <th>分类</th>
                    <th>创建时间</th>
                    <th>状态</th>
                    <th width="80" class="align-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr id="item_{{$item['itemid']}}">
                        <td class="first">
                            <input title="" type="checkbox" class="checkmark itemid" name="items[]" value="{{$item['itemid']}}">
                        </td>
                        <td>
                            <div class="bg-cover" style="width: 80px; height: 80px; background-image: url({{$item['thumb']}})"></div>
                        </td>
                        <td>
                            <h3><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></h3>
                            <p style="margin-top: 5px; color: #888; font-size: 12px;">{{$item['subtitle']}}</p>
                        </td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['sold']}}</td>
                        <td>{{$item['stock']}}</td>
                        <td>
                            @foreach ($item->cates as $cate)
                                <p>{{$cate['name']}}</p>
                            @endforeach
                        </td>
                        <td>{{$item['created_at']}}</td>
                        <td>{{$item->on_sale ? '出售中' : '已下架'}}</td>
                        <td class="align-center">
                            <p><a href="{{seller_url('item/publish?itemid='.$item['itemid'])}}">编辑</a></p>
                            <p><a href="javascript:;" rel="del" data-id="{{$item['itemid']}}">删除</a></p>
                            <p><a href="javascript:;" onclick="showAppCode({{$item['itemid']}},{{$item['on_sale']}})">小程序码</a></p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20" class="first">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label class="form-check-label"><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" data-toggle="modal" data-target="#catlogModal">批量分类</button>
                            @if ($tab=='offShelf')
                                <button type="button" class="btn btn-default btn-action" id="onSale" disabled="disabled">批量上架</button>
                            @else
                                <button type="button" class="btn btn-default btn-action" id="offSale" disabled="disabled">批量下架</button>
                            @endif
                            <button type="button" class="btn btn-default btn-action" id="delete" disabled="disabled">批量删除</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>

    <div class="modal fade" id="catlogModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">批量分类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        @foreach ($shopCatlogs as $catlog)
                            <label style="margin: 10px;">
                                <input type="checkbox" class="catid" value="{{$catlog['catid']}}">
                                <span>{{$catlog['name']}}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" id="changeCatlog">保存</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        function showAppCode(itemid, onsale){
            if (!onsale){
                DSXUI.showAlert('商品已下架');
                return;
            }
            DSXUI.dialog({
                title:'小程序二维码',
                content:'<div class="align-center"><img src="{{seller_url('item/app_code?'.time())}}&itemid='+itemid+'" width="300"/></div>',
                showFooter:false
            });
        }
        $(function () {
            $(document).on('click', function () {
                $(".btn-action").prop('disabled', $(".itemid:checked").length === 0);
            });
            function submitForm(url, data) {
                $("#Form").ajaxSubmit({
                    url:url,
                    dataType:'json',
                    data:data,
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            }

            $("#delete").on('click', function () {
                submitForm('{{seller_url('item/delete')}}');
            });

            $("#onSale").on('click', function () {
                submitForm('{{seller_url('item/batchupdate')}}', {on_sale:1});
            });
            $("#offSale").on('click', function () {
                submitForm('{{seller_url('item/batchupdate')}}', {on_sale:0});
            });

            $("[rel=del]").on('click', function () {
                var itemid = $(this).attr('data-id');
                DSXUI.showConfirm('你确认要删除所选商品吗?', function () {
                    $.ajax({
                        type:'POST',
                        url:'{{seller_url('item/delete')}}',
                        data:{items:[itemid]},
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

            $("#changeCatlog").on('click', function () {
                var catlogs = [];
                $(".catid:checked").each(function () {
                    catlogs.push($(this).val());
                });

                if (catlogs.length === 0)
                {
                    DSXUI.showToast('请选择分类');
                    return false;
                }
                submitForm('{{seller_url('item/updatecatlog')}}',{catlogs:catlogs});
            });
        });
    </script>
@stop

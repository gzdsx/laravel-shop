@extends('layouts.admin')

@section('title', '订单列表')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">订单管理</li>
        <li class="breadcrumb-item active">订单列表</li>
    </ol>
    <div class="search-container">
        <form method="get" id="searchForm">
            <div class="row">
                <div class="cell">
                    <div class="label">订单编号:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="order_no" value="{{$order_no}}"></div>
                </div>
                <div class="cell">
                    <div class="label">卖家账号:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="seller_name" value="{{$seller_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">买家账号:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="buyer_name" value="{{$buyer_name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">订单状态:</div>
                    <div class="field">
                        <select title="" class="form-control custom-select w200" name="order_state">
                            <option value="0">全部</option>
                            @foreach (trans('order.order_states') as $k=>$v)
                                <option value="{{$k}}"{{$order_state==$k ? ' selected="selected"' : ''}}>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">付款方式:</div>
                    <div class="field">
                        <select title="" class="form-control custom-select w200" name="pay_type">
                            <option value="0">全部</option>
                            <option value="1"{{$pay_type==1 ? ' selected="selected"' : ''}}>在线支付</option>
                            <option value="2"{{$pay_type==2 ? ' selected="selected"' : ''}}>货到付款</option>
                        </select>
                    </div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">交易时间:</div>
                    <div class="field">
                        <label><input title="" type="text" class="form-control w100" name="time_begin" onclick="WdatePicker()" value="{{$time_begin}}"></label>
                        <label class="seperator">-</label>
                        <label><input title="" type="text" class="form-control w100" name="time_end" onclick="WdatePicker()" value="{{$time_end}}"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="button" class="btn btn-primary" id="btn-search">搜索订单</button>
                        <button type="button" class="btn btn-default" id="btn-export">批量导出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="dsxui-tabs-container">
        <ul class="dsxui-tabs">
            <li class="tab-item"><a href="{{admin_url('order?tab=all')}}" class="tab-link{{$tab=='all' ? ' active' : ''}}">全部订单</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=waitPay')}}" class="tab-link{{$tab=='waitPay' ? ' active' : ''}}">等待买家付款</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=waitSend')}}" class="tab-link{{$tab=='waitSend' ? ' active' : ''}}">买家已付款</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=send')}}" class="tab-link{{$tab=='send' ? ' active' : ''}}">卖家已发货</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=received')}}" class="tab-link{{$tab=='received' ? ' active' : ''}}">交易成功</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=refunding')}}" class="tab-link{{$tab=='refunding' ? ' active' : ''}}">退款中</a></li>
            <li class="tab-item"><a href="{{admin_url('order?tab=closed')}}" class="tab-link{{$tab=='closed' ? ' active' : ''}}">已关闭</a></li>
        </ul>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40" class="center">选?</th>
                    <th width="60">图片</th>
                    <th>商品名称 | 卖家 | 订单号</th>
                    <th>买家账号</th>
                    <th width="100">金额</th>
                    <th width="150">下单时间</th>
                    <th width="100">交易状态</th>
                    <th width="60">详情</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$order['order_id']}}"></td>
                    <td>
                        <a href="{{item_url($order['item']['itemid'])}}" target="_blank">
                            <img src="{{$order['items'][0]['thumb']}}" width="50" height="50">
                        </a>
                    </td>
                    <td>
                        <h3><a href="{{admin_url('order/detail?order_id='.$order['order_id'])}}" target="_blank">{{$order['items'][0]['title']}}</a></h3>
                        <p>
                            <a href="{{shop_url($order['shop_id'])}}" target="_blank">{{$order['seller_name']}}</a>
                            <span> | </span>
                            <span>单号:{{$order['order_no']}}</span>
                        </p>
                    </td>
                    <td>{{$order['buyer_name']}}</td>
                    <td>{{$order['order_fee']}}</td>
                    <td>{{$order['created_at']}}</td>
                    <td>{{$order['order_state_des']}}</td>
                    <td><a href="{{admin_url('order/detail?order_id='.$order['order_id'])}}" target="_blank">查看</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="15">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default" id="batchdelete" disabled="disabled">批量删除</button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <iframe name="export" src="" style="display: none;"></iframe>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0){
                    $("#batchdelete").enable();
                }else {
                    $("#batchdelete").disable();
                }
            });
            $("#btn-search").on('click', function () {
                $("#searchForm").attr('action', '{{admin_url('order')}}').attr('target', '_self').submit();
            });
            $("#btn-export").on('click', function () {
                $("#searchForm").attr('action', '{{admin_url('order/export')}}').attr('target', '_blank').submit();
            });

            $("#batchdelete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选订单吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('order/batchdelete')}}',
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
        });
    </script>
@stop

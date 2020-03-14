@extends('layouts.user')

@section('title', '收货地址')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <div class="btn btn-primary" id="addNewAddress">添加收货地址</div>
        </div>
        <h2>收货地址管理</h2>
    </div>
    <div class="content-div">
        <table cellpadding="0" cellspacing="0" width="100%" border="0" class="listtable">
            <thead>
            <tr>
                <th width="120">联系人</th>
                <th width="120">电话</th>
                <th>地址</th>
                <th width="80">邮编</th>
                <th width="80">选项</th>
                <th width="100"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr id="item-{{$item['address_id']}}" class="addrRow">
                    <td height="50"><b>{{$item['consignee']}}</b></td>
                    <td>{{$item['phone']}}</td>
                    <td>{{$item['province']}} {{$item['city']}} {{$item['district']}} {{$item['street']}}</td>
                    <td>{{$item['zipcode']}}</td>
                    <td>
                        <a href="javascript:;" rel="edit" data-id="{{$item['address_id']}}">修改</a>
                        <a href="javascript:;" rel="delete" data-id="{{$item['address_id']}}">删除</a>
                    </td>
                    <td>
                        @if ($item['isdefault'])
                            <span class="btn btn-sm btn-primary">默认地址</span>
                        @else
                            <span class="btn btn-sm btn-default" rel="setdefault" data-id="{{$item['address_id']}}">设为默认</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        (function () {
            $("#addNewAddress").on('click', function () {
                return Widget.showAddressForm(0, DSXUtil.reFresh);
            });
            $("[rel=edit]").on('click', function () {
                var address_id = $(this).attr('data-id');
                Widget.showAddressForm(address_id, DSXUtil.reFresh);
            });
            $("a[rel=delete]").on('click', function () {
                var address_id = $(this).attr('data-id');
                DSXUI.showConfirm('确认要删除此收货地址吗?', function () {
                    $.ajax({
                        url:"{{url('/user/address/delete')}}",
                        data:{address_id:address_id},
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                $("#item-"+address_id).remove();
                            }, 500);
                        }
                    });
                });
            });
            $("[rel=setdefault]").on('click', function () {
                var address_id = $(this).attr('data-id');
                $.ajax({
                    type:'POST',
                    url:"{{url('/user/address/setdefault')}}",
                    data:{address_id:address_id},
                    success:function (response) {
                        DSXUtil.reFresh();
                    }
                });
            });
        })();
    </script>
@stop

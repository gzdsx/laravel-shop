@extends('layouts.seller')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">卖家中心</li>
        <li class="breadcrumb-item">订单管理</li>
        <li class="breadcrumb-item active">退款处理</li>
    </ul>
    <div class="content-div">
        <form method="post">
            @csrf
            <table width="100%" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">退货编号：</td>
                    <td>{{$refund->refund_no}}</td>
                </tr>
                <tr>
                    <td>退款原因：</td>
                    <td>{{$refund->refund_reason or '买家没有填写退款原因'}}</td>
                </tr>
                <tr>
                    <td>退款说明：</td>
                    <td>{{$refund->buyer_message ? $refund->buyer_message : '买家没有填写退款说明'}}</td>
                </tr>
                <tr>
                    <td>退货凭证：</td>
                    <td>
                        @foreach($refund->images as $img)
                            <img src="{{image_url($img)}}" width="140">
                        @endforeach
                    </td>
                </tr>
                @if ($refund->express)
                    <tr>
                        <td>退货单号：</td>
                        <td>{{$refund->refund_express_no}}</td>
                    </tr>
                    <tr>
                        <td>退货单号：</td>
                        <td>{{$refund->express->name}}</td>
                    </tr>
                @endif
                @if ($refund->refund_status)
                <tr>
                    <td>受理状态：</td>
                    <td>{{$refund->refund_status == 1 ? '已同意' : '已拒绝'}}</td>
                </tr>
                <tr>
                    <td>受理时间：</td>
                    <td>{{@date('Y-m-d H:i:s', $refund->updated_at)}}</td>
                </tr>
                <tr>
                    <td>卖家留言：</td>
                    <td>{{$refund->seller_message ? $refund->seller_message : '卖家没有填写退款说明'}}</td>
                </tr>
                @else
                <tr>
                    <td>是否同意：</td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="refund_status" value="1" checked> 同意退货
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="refund_status" value="2"> 拒绝退货
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>卖家回复</td>
                    <td><textarea class="form-control w500" name="seller_message" rows="6" placeholder="关于本次退款的说明"></textarea></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td><input class="btn btn-primary w100" type="submit" value="确认"></td>
                </tr>
                </tfoot>
                @endif
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $("#sub-form").click(function () {
            //获取表单信息
            var refund_status = $("input[name='refund_status']:checked").val();
            var order_id = $("input[name='order_id']").val();
            var seller_reply_text = $("textarea[name='seller_reply_text']").val();
            if (!refund_status){
                DSXUI.error('请先选择退款状态');
                return false;
            }
            if (!order_id){
                DSXUI.error('订单号不存在');
                return false;
            }
            if (!seller_reply_text){
                DSXUI.error('请输入本次退款说明');
                $("textarea[name='seller_reply_text']").focus()
                return false;
            }

            $.ajax({
                url: '/seller/trade/refund',
                method: "POST",
                data: {
                    order_id: order_id,
                    refund_status: refund_status,
                    seller_reply_text: seller_reply_text,
                    _token:$("input[name='_token']").val()
                },
                success: function (response) {
                    if (response.return_code == 0) {
                        DSXUI.showToast("申请提交成功！");
                        parent.layer.close(parent.layer.getFrameIndex(window.name)); //关闭当前弹窗
                        parent.location.reload();
                    }else{
                        DSXUI.showToast(response.errmsg);
                    }
                }
            });
        })
    </script>
@stop

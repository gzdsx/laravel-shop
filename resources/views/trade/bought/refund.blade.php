@extends('layouts.trade')

@section('title', '申请退款')

@section('content')
    <div class="area">
        <div class="content-div">
            <form method="post" autocomplete="off" id="Form">
                @csrf
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td width="80">服务类型</td>
                        <td>
                            <label><input type="radio" name="refund[refund_type]" value="1" checked="checked"> 仅退款</label>
                            <label><input type="radio" name="refund[refund_type]" value="2"> 退货退款</label>
                        </td>
                    </tr>
                    <tr>
                        <td>退款原因</td>
                        <td>
                            <select class="form-control custom-select w300" name="refund[refund_reason]" id="refundReason">
                                <option value="">请选择</option>
                                @foreach ($reasons as $reason)
                                    <option value="{{$reason['title']}}">{{$reason['title']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>退款金额</td>
                        <td><input type="text" class="form-control w300" name="refund[refund_amount]" value="{{$order->total_fee}}"></td>
                    </tr>
                    <tr>
                        <td>退款说明</td>
                        <td><textarea class="form-control w500 h100" name="refund[refund_desc]"></textarea></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-danger w100">提交</button></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $("#Form").submit(function () {
            var refundReason = $("#refundReason").val();
            if (!refundReason){
                DSXUI.showToast('请选择退款原因');
                return false;
            }
        });
    </script>
@stop

@extends('layouts.trade')

@section('title', '关闭订单')

@section('content')
    <div class="area">
        <div class="close-form">
            <form method="post" id="Form">
                {{csrf_field()}}
                <table cellspacing="0" cellpadding="0" width="100%" class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td width="80">取消原因</td>
                        <td>
                            <select title="" class="form-control custom-select w500" id="closeReason" name="closeReason">
                                <option value="">请选择关闭理由</option>
                                <option value="我不想买了">我不想买了</option>
                                <option value="信息填写错误，重新拍">信息填写错误，重新拍</option>
                                <option value="卖家缺货">卖家缺货</option>
                                <option value="同城见面交易">同城见面交易</option>
                                <option value="付款遇到问题（如余额不足、不知道怎么付款等）">付款遇到问题（如余额不足、不知道怎么付款等）</option>
                                <option value="拍错了">拍错了</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>其他原因</td>
                        <td><textarea title="" class="form-control w500 h100" id="otherReason" name="otherReason"></textarea></td>
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
            var closeReason = $("#closeReason").val();
            var otherReason = $("#otherReason").val();
            if (!closeReason && !otherReason){
                DSXUI.showToast('请选择取消订单的原因');
                return false;
            }
        });
    </script>
@stop

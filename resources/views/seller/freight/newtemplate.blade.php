@extends('layouts.seller')

@section('title', '编辑运费模板')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{seller_url('freight')}}">
                <span class="btn btn-danger">返回列表</span>
            </a>
        </div>
        <h2>编辑运费模板</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table class="dsxui-formtable" cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                <tr>
                    <td width="90" class="cell-label">模板名称</td>
                    <td><input type="text" name="template[template_name]" value="{{$template['template_name']}}" class="form-control w300" required></td>
                </tr>
                <tr>
                    <td class="cell-label">计价方式</td>
                    <td>
                        <div class="input-group">
                            <label><input type="radio" name="template[valuation]" value="1"{{$template['valuation'] == 1 ? ' checked' : ''}}> 按件数</label>
                            <label><input type="radio" name="template[valuation]" value="2"{{$template['valuation'] == 2 ? ' checked' : ''}}> 按重量(kg)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">默认运费</td>
                    <td>
                        <div class="input-group">
                            <label><input type="text" name="template[start_quantity]" value="{{$template['start_quantity']}}" class="form-control w100" required></label>
                            <label>件(或kg)内</label>
                            <label><input type="text" name="template[start_fee]" value="{{$template['start_fee']}}" class="form-control w100" required></label>
                            <label>元; 每增加</label>
                            <label><input type="text" name="template[growth_quantity]" value="{{$template['growth_quantity']}}" class="form-control w100" required></label>
                            <label>件(或kg)</label>
                            <label><input type="text" name="template[growth_fee]" value="{{$template['growth_fee']}}" class="form-control w100" required></label>
                            <label>元</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">包邮条件</td>
                    <td>
                        <div class="input-group">
                            <label><input type="text" name="template[free_quantity]" value="{{$template['free_quantity']}}" class="form-control w100" required></label>
                            <label>件(或kg)以上包邮或者金额满</label>
                            <label><input type="text" name="template[free_amount]" value="{{$template['free_amount']}}" class="form-control w100" required></label>
                            <label>元以上包邮。</label>
                        </div>
                        <p>不使用包邮条件请设置为0</p>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td><button class="btn btn-lg btn-danger w200">提交</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

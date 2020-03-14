@extends('layouts.user')

@section('title', '我的账单')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="console-title">
        <div class="float-right"><strong style="font-size: 18px;">当前余额: <span>{{$wallet['balance']}}</span></strong></div>
        <h2>我的钱包->交易明细</h2>
    </div>

    <div class="container">
        <div class="trade-filter-div">
            <form method="get" id="searchForm">
                <input type="hidden" name="date_range" value="{{$date_range}}" id="J_date_range">
                <input type="hidden" name="transaction_type" value="{{$transaction_type}}" id="J_transaction_type">
                <input type="hidden" name="pay_type" value="{{$pay_type}}" id="J_pay_type">
                <div class="row">
                    <div class="label">交易时间:</div>
                    <div class="content">
                        <a class="date-range{{$date_range=='all' ? ' cur' : ''}}" data-value="all">全部</a>
                        <a class="date-range{{$date_range=='3days' ? ' cur' : ''}}" data-value="3days">近三天</a>
                        <a class="date-range{{$date_range=='7days' ? ' cur' : ''}}" data-value="7days">近一周</a>
                        <a class="date-range{{$date_range=='oneMonth' ? ' cur' : ''}}" data-value="oneMonth">近一个月</a>
                        <a class="date-range{{$date_range=='threeMonth' ? ' cur' : ''}}" data-value="threeMonth">近三个月</a>
                        <a class="date-range{{$date_range=='oneYear' ? ' cur' : ''}}" data-value="oneYear">近一年</a>
                    </div>
                </div>
                <div class="row">
                    <div class="label">交易类型:</div>
                    <div class="content">
                        <a class="transaction-type{{$transaction_type=='all' ? ' cur' : ''}}" data-value="all">全部</a>
                        @foreach (trans('transaction.transaction_types') as $k=>$v)
                            <a class="transaction-type{{$transaction_type==$k ? ' cur' : ''}}" data-value="{{$k}}">{{$v}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="label">支付方式:</div>
                    <div class="content">
                        <a class="pay-type{{$pay_type=='all' ? ' cur' : ''}}" data-value="all">全部</a>
                        @foreach (trans('payment.pay_types') as $k=>$v)
                            <a class="pay-type{{$pay_type==$k ? ' cur' : ''}}" data-value="{{$k}}">{{$v}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="label">关键字:</div>
                    <div class="content">
                        <div class="input-group w300">
                            <input type="text" class="form-control" name="q" placeholder="交易名称，流水号" value="{{$q}}">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-primary" value="搜索">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="content-div">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable trade-list-table">
            <thead>
            <tr>
                <th class="head-time">创建时间</th>
                <th>名称 | 对方 | 交易号</th>
                <th class="amount">金额</th>
                <th class="text-right">状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td class="time"><span>{{$item->created_at->format('Y年m月d日')}}</span></td>
                    <td class="name">
                        <h3>{{$item['subject']}}</h3>
                        <p>{{$item->payee_uid == $uid ? $item['payer_name'] : $item['payee_name']}} | 流水:{{$item['transaction_no']}}</p>
                    </td>
                    <td class="amount">
                        @if ($item->payee_uid == $uid)
                            <span style="color: #0BB20C;">+{{$item['amount']}}</span>
                        @else
                            <span style="color: #ff0000;">-{{$item['amount']}}</span>
                        @endif
                    </td>
                    <td class="text-right">{{$item['transaction_state_des']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            <div class="float-right">{!! $pagination !!}</div>
        </div>
    </div>

@stop

@section('foot')
    <script type="text/javascript">
        $(function(){
            $(".date-range").on('click', function () {
                $("#J_date_range").val($(this).attr('data-value'));
                $("#searchForm").submit();
            });
            $(".transaction-type").on('click', function () {
                $("#J_transaction_type").val($(this).attr('data-value'));
                $("#searchForm").submit();
            });
            $(".pay-type").on('click', function () {
                $("#J_pay_type").val($(this).attr('data-value'));
                $("#searchForm").submit();
            });
        });
    </script>
@stop

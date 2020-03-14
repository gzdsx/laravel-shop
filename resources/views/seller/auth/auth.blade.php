@extends('layouts.seller')

@section('title', '店铺认证')

@section('content')
    <div class="console-title">
        <h2>店铺资质</h2>
    </div>
    <div class="dsxui-tabs-container margin-bottom-10">
        <div class="dsxui-tabs">
            <div class="tab-item">
                <a class="tab-link active">保证金保障</a>
            </div>
            <div class="tab-item">
                <a class="tab-link">品牌资质认证</a>
            </div>
        </div>
    </div>
    <div class="content-div">
        <h5>缴纳保证金，有助于提高你店铺的自身竞争力，让你从千万卖家中脱颖而出。</h5>
        <p>注意</p>
        <p>成功开通保证金保障后，你需要履行《消费者保障计划之保证金保障协议》中的服务；</p>
        <p>成功开通保证金保障后，该款项将冻结在你的账户中；</p>
        <p>成功开通保证金保障后，保证金将用于解决交易纠纷和售后问题；</p>
        <p>如符合该协议中约定的退出条件，你可以申请退出保证金保障，保证金将会退还到你的账户中。</p>

        <div style="margin-top: 30px;">
            <input type="checkbox"> 我已阅读并同意《微店消费者保障计划之保证金保障协议》
        </div>
        <div style="padding: 20px 0;">
            <button class="btn btn-danger btn-lg" disabled>开通保证金保障</button>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">

    </script>
@stop

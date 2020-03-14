@extends('layouts.seller')

@section('title', '数据分析')

@section('scripts')
    <script src="{{asset('js/highcharts.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>店铺设置</a>
        <span>></span>
        <a>数据统计</a>
    </div>
    <div class="tabs-container">
        <div class="tabs">
            <div class="tab-item" id="tab_all"><a href="{{url('seller/analyse?filter_content=all')}}" class="tab-link">开店至今</a></div>
            <div class="tab-item" id="tab_week"><a href="{{url('seller/analyse?filter_content=week')}}" class="tab-link">过去一周</a></div>
            <div class="tab-item" id="tab_month"><a href="{{url('seller/analyse?filter_content=month')}}" class="tab-link">过去一月</a></div>
            <div class="tab-item" id="tab_year"><a href="{{url('seller/analyse?filter_content=year')}}" class="tab-link">过去一年</a></div>
         </div>
    </div>
    <div class="content-div">
        <div id="highcharts" style="height: 450px;"></div>
    </div>

    <div class="blank"></div>
    <div class="list-div">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable">
            <thead>
            <tr>
                <th>名称</th>
                <th width="100">价格</th>
                <th width="100" class="align-right">产品销量</th>
                <th width="140" class="align-right">上架时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr id="row_{{$item['itemid']}}">
                    <td><a href="{{image_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></td>
                    <td>{{$item['price']}}</td>
                    <td class="align-right">{{$item['sold']}}</td>
                    <td class="align-right">{{@date('Y-m-d', $item['created_at'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $("#tab_{{$filter_content}}").addClass('on');
        $(function () {
            $('#highcharts').highcharts({
                chart: {
                    type: 'area'
                },
                title: {
                    text: null
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    categories: {!! $days_json !!},
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        //formatter: function () {
                        //    return this.value / 1000 + 'k';
                        //}
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}:{point.y:,.0f}'
                },
                plotOptions: {

                },
                series: [{
                    name: '访客数',
                    data: {!! $visit_json !!}
                }, {
                    name: '订单数',
                    data: {!! $order_json !!}
                },
                    {
                        name: '营业额',
                        data: {!! $turnovers_json !!}
                    }]
            });
        });
    </script>
@stop

@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form method="get" id="searchForm" action="">
                <input type="hidden" name="province" value="{{$province}}" id="J_province">
                <input type="hidden" name="city" value="{{$city}}" id="J_city">
                <input type="hidden" name="district" value="{{$district}}" id="J_district">
                <label>
                    <select title="" id="province" class="form-control custom-select" style="width: auto;">
                        <option>--省份--</option>
                        @foreach($provincelist as $p)
                            <option value="{{$p->id}}"@if($p->id==$province) selected="selected"@endif>{{$p['name']}}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <select title="" id="city" class="form-control custom-select" style="width: auto;">
                        <option value="0">--城市--</option>
                        @foreach($citylist as $c)
                            <option value="{{$c->id}}"@if($c->id==$city) selected="selected"@endif>{{$c['name']}}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <select title="" id="district" class="form-control custom-select" style="width: auto;">
                        <option value="0">--州县--</option>
                        @foreach($districtlist as $d)
                            <option value="{{$d->id}}"@if($d->id==$district) selected="selected"@endif>{{$d['name']}}</option>
                        @endforeach
                    </select>
                </label>
            </form>
        </div>
        <h2>区域管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40" class="center">删?</th>
                    <th>名称</th>
                    <th>拼音</th>
                    <th>首字母</th>
                    <th>区域代码</th>
                    <th>经度</th>
                    <th>纬度</th>
                    <th>排序</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$item->id}}" /></td>
                    <td><input title="" type="text" class="form-control w200" name="items[{{$item->id}}][name]" value="{{$item['name']}}"></td>
                    <td><input title="" type="text" class="form-control w200" name="items[{{$item->id}}][pinyin]" value="{{$item['pinyin']}}"></td>
                    <td><input title="" type="text" class="form-control" name="items[{{$item->id}}][letter]" value="{{$item['letter']}}" style="width: 40px;"></td>
                    <td><input title="" type="text" class="form-control" name="items[{{$item->id}}][zone_code]" value="{{$item['zone_code']}}" style="width: 100px;"></td>
                    <td><input title="" type="text" class="form-control" name="items[{{$item->id}}][lng]" value="{{$item['lng']}}" style="width: 100px;"></td>
                    <td><input title="" type="text" class="form-control" name="items[{{$item->id}}][lat]" value="{{$item['lat']}}" style="width: 100px;"></td>
                    <td><input title="" type="text" class="form-control" name="items[{{$item->id}}][displayorder]" value="{{$item['displayorder']}}" style="width: 60px;"></td>
                </tr>
                @endforeach
                </tbody>
                <tbody id="newDistrict"></tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <label><input type="checkbox" data-action="checkall" /> 全选</label>
                        <a href="javascript:;" id="addnew"><i class="iconfont icon-roundadd"></i>添加区域</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="btn-group-sm">
                        <input type="submit" class="btn btn-primary" value="提交" />
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh" />
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>

    <script type="text/template" id="tplDistrict">
        <tr>
            <td></td>
            <td><input title="" type="text" class="form-control w200" name="items[#keynum#][name]" value=""></td>
            <td><input title="" type="text" class="form-control w200" name="items[#keynum#][pinyin]" value=""></td>
            <td><input title="" type="text" class="form-control" name="items[#keynum#][letter]" value="" style="width: 40px;"></td>
            <td><input title="" type="text" class="form-control" name="items[#keynum#][zone_code]" value="" style="width: 100px;"></td>
            <td><input title="" type="text" class="form-control" name="items[#keynum#][lng]" value="" style="width: 100px;"></td>
            <td><input title="" type="text" class="form-control" name="items[#keynum#][lat]" value="" style="width: 100px;"></td>
            <td><input title="" type="text" class="form-control" name="items[#keynum#][displayorder]" value="" style="width: 60px;"></td>
        </tr>
    </script>
    <script type="text/javascript">
        var keynum = 0;
        $("#addnew").click(function(){
            var html = $("#tplDistrict").html().replace(/#keynum#/g,keynum);
            $("#newDistrict").append(html);
            keynum--;
        });
        $(function () {
            $("#province").on('change', function () {
                $("#J_province").val($(this).val());
                $("#J_city").val(0);
                $("#J_district").val(0);
                $("#searchForm").submit();
            });
            $("#city").on('change', function () {
                $("#J_city").val($(this).val());
                $("#J_district").val(0);
                $("#searchForm").submit();
            });
            $("#district").on('change', function () {
                $("#J_district").val($(this).val());
                $("#searchForm").submit();
            });
        });
    </script>
@stop

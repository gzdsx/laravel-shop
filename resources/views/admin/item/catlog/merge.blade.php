@extends('layouts.admin')

@section('title', '合并分类')

@section('content')
    <div class="console-title">
        <h2>商品管理 > 合并分类</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-formtable">
                <tbody>
                <tr>
                    <th width="300">源分类</th>
                    <td width="50"></td>
                    <th>目标分类</th>
                </tr>
                <tr>
                    <td>
                        <select name="source[]" size="10" class="form-control w300" multiple="multiple" title="" style="height:300px;">
                            @foreach ($catlogs as $catlog)
                                <option value="{{$catlog->catid}}">{{$catlog->name}}</option>
                                @foreach ($catlog->childs as $child)
                                    <option value="{{$child->catid}}">|--{{$child->name}}</option>
                                    @foreach ($child->childs as $sub)
                                        <option value="{{$sub->catid}}">|--|--{{$sub->name}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td class="align-center" style="vertical-align: middle;">>></td>
                    <td>
                        <select id="target" name="target" size="10" class="form-control w300" title="" style="width:300px; height:300px;">
                            @foreach ($catlogs as $catlog)
                                <option value="{{$catlog->catid}}">{{$catlog->name}}</option>
                                @foreach ($catlog->childs as $child)
                                    <option value="{{$child->catid}}">|--{{$child->name}}</option>
                                    @foreach ($child->childs as $sub)
                                        <option value="{{$sub->catid}}">|--|--{{$sub->name}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <input type="submit" class="btn btn-primary" value="确认合并" id="submitButton" disabled="disabled">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(document).on('click', function () {
            if ($("#target").val()) {
                $("#submitButton").enable();
            }else {
                $("#submitButton").disable();
            }
        });
    </script>
@stop

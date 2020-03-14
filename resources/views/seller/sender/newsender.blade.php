@extends('layouts.seller')

@section('title', '发货信息')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('seller/sender')}}">
                <span class="btn btn-danger">返回列表</span>
            </a>
        </div>
        <h2>编辑发货信息</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table class="dsxui-formtable" cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                <tr>
                    <td width="90">发货人姓名</td>
                    <td><input type="text" name="sender[name]" value="{{$sender['name']}}" class="form-control w300" required></td>
                </tr>
                <tr>
                    <td>联系电话</td>
                    <td><input type="text" name="sender[phone]" value="{{$sender['phone']}}" class="form-control w300" required></td>
                </tr>
                <tr>
                    <td>所在地区</td>
                    <td>
                        <label>
                            <select title="" class="form-control custom-select width-auto" id="province" name="sender[province]" required>
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control custom-select width-auto" id="city" name="sender[city]" required>
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control custom-select width-auto" id="district" name="sender[district]" required>
                                <option value="">请选择</option>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>街道地址</td>
                    <td><input type="text" name="sender[street]" value="{{$sender['street']}}" class="form-control w300" required></td>
                </tr>
                <tr>
                    <td>设为默认</td>
                    <td><input type="checkbox" value="1" name="sender[isdefault]"{{$sender['isdefault'] ? ' checked' : ''}}></td>
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

@section('foot')
    <script type="text/javascript">
        (function () {
            new DistrictSelector({
                province:'{{$sender['province']}}',
                city:'{{$sender['city']}}',
                district:'{{$sender['district']}}'
            });
        })();
        var app = new Vue({
            el:'#app',
            data:{

            },
            methods:{
                submit:function () {
                    alert('save');
                }
            }
        });
    </script>
@stop

@extends('layouts.seller')

@section('title', '个人资料')

@section('content')
    <div class="console-title">
        <h2>个人资料</h2>
    </div>
    <div class="content-div">
        <div class="alert alert-info">您的资料已通过审核, 你可以<a href="{{seller_url('profile/edit')}}">点击此处重新修改认证信息</a></div>
        <table class="dsxui-formtable" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td width="100">您的姓名:</td>
                <td>{{$auth->name}}</td>
            </tr>
            <tr>
                <td>身份证号:</td>
                <td>{{$auth->id_card_no}}</td>
            </tr>
            <tr>
                <td>身份证正面:</td>
                <td><img src="{{$auth->id_card_front}}" class="w100"></td>
            </tr>
            <tr>
                <td>身份证背面:</td>
                <td><img src="{{$auth->id_card_back}}" class="w100"></td>
            </tr>
            <tr>
                <td>提交时间:</td>
                <td>{{$auth->created_at}}</td>
            </tr>
            <tr>
                <td>认证时间:</td>
                <td>{{$auth->updated_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop

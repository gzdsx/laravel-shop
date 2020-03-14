@extends('layouts.h5')

@section('title', '我的团队')

@section('scripts')
    <script src="{{asset('js/moment.min.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="app" id="app">
        <div class="team-header">
            <h1 class="h1">邀请好友</h1>
            <h1 class="h1">获取能量</h1>
            <div class="blank"></div>
            <div class="tips">
                <span class="btn-tips">每直接邀请1名好友注册并登录，可增加5能量</span>
            </div>
            <div class="tips">
                <span class="btn-tips">每间接邀请1名好友注册并登录，可增加2能量</span>
            </div>
        </div>

        <div class="team-body">
            <div class="btn-invite" data-link="{{url('h5/invite')}}">立即邀请</div>
            <div class="h5-tabs margin-top-10">
                <div class="tab-item">
                    <span class="tab-link" :class="{'active' : level==1}" v-on:click="onClickTab(1)">一级团队（{{ $count1 }}）</span>
                </div>
                <div class="tab-item">
                    <span class="tab-link" :class="{'active' : level==2}" v-on:click="onClickTab(2)">二级团队（{{ $count2 }}）</span>
                </div>
            </div>
            <ul class="records" >
                <li v-for="user in users">
                    <div class="flex">@{{ user.username }}</div>
                    <div>
                        @{{ moment.unix(user.created_at).format('YYYY-MM-DD HH:mm:ss') }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var offset = 0;

        var app = new Vue({
            el:'#app',
            data:{
                users:[],
                level:1
            },
            mounted:function () {
                this.loadUsers();
            },
            methods:{
                loadUsers:function(){
                    var $this = this;
                    $.ajax({
                        url:'/h5/team/getusers',
                        data:{offset:offset, count:10, level: $this.level},
                        success:function (response) {
                            $this.users = response.users;
                        }
                    });
                },
                onClickTab:function (level) {
                    this.level = level;
                    this.loadUsers();
                }
            }
        })
    </script>
@stop

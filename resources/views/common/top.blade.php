<div class="global-top">
    <div class="top-content">
        <div class="logo">
            <img src="{{settings('logo')}}" alt="">
        </div>
        <ul class="nav">
            <li><a href="{{url('shop')}}" class="{{$navName=='shop' ? 'active' : ''}}">店铺</a></li>
            <li><a href="{{url('post')}}" class="{{$navName=='post' ? 'active' : ''}}">资讯</a></li>
            <li><a href="{{url('live')}}" class="{{$navName=='live' ? 'active' : ''}}">直播</a></li>
            <li><a href="{{url('video')}}" class="{{$navName=='video' ? 'active' : ''}}">视频</a></li>
            <li><a href="{{url('user')}}" class="{{$navName=='user' ? 'active' : ''}}">我的</a></li>
        </ul>
        @if (auth()->check())
            <div class="top-right">
                <a href="{{url('user')}}" class="flex-row">
                    <i><img src="{{auth()->user()->avatar}}" class="avatar" alt=""></i>
                    <i>{{auth()->user()->username}}</i>
                </a>
                <span><a href="{{url('logout')}}">退出登录</a></span>
            </div>
        @else
            <div class="top-right">
                <span><a href="{{url('register')}}">注册</a></span>
                <span><a href="{{url('login')}}">登录</a></span>
            </div>
        @endif
    </div>
</div>

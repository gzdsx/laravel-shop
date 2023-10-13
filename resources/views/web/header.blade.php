<header class="header">
    <div class="container header-container">
        <div class="logo">
            <img src="{{settings('logo')}}" alt="">
        </div>
        <ul class="nav">
            <li><a href="{{url('shop')}}" class="{{$navName=='shop' ? 'active' : ''}}">店铺</a></li>
            <li><a href="{{url('post')}}" class="{{$navName=='post' ? 'active' : ''}}">资讯</a></li>
            <li><a href="{{url('video')}}" class="{{$navName=='video' ? 'active' : ''}}">视频</a></li>
            <li><a href="{{url('live')}}" class="{{$navName=='live' ? 'active' : ''}}">直播</a></li>
            <li><a href="{{url('user')}}" class="{{$navName=='user' ? 'active' : ''}}">我的</a></li>
        </ul>

        @auth
            <ul class="user-auth">
                <li>
                    <a href="{{url('user')}}">
                        <img src="{{auth()->user()->avatar}}" class="avatar" alt="">
                        <span>{{auth()->user()->nickname}}</span>
                    </a>
                </li>
                <li><a href="{{url('logout')}}">退出登录</a></li>
            </ul>
        @endauth

        @guest
            <ul class="user-auth">
                <li><a href="{{url('register')}}">注册</a></li>
                <li><a href="{{url('login')}}">登录</a></li>
            </ul>
        @endguest
    </div>
</header>
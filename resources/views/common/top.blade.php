<div class="top">
    <div class="area">
        <div class="float-right">
            <ul class="list-unstyled">
                <li><a href="{{url('/')}}">商城首页</a></li>
                <li class="pipe">|</li>
                <li><a href="{{url('/user')}}">个人中心</a></li>
                <li class="pipe">|</li>
                <li><a href="{{url('/seller')}}">我是卖家</a></li>
                <li>
                    <a href="{{url('/cart')}}">
                        <span class="iconfont icon-cartfill"></span>
                        <span>购物车</span>
                    </a>
                </li>
                <li class="pipe">|</li>
                <li><a href="{{url('user/collect')}}"><span class="iconfont icon-favorfill"></span> <span>收藏夹</span></a></li>
                <li class="pipe">|</li>
                <li><a href="{{page_url(42)}}">联系客服</a></li>
            </ul>
        </div>
        @if(Auth::check())
            <span>Hi <a href="{{url('user')}}" style="color: #f40;">{{Auth::user()->username}}</a>, 欢迎回来</span>
            <a href="{{url('logout')}}">[退出登录]</a>
        @else
            <span>Hi 欢迎回来</span>
            <a href="{{url('login')}}">[登录]</a>
            <a href="{{url('register')}}">[免费注册]</a>
        @endif
    </div>
</div>

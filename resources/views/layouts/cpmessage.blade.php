<style type="text/css">
    .cpmessage{
        display: block;
        margin: 0 auto;
        padding-top: 100px;
        min-height: 550px;
    }
    .cpmessage .cp-icon{
        display: block;
        margin-bottom: 10px;
        text-align: center;
    }
    .cpmessage .cp-icon img{
        width: 80px;
        display: inline-block;
    }
    .cpmessage .message{
        text-align: center;
        color: #3E753F;
        font-size: 18px;
        line-height: 3.6;
    }
    .cpmessage .tips{
        display: block;
        text-align: center;
    }
    .cpmessage .links{
        display: block;
        text-align: center;
        line-height: 3;
    }
    .cpmessage .links a{
        margin: 0 5px;
    }
</style>
<div class="cpmessage">
    @if ($type=='success')
        <div class="cp-icon">
            <img src="{{asset('images/common/success.png')}}">
        </div>
    @endif
    @if ($type=='infomation')
        <div class="cp-icon">
            <img src="{{asset('images/common/info.png')}}">
        </div>
    @endif
    @if ($type=='error')
        <div class="cp-icon">
            <img src="{{asset('images/common/failed.png')}}">
        </div>
    @endif
    @if ($type=='warning')
        <div class="cp-icon">
            <img src="{{asset('images/common/warning.png')}}">
        </div>
    @endif

    <h3 class="message">{!! $message !!}</h3>
    <div class="tips">{!! $tips !!}</div>
    <div class="links">
        @if($links)
            @foreach($links as $link)
                <a href="{{$link[1]}}"@if(isset($link[2])) target="{{$link[2]}}"@endif>{{$link[0]}}</a>
            @endforeach
        @else
            <a href="{{$redirectTo}}">{{trans('sysmessage.go_back')}}</a>
        @endif
    </div>
</div>
@if($autoredirect)
    <script type="text/javascript">
        (function () {
            var second = 5;
            var timeid = setInterval(function(){
                second--;
                if(second<1){
                    clearTimeout(timeid);
                    window.location = '{{$redirectTo ?? ''}}';
                }else {
                    $("#timer").text(second);
                }
            },1000);
        })();
    </script>
@endif

@extends('layouts.h5')

@section('title', 'snapy')

@section('content')
    <div class="weui-gallery">

    </div>
    <script type="text/javascript">
        $(document).on('click', function () {
            weui.gallery(['{{asset('images/ad/loginbg.jpg')}}','{{asset('images/ad/loginbg.jpg')}}']);
        })
    </script>
@stop

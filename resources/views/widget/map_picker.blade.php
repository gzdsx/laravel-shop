<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>地图定位</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/widget/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<div style="border-bottom: 1px #e8e8e8 solid; padding-bottom: 10px; font-size: 12px;">
    <div style="float: right;">
        经度:<span id="lng"></span>, 纬度:<span id="lat"></span>
    </div>
    <span>拖动地图中"蓝色"图标到你所在的位置</span>
</div>
<div class="map" id="map" style="height: 460px; width: 100%;"></div>
<script src="https://webapi.amap.com/maps?v=1.4.0&key={{setting('amap_client_key')}}&callback=initMap"></script>
<script src="{{asset('js/dsxmap.js')}}" type="text/javascript"></script>
<script>
    var mapObj,marker;
    var address = '{{$address}}';
    var defaultPos = @json($location);
    function initMap() {
        mapObj = new DSXMap('map', {zoom:13});
        marker = mapObj.createMarker({draggable:true});
        mapObj.addMarker(marker);
        AMap.event.addListener(marker,'mousemove',function (e) {
            var position = e.target.getPosition();
            setLocation(position);
        });
        AMap.event.addListener(marker,'dragend',function (e) {
            var position = e.target.getPosition();
            setLocation(position);
        });
        mapObj.map.on('click', function (e) {
            setLocation(e.lnglat);
        });

        if (defaultPos[0] != 0) {
            var position = new AMap.LngLat(defaultPos[0], defaultPos[1]);
            mapObj.map.setCenter(position);
            setLocation(position);
        } else if (address) {
            mapObj.geocoder(address, function (data) {
                mapObj.map.setCenter(data[0].location);
                setLocation(data[0].location);
            }, function (status, result) {
                //alert(JSON.stringify(result));
            });
        } else {
            mapObj.setCurrentLocation(function (data) {
                mapObj.map.setCenter(data.position);
                setLocation(data.position);
            }, function (err) {
                //alert(JSON.stringify(err));
            });
        }
    }
    function setLocation(position) {
        var lat = position.getLat();
        var lng = position.getLng();
        $("#lat").text(lat);
        $("#lng").text(lng);
        marker.setPosition([lng, lat]);
        if (window.parent.onLocationDidChanged){
            window.parent.onLocationDidChanged({lat:lat, lng:lng});
        }
    }
</script>
</body>
</html>

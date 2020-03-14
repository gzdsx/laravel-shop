/**
 * Created by songdewei on 2017/5/18.
 */
function DSXMap(id, options) {
    var opts = $.extend({}, options);
    var self = this;
    this.map = new AMap.Map(id, options);
    this.addMapType = function (maptype, showRoad) {
        if (!maptype) maptype = 1;
        if (!showRoad) showRoad = true;
        self.map.plugin(["AMap.MapType"],function(){
            //地图类型切换
            var type= new AMap.MapType({
                defaultType: maptype, //使用2D地图
                showRoad: showRoad
            });
            self.map.addControl(type);
            self.map.addControl(new AMap.ToolBar());
        });
    };
    this.addToolBar = function () {
        self.map.plugin(["AMap.ToolBar"],function(){
            self.map.addControl(new AMap.ToolBar());
        });
    };
    this.setCurrentLocation = function (complete, error) {
        var geolocation;
        self.map.plugin('AMap.Geolocation', function() {
            geolocation = new AMap.Geolocation({
                enableHighAccuracy: true,//是否使用高精度定位，默认:true
                timeout: 10000,          //超过10秒后停止定位，默认：无穷大
                maximumAge: 0,           //定位结果缓存0毫秒，默认：0
                convert: true,           //自动偏移坐标，偏移后的坐标为高德坐标，默认：true
                showButton: true,        //显示定位按钮，默认：true
                buttonPosition: 'LB',    //定位按钮停靠位置，默认：'LB'，左下角
                buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
                showMarker: true,        //定位成功后在定位到的位置显示点标记，默认：true
                showCircle: true,        //定位成功后用圆圈表示定位精度范围，默认：true
                panToLocation: true,     //定位成功后将定位到的位置作为地图中心点，默认：true
                zoomToAccuracy:true      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
            });
            //map.addControl(geolocation);
            geolocation.getCurrentPosition();
            AMap.event.addListener(geolocation, 'complete', complete);
            // AMap.event.addListener(geolocation, 'complete', function(data){
            //     var lng = data.position.getLng();
            //     var lat = data.position.getLat();
            //     //alert('lng:'+lng+',lat:'+lat);
            //     window.point = [lng,lat];
            //     setMarker(window.point);
            //     map.setCenter(window.point);
            // });//返回定位信息
            AMap.event.addListener(geolocation, 'error', error);
            // AMap.event.addListener(geolocation, 'error', function(err){
            //     alert(err);
            // });
            //返回定位出错信息
        });
    };
    this.searchDistrict = function (address, complete, error) {
        AMap.plugin('AMap.DistrictSearch',function(){
            var district = new AMap.DistrictSearch({
                //高德行政区划查询插件实例
                subdistrict: 2
                //返回下一级行政区
            });
            //district.setLevel('city');
            district.search(address, function(status, result) {
                if(status=='complete' && result.districtList.length){
                    //注意，api返回的格式不统一，在下面用三个条件分别处理
                    var districtData = result.districtList[0];
                    //alert(districtData.center.getLng());
                    self.map.setCenter(districtData.center);
                    if (complete) complete(districtData);
                }else {
                    if (error) error(status, result);
                }
            });
        });
    };

    this.getLocation = function (address, complete, error) {
        var geocoder;
        self.map.plugin('AMap.Geocoder', function() {
            geocoder = new AMap.Geocoder({
                city: "all", //城市，默认：“全国”
                radius: 1000 //范围，默认：500
            });
            //地理编码,返回地理编码结果
            geocoder.getLocation(address, function(status, result) {
                if (status === 'complete' && result.info === 'OK') {
                    if (complete) complete(result.geocodes);
                }else {
                    //alert(status+':'+result);
                    if (error) error(status, result);
                }
            });
        });
    };

    this.getAddress = function (lnglat, complete, error) {
        AMap.plugin('AMap.Geocoder', function() {
            var geocoder = new AMap.Geocoder({
                // city 指定进行编码查询的城市，支持传入城市名、adcode 和 citycode
                city: 'all'
            });

            geocoder.getAddress(lnglat, function(status, result) {
                if (status === 'complete' && result.info === 'OK') {
                    // result为对应的地理位置详细信息
                    if (complete) complete(result.regeocode);
                } else {
                    if (error) error(status, result);
                }
            });
        });
    };

    this.createMarker = function (options) {
        return new AMap.Marker(options);
    };

    //添加标记
    this.addMarker = function (marker) {
        marker.setMap(self.map);
    };
    return this;
}

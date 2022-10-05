<template>
    <div class="map-view background-white">
        <div class="map-header">拖动地图选择位置</div>
        <div class="map-container">
            <div class="map" id="map"></div>
            <div class="marker"></div>
        </div>
        <div class="position-detail">
            <div class="left">
                <div class="coord">经度:{{position.longitude}},纬度:{{position.latitude}}</div>
                <div class="address">{{address}}</div>
            </div>
            <div class="flex-column justify-content-center">
                <van-button type="info" @click="onConfirm">确定</van-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MapView",
        data() {
            return {
                map: null,
                address: '',
                position: {
                    latitude: 0,
                    longitude: 0
                },
                center: {
                    latitude: 39.984120,
                    longitude: 116.307484
                }
            }
        },
        props: {
            location: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        watch: {
            location(val) {
                this.center = {
                    ...this.center,
                    ...val
                }
                this.initMap();
            }
        },
        methods: {
            initMap() {
                //定义地图中心点坐标
                let {latitude, longitude} = this.center;
                let center = new TMap.LatLng(latitude, longitude);
                //定义map变量，调用 TMap.Map() 构造函数创建地图
                let map = new TMap.Map(document.getElementById('map'), {
                    center: center,//设置地图中心点坐标
                    zoom: 17.2,   //设置地图缩放级别
                    pitch: 43.5,  //设置俯仰角
                    rotation: 45    //设置地图旋转角度
                });

                map.on('dragend', (e) => {
                    let coord = map.getCenter();
                    this.geoLocation({
                        latitude: coord.lat,
                        longitude: coord.lng
                    });
                });

                this.map = map;
            },
            onConfirm() {
                this.$emit('confirm', this.position);
            },
            getLocation() {
                let {map} = this;
                let ua = navigator.userAgent.toLowerCase();
                if (ua.indexOf('micromessenger') !== -1) {
                    wx.getLocation({
                        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                        success: (res) => {
                            let {latitude, longitude} = res;
                            map.setCenter(new TMap.LatLng(latitude, longitude));
                            this.geoLocation(res);
                        }
                    });
                } else {
                    let geolocation = new qq.maps.Geolocation();
                    geolocation.getLocation((result) => {
                        let {adcode, nation, province, city, district, addr, lat, lng} = result;
                        this.coord = {lat, lng};
                        this.address = addr;
                        this.position = {
                            adcode,
                            nation,
                            province,
                            city,
                            district,
                            street: addr,
                            street_number: addr,
                            longitude: lng,
                            latitude: lat
                        }
                        this.map.setCenter(new TMap.LatLng(lat, lng));
                    }, e => {
                        console.log('定位失败');
                    });
                }

                // if (navigator.geolocation) {
                //     navigator.geolocation.getCurrentPosition((position) => {
                //         map.setCenter(position.coords)
                //     }, positionError => {
                //         console.log(positionError);
                //     });
                // } else {
                //     console.log('浏览器不支持获取位置信息');
                // }
            },
            geoLocation(coord) {
                let {latitude, longitude} = coord;
                this.$get('/map/tmap.geocoder?location=' + latitude + ',' + longitude).then(response => {
                    let {adcode,} = response.result.ad_info;
                    let {nation, province, city, district, street, street_number} = response.result.address_component;
                    this.address = province + '' + city + '' + district + '' + street;
                    this.position = {
                        adcode,
                        nation,
                        province,
                        city,
                        district,
                        street,
                        street_number,
                        longitude,
                        latitude
                    }
                }).catch(reason => {
                    this.$notify({type: 'danger', message: reason.errMsg});
                });
            }
        },
        mounted() {
            this.initMap();
            this.getLocation();
        },
    }
</script>

<style scoped>

</style>

<template>
    <div>
        <div class="map-header">
            <el-input v-model="address" placeholder="输入地址搜索">
                <el-button slot="append" icon="el-icon-search" @click="onSearch"></el-button>
            </el-input>
        </div>
        <div class="map-contaner">
            <div id="tmap"></div>
            <span class="iconfont icon-location-fill marker"></span>
        </div>
        <div class="map-footer">
            <div class="flex-fill flex-column justify-content-center">
                <div>经度{{position.longitude}}, 纬度:{{position.latitude}}</div>
                <div>{{value}}</div>
            </div>
            <div>
                <el-button type="primary" size="small" @click="onConfirm">确定</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LocationMapView",
        props: {
            location: {
                type: Object,
                default: () => ({
                    latitude: 26.568278689590727,
                    longitude: 104.88300627668536
                })
            },
            zoom: {
                type: Number,
                default: 15
            }
        },
        data() {
            return {
                map: null,
                value: '请拖动地图选择',
                address: '',
                position: {
                    latitude: 0,
                    longitude: 0
                }
            }
        },
        methods: {
            initMap() {
                let id = document.getElementById('tmap');
                if (!id) return;
                //定义地图中心点坐标
                let {latitude, longitude} = this.location;
                let center = new TMap.LatLng(latitude, longitude);
                //定义map变量，调用 TMap.Map() 构造函数创建地图
                let map = new TMap.Map(id, {
                    center: center,//设置地图中心点坐标
                    zoom: this.zoom,   //设置地图缩放级别
                    pitch: 43.5,  //设置俯仰角
                    rotation: 45    //设置地图旋转角度
                });

                map.on('dragend', () => {
                    let {lat, lng} = this.map.getCenter();
                    let location = lat + ',' + lng;
                    this.getLocation({location});
                });
                this.map = map;

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
            getLocation(params) {
                this.$get('/lbs/geocoder', params).then(response => {
                    let {address_component} = response.result;
                    let {adcode} = response.result.ad_info;
                    let {lat, lng} = response.result.location;
                    let {province, city, district, street_number} = address_component;
                    this.value = province + city + district + street_number;
                    this.position = {
                        ...address_component,
                        longitude: lng,
                        latitude: lat,
                        adcode
                    };
                });
            },
            onSearch() {
                let {address} = this;
                if (address) this.getLocation({address});
            },
            geoLocation() {
                let geolocation = new qq.maps.Geolocation();
                geolocation.getLocation((result) => {
                    let {lat, lng} = result;
                    let location = lat + ',' + lng;
                    this.getLocation({location});
                    this.map.setCenter(new TMap.LatLng(lat, lng));
                }, e => {
                    this.getLocation();
                    this.$showToast('定位失败:' + e.message + '(' + e.code + ')');
                    //this.$showToast('您拒绝了使用位置共享服务，请手动输入您的地址');
                });
            },
            onConfirm() {
                this.$emit('confirm', this.position);
            }
        },
        mounted() {
            this.initMap();
            this.geoLocation();
        },
    }
</script>

<style lang="scss" scoped>
    .map-header {
        display: flex;
        margin-bottom: 10px;
    }

    .map-footer {
        margin-top: 10px;
        display: flex;
        font-size: 12px;
    }

    .map-contaner {
        position: relative;

        .marker {
            position: absolute;
            z-index: 100;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -100%);
            font-size: 30px;
            color: #f00;
        }
    }

    #tmap {
        height: 450px;
        width: 100%;
        display: block;
        flex: 1;
    }
</style>

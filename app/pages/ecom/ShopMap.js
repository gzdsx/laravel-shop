import React from 'react';
import {Linking, Platform, SafeAreaView, Text, TouchableOpacity, View} from 'react-native';
import {MapView} from "react-native-gzdsx-amap";
import {Size} from "../../styles";
import {ApiClient, Toast} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {LoadingView} from "react-native-gzdsx-elements";

export default class ShopMap extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            shop: {},
            coordinate: {
                latitude: 0,
                longitude: 0
            },
            loading: true,
            active: false
        };
    }

    fetchData = () => {
        let shop_id = this.props.route.params?.shop_id;
        ApiClient.get('/ecom/shop.getInfo', {shop_id}).then(response => {
            let shop = response.result;
            let {latitude, longitude} = shop;
            this.setState({
                shop,
                coordinate: {latitude, longitude},
                loading: false
            });
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        })
    }

    componentDidMount(): void {
        this.setNavigation();
        this.fetchData();
    }

    render(): React.ReactNode {
        let {shop, coordinate, active, loading} = this.state;
        if (this.state.loading) return <LoadingView/>
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#fff'}}>
                <View style={{flex: 1}}>
                    <MapView
                        style={{flex: 1}}
                        center={coordinate}
                        zoomLevel={15}
                    >
                        <MapView.Marker
                            coordinate={coordinate}
                            title={shop.shop_name}
                            description={shop.formatted_address}
                            active={active}
                        />
                    </MapView>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        alignItems: 'center',
                        justifyContent: 'center',
                        backgroundColor: '#fff',
                        width: Size.screenWidth,
                        paddingVertical: 20
                    }}
                    onPress={() => {
                        if (Platform.OS === 'ios') {
                            let url = 'iosamap://navi?sourceApplication=红果经开区&backScheme=TrunkHelper&lat=' + latitude + '&lon=' + longitude + '&dev=0&style=2';
                            Linking.canOpenURL(url).then(supported => {
                                if (supported) {
                                    Linking.openURL(url);
                                } else {
                                    Toast.show('请先安装高德导航');
                                }
                            }).catch(reason => {
                                console.log(reason);
                            });
                        } else {
                            let url = 'androidamap://navi?sourceApplication=红果经开区&poiname=红果经济开发区管委会&lat=' + latitude + '&lon=' + longitude + '&dev=0&style=2';
                            //Linking.openURL(url);
                            Linking.canOpenURL(url).then(supported => {
                                if (supported) {
                                    Linking.openURL(url);
                                } else {
                                    Toast.show('请先安装高德导航');
                                }
                            });
                        }
                    }}
                >
                    <Text style={{color: '#00A7F7', fontSize: 18}}>导航去这里</Text>
                </TouchableOpacity>
            </SafeAreaView>
        )
    }

}

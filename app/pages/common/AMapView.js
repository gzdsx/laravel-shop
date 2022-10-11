import React from 'react';
import {View, Text, TouchableOpacity, Linking, Platform} from 'react-native';
import {MapView} from 'react-native-gzdsx-amap';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Size} from "../../styles";
import {Toast} from '../../utils';

export default class AMapView extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '地图导航'
    });

    render(): React.ReactNode {
        const coordinate = {
            latitude: 25.747957,
            longitude: 104.500054,
        };
        return (
            <View style={{flex: 1}}>
                <View style={{flex: 1}}>
                    <MapView
                        style={{flex: 1}}
                        coordinate={coordinate}
                        zoomLevel={13}
                    >
                        <MapView.Marker
                            coordinate={coordinate}
                            title={"红果经济开发区管委会"}
                            active={true}
                        />
                    </MapView>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        alignItems: 'center',
                        justifyContent: 'center',
                        padding: 15,
                        backgroundColor: '#fff',
                        width: Size.screenWidth
                    }}
                    onPress={() => {
                        if (Platform.OS === 'ios') {
                            let url = 'iosamap://navi?sourceApplication=红果经开区&backScheme=TrunkHelper&lat=' + coordinate.latitude + '&lon=' + coordinate.longitude + '&dev=0&style=2';
                            Linking.canOpenURL(url).then(supported => {
                                if (supported) {
                                    Linking.openURL(url);
                                } else {
                                    Toast.show('请先安装高德导航');
                                }
                            });
                        } else {
                            let url = 'androidamap://navi?sourceApplication=红果经开区&poiname=红果经济开发区管委会&lat=' + coordinate.latitude + '&lon=' + coordinate.longitude + '&dev=0&style=2';
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
                    <Text style={{color: '#00A7F7', fontSize: 16}}>导航去这里</Text>
                </TouchableOpacity>
            </View>
        )
    }
}

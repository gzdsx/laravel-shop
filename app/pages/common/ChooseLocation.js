import React from 'react';
import {DeviceEventEmitter, ScrollView, StatusBar, StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {MapView} from 'react-native-gzdsx-amap';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors, Size, StatusBarStyles} from "../../styles";
import {SearchBar, ListItem} from "react-native-elements";
import GeoLocation from '@react-native-community/geolocation';
import {ApiClient} from "../../utils";
import {LoadingView} from "react-native-gzdsx-elements";
import {SafeFooter} from "../../components/SafeView";
import Icon from "react-native-vector-icons/AntDesign";

export default class ChooseLocation extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: route.params?.title || '选择地址',
            headerRight: () => (
                <TouchableOpacity
                    activeOpacity={0.8}
                    onPress={this.onSelect}
                >
                    <Text style={{fontSize: 18, color: '#333'}}>完成</Text>
                </TouchableOpacity>
            )
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            keywords: '',
            center: {
                latitude: 0,
                longitude: 0
            },
            region: '',
            pois: [],
            loading: true,
            current: 0,
            province: null,
            city: null,
            district: null,
        };
    }

    fetchList = (location) => {
        ApiClient.get('/lbs/geocode.regeo', {location, extensions: 'all'}).then(response => {
            //console.log(response.result);
            let {pois, addressComponent} = response.result;
            let {province, city, district} = addressComponent;
            let region = [province, city, district].join('');
            this.setState({
                pois,
                region,
                province,
                city,
                district,
                loading: false
            });
        });
    }

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        GeoLocation.getCurrentPosition(({coords}) => {
            let {latitude, longitude} = coords;
            this.setState({
                center: {
                    latitude,
                    longitude
                }
            });
        }, error => {
            console.log(error);
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        let {navigation, route} = this.props;
        let {keywords, center} = this.state;
        return (
            <View style={{flex: 1}}>
                <SearchBar
                    placeholder={route.params?.placeholder || '请输入关键字'}
                    containerStyle={{
                        backgroundColor: '#fff',
                        borderTopWidth: 0,
                        borderBottomWidth: 0,
                        paddingHorizontal: 10
                    }}
                    inputContainerStyle={{
                        backgroundColor: '#f5f5f5'
                    }}
                    inputStyle={{
                        fontSize: 14,
                        minHeight: 30
                    }}
                    lightTheme={true}
                    returnKeyType={"search"}
                    round
                    value={keywords}
                    onChangeText={text => {
                        this.setState({keywords: text});
                    }}
                    onSubmitEditing={() => {
                        ApiClient.get('/lbs/geocode.geo', {address: keywords}).then(response => {
                            let {location} = response.result[0];
                            this.fetchList(location);
                        })
                    }}
                />
                <View style={styles.mapWrapper}>
                    <MapView
                        style={{flex: 1}}
                        center={center}
                        zoomLevel={13}
                        onStatusChangeComplete={status => {
                            let {longitude, latitude} = status.center;
                            this.fetchList([longitude, latitude].join(','));
                        }}
                    >
                    </MapView>
                    <Icon
                        name={'enviroment'}
                        size={30}
                        color={Colors.primary}
                        style={styles.iconLocation}
                    />
                </View>
                <ScrollView style={{flex: 1, backgroundColor: '#fff'}}>
                    {this.renderPois()}
                    <SafeFooter/>
                </ScrollView>
            </View>
        );
    }

    renderPois = () => {
        let {loading, pois, current, province, city, district} = this.state;
        if (loading) return <LoadingView/>
        return (
            <>
                {
                    pois.map((poi, index) => (
                        <ListItem style={styles.poiRow} key={index.toString()} onPress={() => {
                            current = index;
                            this.setState({current});
                        }}>
                            <ListItem.Content>
                                <ListItem.Title style={styles.poiName}>{poi.name}</ListItem.Title>
                                <ListItem.Subtitle style={styles.poiAddress}>
                                    {province}{city}{district}{poi.address}
                                </ListItem.Subtitle>
                            </ListItem.Content>
                            {
                                index === current ?
                                    <Icon name={'check'} size={20}/>
                                    : null
                            }
                        </ListItem>
                    ))
                }
            </>
        )
    }

    onSelect = () => {
        let {navigation, route} = this.props;
        let {pois, current, province, city, district} = this.state;
        let {name, address, location} = pois[current];
        let arr = location.split(',');
        DeviceEventEmitter.emit('onChooseLocation', {
            name,
            province,
            city,
            district,
            street: address,
            longitude: arr[0],
            latitude: arr[1]
        });
        navigation.goBack();
    }
}

const styles = StyleSheet.create({
    poiRow: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#e2e2e2',
    },
    poiName: {
        fontWeight: '400',
        fontSize: 15,
    },
    poiAddress: {
        color: '#939393',
        marginTop: 6,
        fontSize: 12,
    },
    mapWrapper: {
        height: Size.screenWidth * 0.8,
        position: 'relative'
    },
    iconLocation: {
        position: 'absolute',
        left: '50%',
        top: '50%',
        zIndex: 100,
        transform: [
            {
                translate: [-15, -30]
            },
        ]
    }
})

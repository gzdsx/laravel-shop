import React from 'react';
import {View, ScrollView, TouchableOpacity, Image, Text, FlatList, RefreshControl, StyleSheet} from 'react-native';
import {connect} from "react-redux";
import Swiper from 'react-native-swiper';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {LoadingView, Ticon} from "react-native-gzdsx-elements";
import NetInfo, {useNetInfo} from "@react-native-community/netinfo";
import {Header} from 'react-native-elements';
import {Colors, Size} from '../../styles';
import {ApiClient} from "../../utils";
import Menus from '../../base/menus';
import {BaseApi} from "../../base/constants";
import {SearchBar} from "../../components";
import ItemGridView from "../shop/components/ItemGridView";

class HomeIndex extends React.Component {

    static navigationOptions = () => {
        //const {navigation, route} = this.props;
        return {
            header: ({navigation, route}) => (
                <Header
                    backgroundColor={Colors.primary}
                    centerComponent={() => (
                        <SearchBar
                            placeholderTextColor={"#666"}
                            placeholder={"猕猴桃,果酒,羊肉粉"}
                            containerStyle={{
                                flex: 1,
                                padding: 0,
                                borderRadius: 10,
                                borderTopWidth: 0,
                                borderBottomWidth: 0,
                                paddingBottom: 0
                            }}
                            inputContainerStyle={{
                                backgroundColor: '#fefefe',
                                height: 34,
                            }}

                            inputStyle={{
                                fontSize: 12,
                            }}
                            round={true}
                            lightTheme={true}
                            onSearch={(q) => {
                                navigation.navigate('ItemList', {q});
                            }}
                        />
                    )}
                    centerContainerStyle={{flexDirection: "row", paddingHorizontal: 10}}
                    leftComponent={() => (
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => {
                                navigation.navigate('QRScanner');
                            }}
                        >
                            <Ticon name={'scan-light'} color={"#fff"}/>
                        </TouchableOpacity>
                    )}
                    leftContainerStyle={{flex: 0}}
                    rightComponent={() => (
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => {
                                navigation.navigate('Category');
                            }}
                        >
                            <Ticon name={'more-light'} color={"#fff"}/>
                        </TouchableOpacity>
                    )}
                    rightContainerStyle={{flex: 0}}
                    containerStyle={{
                        borderBottomColor: Colors.primary,
                        borderBottomWidth: 0,
                    }}
                >
                </Header>
            )
        }
    }

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            images: [],
            posts: [],
            items: []
        };
    }

    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <ItemGridView
                data={this.state.items}
                onPressItem={(item) => {
                    this.props.navigation.navigate('ItemDetail', {itemid: item.itemid});
                }}
                ListHeaderComponent={this.renderHeaderView()}
                onRefresh={this.refresh}
                isRefreshing={this.state.isRefreshing}
            />
        );
    }

    componentDidMount(): void {
        //console.log(this.props);
        NetInfo.configure({
            reachabilityUrl: BaseApi + '/reachable',
            reachabilityTest: async (response) => response.status === 200,
            reachabilityLongTimeout: 60 * 1000, // 60s
            reachabilityShortTimeout: 5 * 1000, // 5s
        });
        NetInfo.addEventListener(state => {
            console.log(state);
            if (state.isConnected) {
                this.fetchData();
            }
        });
    }

    fetchData = async () => {
        let response = await ApiClient.get('/block/item/batchget', {block_id: 1});
        const images = response.data.items;

        response = await ApiClient.get('/post/batchget', {catid: 2, count: 6});
        const posts = response.data.items;

        response = await ApiClient.get('/item/batchget', {count: 20});
        const items = response.data.items;

        this.setState({
            isLoading: false,
            isRefreshing: false,
            images,
            posts,
            items
        });
    };

    refresh = () => {
        this.setState({isRefreshing: true}, () => this.fetchData());
    };

    renderHeaderView() {
        return (
            <View>
                {this.renderSwiper()}
                {this.renderMenus()}
            </View>
        )
    }

    renderSwiper = () => {
        const size = {
            width: Size.screenWidth,
            height: Size.screenWidth * 0.5
        };
        let contents = this.state.images.map((item, index) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    key={'key1' + index.toString()}
                    onPress={() => {
                        if (/http(.*?)\/post\/detail\/(\d+)\.html/.test(item.url)) {
                            let aid = item.url.match(/(\d+)/g)[0];
                            this.props.navigation.navigate('PostDetail', {aid});
                        }
                    }}
                >
                    <CacheImage
                        source={{uri: item.image}}
                        style={{...size}}
                    />
                </TouchableOpacity>
            );
        });

        return (<Swiper style={{height: size.height}} dotColor={"#ccc"} autoplay>{contents}</Swiper>);
    };

    renderMenus = () => {
        let contents = Menus.map((menu, index) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        alignContent: 'center',
                        alignItems: 'center',
                        width: Size.screenWidth * 0.25,
                        marginTop: 8,
                        marginBottom: 8
                    }}
                    onPress={() => {
                        this.props.navigation.navigate(menu.url, menu.params);
                    }}
                    key={'key2' + index.toString()}
                >
                    <Image
                        source={menu.icon}
                        style={{
                            width: 50,
                            height: 50
                        }}
                    />
                    <Text style={{
                        fontSize: 14,
                        color: '#333',
                        textAlign: 'center',
                        marginTop: 5
                    }}>{menu.title}</Text>
                </TouchableOpacity>
            );
        });

        return (
            <View style={{
                paddingTop: 10,
                paddingBottom: 10,
                flexDirection: 'row',
                flexWrap: 'wrap',
                backgroundColor: '#fff'
            }}>{contents}</View>
        );
    };

    renderImage = (image) => {
        if (image) {
            return (
                <CacheImage
                    source={{uri: image}}
                    style={{
                        width: 120,
                        height: 90,
                        borderRadius: 3,
                        resizeMode: 'cover',
                        marginLeft: 10
                    }}
                />
            );
        }
        return null;
    }
}

const mapStateToProps = (store) => {
    return {...store};
};

export default connect(mapStateToProps)(HomeIndex);

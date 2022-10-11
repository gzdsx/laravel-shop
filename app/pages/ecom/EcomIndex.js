import React from 'react';
import {View, TouchableOpacity, Image, Text, StyleSheet, SafeAreaView, FlatList} from 'react-native';
import {connect} from "react-redux";
import Swiper from 'react-native-swiper';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {Ticon} from "react-native-gzdsx-elements";
import NetInfo from "@react-native-community/netinfo";
import {Header} from 'react-native-elements';
import {Colors, Size, StatusBarStyles} from '../../styles';
import {ApiClient} from "../../utils";
import Menus from '../../base/menus';
import {SearchBar} from "../../components";
import ProductGridView from "../shop/components/ProductGridView";
import FastImage from "react-native-fast-image";
import ProductListItem from "./components/ProductListItem";

class EcomIndex extends React.Component {
    setNavigation() {
        let {navigation, route} = this.props;
        navigation.setOptions({
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
                                navigation.navigate('ProductList', {q});
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
                                navigation.navigate('ProductIndex');
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
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            refreshing: false,
            images: [],
            posts: [],
            items: []
        };
    }

    componentDidMount(): void {
        this.setNavigation();
        NetInfo.addEventListener(state => {
            //console.log(state);
            if (state.isConnected) {
                this.fetchData();
            }
        });
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToLightStyle();
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    fetchData = async () => {
        let response = await ApiClient.get('/block/item.getList', {block_id: 1});
        const images = response.result.items;

        response = await ApiClient.get('/ecom/product.getList', {cate_id: 2, count: 6});
        const posts = response.result.items;

        response = await ApiClient.get('/ecom/product.getList', {count: 20});
        const items = response.result.items;

        this.setState({
            images,
            posts,
            items,
            loading: false,
            refreshing: false,
        });
    };

    render(): React.ReactNode {
        let {items} = this.state;
        return (
            <SafeAreaView style={{flex: 1}}>
                <FlatList
                    data={items}
                    renderItem={({item, index}) => (
                        <ProductListItem product={item}/>
                    )}
                    keyExtractor={((item, index) => index.toString())}
                    ListHeaderComponent={this.renderHeaderView()}
                    numColumns={2}
                    columnWrapperStyle={{
                        padding: 5
                    }}
                />
            </SafeAreaView>
        );
    }

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
                    <FastImage
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

const itemWidth = Size.screenWidth / 2;
const styles = StyleSheet.create({
    item: {
        padding: 3,
        width: itemWidth
    },
    itemContent: {
        backgroundColor: '#fff',
        borderRadius: 2
    },
    itemImage: {
        height: (Size.screenWidth - 12) / 2,
        width: (Size.screenWidth - 12) / 2
    },
    itemTitle: {
        fontSize: 14,
        color: '#000',
        height: 60,
        padding: 10,
        fontWeight: '400'
    },
    itemData: {
        flexDirection: 'row',
        paddingLeft: 10,
        paddingRight: 10,
        paddingBottom: 10
    },
    itemPrice: {
        flex: 1,
        color: '#f40',
        fontSize: 16,
        fontWeight: '600',
    },
});

const mapStateToProps = (store) => {
    return {...store};
};

export default connect(mapStateToProps)(EcomIndex);
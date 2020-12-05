import React from 'react';
import {ScrollView, View, Image, Text, TouchableOpacity, StyleSheet, DeviceEventEmitter} from 'react-native';
import {connect} from 'react-redux';
import Swiper from 'react-native-swiper';
import {LoadingView, Ticon, Toast} from "react-native-gzdsx-elements";
import HTML from 'react-native-render-html';
import {Image as ELImage} from 'react-native-elements';
import SkuPannel from "./components/SkuPannel";
import {AddToCart} from "../cart/CartActions";
import {Utils, ApiClient} from "../../utils";
import {ShareView} from '../../components';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Size, Styles} from '../../styles';
import GoodsActionBar from "./components/GoodsActionBar";
import {CartDidChangedNotification} from "../../base/constants";

const getContent = (content) => {
    return `<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />` +
        `<style type="text/css">*{max-width: 100%;}img{max-width: 100%; display: block;}</style></head>` +
        `<body>${content || ''}</body></html>`;
};

class ItemDetail extends React.Component {
    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '宝贝详情',
            headerLeft: () => (
                <View style={Styles.headerLeft}>
                    <Ticon name={"back-light"} color={"#fff"} size={28} onPress={() => {
                        if (route.params) {
                            if (typeof route.params.callback === 'function') {
                                route.params.callback();
                            }
                        }
                        navigation.goBack();
                    }}/>
                </View>
            ),
            headerRight: () => (
                <View style={Styles.headerRight}>
                    <Ticon
                        name={"share-squar-light"}
                        color={"#fff"}
                        size={28}
                        onPress={() => {
                            this.setState({showShare: true});
                        }}/>
                </View>
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            item: {},
            content: {},
            images: [],
            props: [],
            isLoading: true,
            showFooter: false,
            showModal: false,
            showShare: false,
            shareMessage: {},
            isOffSale: false
        };
        this.actionType = 1;
    }

    render() {
        if (this.state.isOffSale) return this.renderOffSale();
        const {auth} = this.props;
        const {item} = this.state;
        if (this.state.isLoading) return <LoadingView/>;
        let html = item.content.content || `<img src="${item.image}" style="width: 100%;"/>`;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    {this.renderSwiper()}
                    {this.renderItemData()}
                    <View style={{
                        paddingTop: 15,
                        paddingBottom: 15
                    }}>
                        <Text style={{
                            textAlign: 'center',
                            fontSize: 16,
                            color: '#666'
                        }}>宝贝详情</Text>
                    </View>
                    {this.renderProperties()}
                    <HTML
                        html={html}
                        imagesMaxWidth={Size.screenWidth}
                        imagesInitialDimensions={{...Size.screenSize}}
                        ignoredStyles={['font-family']}
                    />
                </ScrollView>
                <GoodsActionBar
                    onPressAddCart={() => {
                        if (auth.isSignined) {
                            this.actionType = 1;
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onPressBuyNow={() => {
                        if (auth.isSignined) {
                            this.actionType = 2;
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onAddCollection={() => {
                        if (auth.isSignined) {
                            Utils.addToCollection(item.itemid, 'item', () => {
                                Toast.show('已成功加入收藏夹');
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onConnectKefu={() => {
                        this.props.navigation.navigate('ShopInfo', {shop_id: item.shop_id});
                    }}
                />
                <SkuPannel
                    show={this.state.showModal}
                    data={item}
                    onSubmit={(sku, quantity) => {
                        const item = this.state.item;
                        if (this.actionType === 1) {
                            this.setState({showModal: false});
                            let sku_id = sku.sku_id || 0;
                            AddToCart(item.itemid, quantity, sku_id, () => {
                                this.refs.toast.show('已成功加入购物车');
                                DeviceEventEmitter.emit(CartDidChangedNotification);
                            });
                        } else {
                            this.setState({showModal: false});
                            this.props.navigation.navigate('BuyNow', {
                                item,
                                sku,
                                quantity
                            });
                        }
                    }}
                />
                <ShareView show={this.state.showShare} shareMessage={this.state.shareMessage}/>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        const {navigation, route} = this.props;
        ApiClient.get('/item/get', {itemid: route.params?.itemid}).then(response => {
            //console.log(response.data);
            const {item} = response.data;
            const {content, images, props} = item;
            this.setState({
                item,
                content,
                images,
                props,
                isLoading: false,
                showFooter: true,
                shareMessage: {
                    type: 'news',
                    title: item.title,
                    description: item.message,
                    thumbImage: item.thumb,
                    webpageUrl: item.url
                }
            });
        }).catch(reason => {
            this.setState({isOffSale: true});
        });
    }

    renderSwiper = () => {
        let items = this.state.images.map((image, index) => {
            return (
                <TouchableOpacity style={{flex: 1}} activeOpacity={1} key={index.toString()}>
                    <ELImage source={{uri: image.image}} containerStyle={{flex: 1}}/>
                </TouchableOpacity>
            );
        });

        return <Swiper style={{height: Size.screenWidth * 0.8}} activeDotColor={"#fff"} autoplay>{items}</Swiper>;
    };

    renderItemData = () => {
        const {item, shop} = this.state;
        return (
            <View style={{
                backgroundColor: '#fff',
                padding: 15
            }}>
                <View style={{marginBottom: 10}}>
                    <Text style={{
                        flex: 1,
                        fontSize: 16,
                        color: '#000',
                        lineHeight: 20,
                        fontWeight: '600',
                    }}>{item.title}</Text>
                </View>
                <View style={{flexDirection: 'row'}}>
                    <Text style={{color: '#f40', fontSize: 14, paddingTop: 4}}>￥</Text>
                    <Text style={{
                        fontSize: 18,
                        fontWeight: 'bold',
                        color: '#f40',
                        marginRight: 20
                    }}>{item.price}</Text>
                    <Text style={{
                        fontSize: 14,
                        color: '#777',
                        paddingTop: 4
                    }}>原价:{item.original_price}</Text>
                </View>
                <View style={{
                    flexDirection: 'row',
                    marginTop: 20
                }}>
                    <Text style={{
                        flex: 1,
                        fontSize: 12,
                        color: '#777'
                    }}>配送费:{item.shipping_fee > 0 ? item.shipping_fee : '免费'}</Text>
                    <View style={{flex: 1}}/>
                    <Text style={{
                        fontSize: 12,
                        color: '#777',
                        textAlign: 'right'
                    }}>已售{item.sold}件</Text>
                </View>
            </View>
        );
    };

    renderShop = () => {
        const {shop} = this.state;
        return (
            <View style={{
                backgroundColor: '#fff',
                paddingTop: 20,
                paddingBottom: 20,
                paddingLeft: 10,
                paddingRight: 10
            }}>
                <View style={css.shopInfo}>
                    <Image source={{uri: shop.logo}} style={css.shopLogo}/>
                    <View style={{flex: 1, paddingTop: 5}}>
                        <Text style={css.shopName}>{shop.shop_name}</Text>
                        <Text style={css.shopLocation}>{shop.province} {shop.city}</Text>
                    </View>
                </View>
                <View style={css.shopData}>
                    <View style={[css.shopDataItem, {borderLeftWidth: 0}]}>
                        <Text style={css.shopDataText}>{shop.views}</Text>
                        <Text style={css.shopDataText}>访客数</Text>
                    </View>
                    <View style={css.shopDataItem}>
                        <Text style={css.shopDataText}>{shop.item_count}</Text>
                        <Text style={css.shopDataText}>商品数</Text>
                    </View>
                    <View style={css.shopDataItem}>
                        <Text style={css.shopDataText}>{shop.total_sold}</Text>
                        <Text style={css.shopDataText}>累计销量</Text>
                    </View>
                </View>
                <View style={{
                    marginTop: 15,
                    alignContent: 'center',
                    alignItems: 'center'
                }}>
                    <Text style={{
                        textAlign: 'center',
                        paddingLeft: 20,
                        paddingRight: 20,
                        paddingTop: 8,
                        paddingBottom: 8,
                        color: '#ff0000',
                        fontSize: 14,
                        borderWidth: 1,
                        borderColor: '#ff0000',
                        borderRadius: 10
                    }} onPress={() => this.props.navigation.navigate('ShopDetail', {shop_id: shop.shop_id})}>进店看看</Text>
                </View>
            </View>
        );
    };

    renderProperties = () => {
        const {props} = this.state;
        if (props.length > 0) {
            let contents = props.map(function (prop, index) {
                return (
                    <View
                        key={index.toString()}
                        style={{
                            paddingTop: 5,
                            paddingBottom: 5,
                            flexDirection: 'row',
                        }}
                    >
                        <Text style={{
                            fontSize: 14,
                            color: '#222',
                            marginRight: 5,
                            width: 80
                        }}>{prop.prop_name}</Text>
                        <Text style={{
                            flex: 1,
                            fontSize: 14,
                            color: '#777'
                        }}>{prop.prop_value}</Text>
                    </View>
                );
            });
            return (
                <View style={{
                    paddingTop: 5,
                    paddingBottom: 5,
                    paddingLeft: 10,
                    paddingRight: 10,
                    backgroundColor: '#fff'
                }}>
                    {contents}
                </View>
            )
        } else {
            return null;
        }
    };

    renderOffSale = () => {
        return (
            <View style={{flex: 1}}>
                <View style={{flex: 1}}/>
                <View style={{alignItems: 'center', alignSelf: 'center'}}>
                    <Ticon name={"off-sale"} size={80} color={"#F24F53"}/>
                    <View style={{padding: 20, alignItems: 'center', alignContent: 'center'}}>
                        <Text style={{
                            fontSize: 18,
                            color: '#000',
                            textAlign: 'center'
                        }}>商品已下架</Text>
                    </View>
                </View>
                <View style={{flex: 1}}/>
                <View style={{flex: 1}}/>
            </View>
        )
    };

    showLogin = () => {
        this.props.navigation.navigate('Signin');
    };
}

const css = StyleSheet.create({
    shopInfo: {
        flexDirection: 'row',
    },
    shopLogo: {
        width: 50,
        height: 50,
        borderRadius: 25,
        marginRight: 10
    },
    shopName: {
        fontSize: 16,
        fontWeight: '600',
        color: '#333'
    },
    shopLocation: {
        fontSize: 14,
        color: '#777',
        marginTop: 5
    },
    shopData: {
        flexDirection: 'row',
        marginTop: 10
    },
    shopDataText: {
        fontSize: 13,
        textAlign: 'center',
        color: '#777',
        marginTop: 5
    },
    shopDataItem: {
        borderLeftWidth: 0.5,
        borderLeftColor: '#e0e0e0',
        flex: 1,
        paddingBottom: 5
    }
});

const mapStateToProps = (store) => {
    return {auth: store.auth};
};

export default connect(mapStateToProps)(ItemDetail);

import React from 'react';
import {ScrollView, View, Image, Text, TouchableOpacity, Platform, StyleSheet, DeviceEventEmitter} from 'react-native';
import {connect} from 'react-redux';
import Swiper from 'react-native-swiper';
import HtmlView from 'react-native-htmlview';
import {LoadingView, BarItemSeparate} from "react-native-dsxui";
import {Ticon} from "react-native-ticon";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import PropTypes from 'prop-types';
import BuyModalView from "./components/BuyModalView";
import {AddToCart} from "../cart/CartActions";
import {Utils, Toast, ApiClient} from "../../utils";
import {ShareView} from '../../components';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Size, Styles} from '../../styles';

const getContent = (content) => {
    return `<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />` +
        `<style type="text/css">*{max-width: 100%;}img{max-width: 100%; display: block;}</style></head>` +
        `<body>${content || ''}</body></html>`;
};

class ActionButton extends React.Component {

    static propTypes = {
        onPress: PropTypes.func,
        text: PropTypes.string,
        name: PropTypes.string,
        iconSource: PropTypes.any
    };

    static defaultProps = {
        onPress: () => null,
        text: '',
        name: ''
    };

    render() {
        const styles = {
            iconBox: {
                flex: 1,
                alignContent: 'center',
                alignItems: 'center',
                flexDirection: 'column',
                paddingTop: 5
            },
            iconTitle: {
                fontSize: 12,
                color: '#666',
                textAlign: 'center',
                marginTop: 3
            },
        };

        return (
            <TouchableOpacity activeOpacity={1} onPress={this.props.onPress} style={styles.iconBox}>
                <Image style={{
                    tintColor: "#666",
                    width: 22,
                    height: 22,
                    resizeMode: 'contain'
                }} source={this.props.iconSource}/>
                <Text style={styles.iconTitle}>{this.props.text}</Text>
            </TouchableOpacity>
        );
    }

}

class FooterBar extends React.Component {
    static propTypes = {
        show: PropTypes.bool,
        onAddToCart: PropTypes.func,
        onBuyNow: PropTypes.func,
        onViewShop: PropTypes.func,
        onAddCollection: PropTypes.func,
        onConnectKefu: PropTypes.func
    };
    static defaultProps = {
        show: false,
        onAddToCart: () => null,
        onBuyNow: () => null,
        onViewShop: () => null,
        onAddCollection: () => null,
        onConnectKefu: () => null
    };

    constructor(props) {
        super(props);
    }

    render() {
        const styles = StyleSheet.create({
            bar: {
                height: 49,
                backgroundColor: '#fff',
                borderTopWidth: 0.5,
                borderTopColor: '#e5e5e5',
                flexDirection: 'row',
                display: this.props.show ? 'flex' : 'none'
            },
            icons: {
                width: Size.screenWidth * 0.4,
                flexDirection: 'row',
                height: 49,
                paddingLeft: 5,
                paddingRight: 5
            },
            buttons: {
                flex: 1,
                flexDirection: 'row',
            },
            button: {
                flex: 1,
                alignItems: 'center',
                alignContent: 'center'
            },
            buttonText: {
                flex: 1,
                fontSize: 16,
                color: '#fff',
                lineHeight: 49,
                textAlignVertical: 'center',
                fontWeight: '500'
            }
        });

        return (
            <View style={styles.bar}>
                <View style={styles.icons}>
                    <ActionButton iconSource={require('../../images/icon/shop.png')} text={"店铺"}
                                  onPress={this.props.onViewShop}/>
                    <ActionButton iconSource={require('../../images/icon/star2.png')} text={"收藏"}
                                  onPress={this.props.onAddCollection}/>
                    <ActionButton iconSource={require('../../images/icon/kefu.png')} text={"客服"}
                                  onPress={this.props.onConnectKefu}/>
                </View>
                <View style={styles.buttons}>
                    <TouchableOpacity style={[styles.button, {backgroundColor: '#FD932B'}]} activeOpacity={1}
                                      onPress={this.props.onAddToCart}>
                        <Text style={styles.buttonText}>加入购物车</Text>
                    </TouchableOpacity>
                    <TouchableOpacity style={[styles.button, {backgroundColor: '#F9521F'}]} activeOpacity={1}
                                      onPress={this.props.onBuyNow}>
                        <Text style={styles.buttonText}>立即购买</Text>
                    </TouchableOpacity>
                </View>
            </View>
        );
    }

}

class ItemDetail extends React.Component {
    setNavigationOptions(){
        const {navigation,route} = this.props;
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
                        name={"cart-light"}
                        size={28}
                        color={"#fff"}
                        onPress={() => {
                            navigation.navigate('Cart', {canBack: true})
                        }}/>
                    <BarItemSeparate/>
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
            shop: [],
            props: [],
            loading: true,
            showFooter: false,
            showModal: false,
            showShare: false,
            shareMessage: {},
            isOffSale: false
        };
        this.action = null;
    }

    render() {
        if (this.state.isOffSale) return this.renderOffSale();
        const {auth} = this.props;
        const {item} = this.state;
        if (this.state.loading) return <LoadingView/>;

        let content = item.content.content || `<img src="${item.image}" style="width: 100%;"/>`;
        let html = Platform.OS === 'ios' ? getContent(content) : content;
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
                    <HtmlView value={html} style={{backgroundColor: '#fff'}}/>
                </ScrollView>
                <FooterBar
                    show={this.state.showFooter}
                    onAddToCart={() => {
                        if (auth.isLoggedIn) {
                            this.action = 'AddToCart';
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onBuyNow={() => {
                        if (auth.isLoggedIn) {
                            this.action = 'BuyNow';
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onViewShop={() => {
                        this.props.navigation.navigate('ShopDetail', {shop_id: shop.shop_id});
                    }}
                    onAddCollection={() => {
                        if (auth.isLoggedIn) {
                            Utils.addToCollection(item.itemid, 'item', () => {
                                Toast.show('已成功加入收藏夹');
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onConnectKefu={() => {
                        this.props.navigation.navigate('ShopInfo', {shop_id: shop.shop_id});
                    }}
                />
                <BuyModalView
                    visible={this.state.showModal}
                    data={item}
                    onSubmit={(itemid, quantity) => {
                        if (this.action === 'AddToCart') {
                            AddToCart(itemid, quantity, () => {
                                Toast.show('已成功加入购物车');
                                DeviceEventEmitter.emit('CartDidChanged');
                            });
                        } else {
                            this.setState({showModal: false});
                            this.props.navigation.navigate('ConfirmOrder', {
                                item,
                                shop,
                                quantity
                            });
                        }
                    }}
                />
                <ShareView show={this.state.showShare} shareMessage={this.state.shareMessage}/>
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
                loading: false,
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

    UNSAFE_componentWillMount() {
        this.props.navigation.addListener('willFocus', () => {
            Utils.setStatusBarStyle('dark');
        });
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('willFocus');
    }

    renderSwiper = () => {
        let items = this.state.images.map((image, index) => {
            return (
                <TouchableOpacity style={{flex: 1}} activeOpacity={1} key={index.toString()}>
                    <CacheImage source={{uri: image.image}} style={{flex: 1}}/>
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
                    <View style={{flex: 1}}></View>
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

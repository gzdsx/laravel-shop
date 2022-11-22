import React from 'react';
import {
    ScrollView,
    View,
    Image,
    Text,
    TouchableOpacity,
    StyleSheet,
    Linking
} from 'react-native';
import {connect} from 'react-redux';
import Swiper from 'react-native-swiper';
import {LoadingView, Ticon, Toast} from "react-native-gzdsx-elements";
import RenderHtml from 'react-native-render-html';
import SkuPannel from "./components/SkuPannel";
import {ApiClient} from "../../utils";
import {ShareView} from '../../components';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Size, StatusBarStyles} from '../../styles';
import GoodsActionBar from "./components/GoodsActionBar";
import FastImage from "react-native-fast-image";
import CartActions from "./CartActions";
import Icon from "react-native-vector-icons/AntDesign";

const getContent = (content) => {
    return `<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />` +
        `<style type="text/css">*{max-width: 100%;}img{max-width: 100%; display: block;}</style></head>` +
        `<body>${content || ''}</body></html>`;
};

class ProductDetail extends React.Component {
    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '宝贝详情',
            headerRight: () => (
                <View style={{flexDirection: 'row'}}>
                    <Icon
                        size={25}
                        name={'shoppingcart'}
                        color={'#666'}
                        suppressHighlighting={true}
                        onPress={() => {
                            navigation.navigate('cart');
                        }}
                    />
                    <View style={{width: 10}}/>
                    <Icon
                        name={'sharealt'}
                        size={25}
                        color={"#666"}
                        suppressHighlighting={true}
                        onPress={() => {
                            this.share.show();
                        }}
                    />
                </View>
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            product: {},
            content: {},
            images: [],
            props: [],
            shop: {},
            loading: true,
            showFooter: false,
            showModal: false,
            showShare: false,
            shareMessage: {},
            isOffSale: false,
            subscribe: false,
            shopItemCount: 0
        };
        this.actionType = 1;
    }

    fetchData = () => {
        let itemid = this.props.route.params?.itemid;
        ApiClient.get('/ecom/product.getInfo', {itemid}).then(response => {
            const product = response.result;
            const {images, props, shop} = product;
            this.setState({
                product,
                images,
                props,
                shop,
                loading: false,
                showFooter: true
            });
        }).catch(reason => {
            this.setState({isOffSale: true});
        });

        ApiClient.get('/ecom/product.content.getInfo', {itemid}).then(response => {
            //console.log(response);
            let {content} = response.result;
            this.setState({content});
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        })
        this.fetchData();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        const {oauth} = this.props;
        const {product, content, loading, isOffSale} = this.state;
        if (loading) return <LoadingView/>;
        if (isOffSale) return this.renderOffSale();
        let htmlContent = content || `<img src="${product.image}" style="width: 100%;"/>`;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1, backgroundColor: '#f5f5f5'}}>
                    {this.renderSwiper()}
                    {this.renderItemData()}
                    {this.renderShop()}
                    <View style={{
                        paddingVertical: 10,
                        marginTop: 10
                    }}>
                        <Text style={{
                            textAlign: 'center',
                            fontSize: 16,
                            color: '#666'
                        }}>宝贝详情</Text>
                    </View>
                    {this.renderContent()}
                </ScrollView>
                <GoodsActionBar
                    product={product}
                    onPressAddCart={() => {
                        if (oauth.isAuthenticated) {
                            this.actionType = 1;
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onPressBuyNow={() => {
                        if (oauth.isAuthenticated) {
                            this.actionType = 2;
                            this.setState({
                                showModal: true
                            });
                        } else {
                            this.showLogin();
                        }
                    }}
                    onConnectKefu={() => {
                        Linking.openURL('tel:18685849696');
                    }}
                />
                <SkuPannel
                    show={this.state.showModal}
                    data={product}
                    onSubmit={({sku, quantity}) => {
                        const _this = this;
                        const {itemid} = product;
                        const {sku_id} = sku;
                        if (this.actionType === 1) {
                            this.setState({showModal: false});
                            CartActions.addToCart(itemid, sku_id, quantity).then(() => {
                                Toast.success('已成功加入购物车');
                            }).catch(reason => {
                                Toast.fail(reason.errMsg);
                            });
                        } else {
                            this.setState({showModal: false});
                            this.props.navigation.navigate('buynow', {
                                itemid,
                                sku_id,
                                quantity
                            });
                        }
                    }}
                />
                <ShareView ref={o => this.share = o}/>
            </View>
        );
    }

    renderSwiper = () => {
        let {images} = this.state;
        return (
            <Swiper
                style={{height: Size.screenWidth * 0.8}}
                activeDotColor={"#fff"}
                autoplay
            >
                {
                    images.map((image, index) => (
                        <TouchableOpacity style={{flex: 1}} activeOpacity={1} key={index.toString()}>
                            <FastImage
                                source={{uri: image.image}}
                                style={{
                                    width: Size.screenWidth,
                                    height: Size.screenWidth * 0.8
                                }}
                                resizeMode={FastImage.resizeMode.cover}
                            />
                        </TouchableOpacity>
                    ))
                }
            </Swiper>
        );
    };

    renderContent = () => {
        let {content} = this.state;
        return (
            <RenderHtml
                source={{html: getContent(content)}}
                contentWidth={Size.screenWidth}
                ignoredStyles={['fontFamily']}
                renderersProps={{
                    img: {
                        enableExperimentalPercentWidth: true
                    }
                }}
            />
        );
    }
    renderItemData = () => {
        const {product} = this.state;
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
                    }}>{product.title}</Text>
                </View>
                <View style={{flexDirection: 'row'}}>
                    <Text style={{color: '#f40', fontSize: 14, paddingTop: 4}}>￥</Text>
                    <Text style={{
                        fontSize: 18,
                        fontWeight: 'bold',
                        color: '#f40',
                        marginRight: 20
                    }}>{product.price}</Text>
                    <Text style={{
                        fontSize: 14,
                        color: '#777',
                        paddingTop: 4
                    }}>原价:{product.original_price}</Text>
                </View>
                <View style={{
                    flexDirection: 'row',
                    marginTop: 20
                }}>
                    <Text style={{
                        flex: 1,
                        fontSize: 12,
                        color: '#777'
                    }}>配送费:{product.shipping_fee > 0 ? product.shipping_fee : '免费'}</Text>
                    <View style={{flex: 1}}/>
                    <Text style={{
                        fontSize: 12,
                        color: '#777',
                        textAlign: 'right'
                    }}>已售{product.sold}件</Text>
                </View>
            </View>
        );
    };

    renderShop = () => {
        const {shop, shopItemCount} = this.state;
        if (!shop) return null;
        return (
            <View style={styles.shopContainer}>
                <View style={styles.shopInfo}>
                    <Image source={{uri: shop.logo}} style={styles.shopLogo}/>
                    <View style={{flex: 1, paddingTop: 5}}>
                        <Text style={styles.shopName}>{shop.shop_name}</Text>
                        <Text style={styles.shopLocation}>{shop.province} {shop.city}{shop.district}</Text>
                    </View>
                </View>
                <View style={styles.shopData}>
                    <View style={[styles.shopDataItem, {borderLeftWidth: 0}]}>
                        <Text style={styles.shopDataText}>{shop.visitors}</Text>
                        <Text style={styles.shopDataText}>访客数</Text>
                    </View>
                    <View style={styles.shopDataItem}>
                        <Text style={styles.shopDataText}>{shopItemCount}</Text>
                        <Text style={styles.shopDataText}>商品数</Text>
                    </View>
                    <View style={styles.shopDataItem}>
                        <Text style={styles.shopDataText}>{shop.cumulative_sales}</Text>
                        <Text style={styles.shopDataText}>累计销量</Text>
                    </View>
                </View>
                <View style={styles.viewShopWarp}>
                    <Text
                        style={styles.viewShopText}
                        suppressHighlighting={true}
                        onPress={() => {
                            this.props.navigation.navigate('shop-detail', {shop_id: shop.shop_id})
                        }}>进店看看</Text>
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
        this.props.navigation.navigate('signin');
    };
}

const styles = StyleSheet.create({
    shopContainer: {
        backgroundColor: '#fff',
        paddingVertical: 20,
        paddingHorizontal: 10,
        marginTop: 10
    },
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
    },
    viewShopText: {
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
    },
    viewShopWarp: {
        marginTop: 15,
        alignContent: 'center',
        alignItems: 'center'
    }
});

const mapStateToProps = state => {
    return state;
};

export default connect(mapStateToProps)(ProductDetail);

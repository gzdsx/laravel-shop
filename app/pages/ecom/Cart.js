import React from 'react';
import {
    View,
    Text,
    TouchableOpacity,
    StyleSheet, FlatList, SafeAreaView,
} from 'react-native';
import {connect} from 'react-redux';
import {Toast, LoadingView} from "react-native-gzdsx-elements";
import {RectButton, Swipeable} from 'react-native-gesture-handler';
import {Colors, Size, StatusBarStyles} from "../../styles";
import {lightNavigationConfigure} from "../../base/navconfig";
import {NumberControl} from "../shop/components/NumberControl";
import * as types from '../../actions/types';
import FastImage from "react-native-fast-image";
import {ListItem, CheckBox} from "react-native-elements";
import CartActions from "./CartActions";
import Icon from "react-native-vector-icons/AntDesign";
import {ApiClient} from "../../utils";

class Cart extends React.Component {
    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...lightNavigationConfigure(navigation),
            headerTitle: '购物车',
            headerLeft: () => null
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            shopList: [],
            totalFee: 0,
            totalNum: 0,
            loading: true,
            refreshing: false,
            checkAll: false,
            cartList: []
        };
        this.selectedItems = [];
    }

    fetchData = () => {
        if (this.props.oauth.isAuthenticated) {
            ApiClient.get('/ecom/cart.getInfo').then(response => {
                console.log(response);
                let cartList = response.result;
                this.setState({
                    cartList,
                    loading: false,
                    refreshing: false
                });
            });
        }
    }

    onRefresh = () => {
        this.setState({refreshing: true}, () => {
            setTimeout(this.fetchData, 500);
        });
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToLightStyle();
            //this.fetchData();
            //this.dispatch({type: types.CART_FETCH_DATA});
        });

        this.fetchData();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        let {loading, refreshing, cartList} = this.state;
        const {oauth, navigation} = this.props;
        if (!oauth.isAuthenticated) {
            return this.renderLoginButton();
        }
        if (loading) {
            return <LoadingView/>
        }
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#f2f2f2'}}>
                <FlatList
                    data={cartList}
                    renderItem={({item, index}) => (
                        <View style={styles.shopWrapper}>
                            <ListItem>
                                <ListItem.CheckBox
                                    title={item.shop.shop_name}
                                    checked={item.checked}
                                    iconType={'octicon'}
                                    checkedIcon={'check-circle-fill'}
                                    uncheckedIcon={'circle'}
                                    checkedColor={Colors.primary}
                                    size={22}
                                    onPress={() => {
                                        let checked = !item.checked;
                                        cartList[index].checked = checked;
                                        cartList[index].items.forEach((prod) => {
                                            prod.checked = checked;
                                        });
                                        //this.setState({cartList});
                                        this.calculate();
                                    }}
                                />
                            </ListItem>
                            {
                                item.items.map((prod, idx) => (
                                    <View style={{backgroundColor: '#f00'}} key={idx.toString()}>
                                        <Swipeable
                                            rightThreshold={5}
                                            renderRightActions={(progress, dragX) => {
                                                return (
                                                    <RectButton
                                                        style={styles.rightAction}
                                                        onPress={() => {
                                                            CartActions.removeFromCart(prod.itemid).then(() => {
                                                                cartList[index].items.splice(idx, 1);
                                                                if (cartList[index].items.length === 0) {
                                                                    cartList.splice(index, 1);
                                                                }
                                                                this.setState({cartList}, this.calculate);
                                                            });
                                                        }}
                                                    >
                                                        <Text style={{fontSize: 16, color: '#fff'}}>删除</Text>
                                                    </RectButton>
                                                );
                                            }}
                                        >
                                            <ListItem>
                                                <ListItem.CheckBox
                                                    checked={prod.checked}
                                                    iconType={'octicon'}
                                                    checkedIcon={'check-circle-fill'}
                                                    uncheckedIcon={'circle'}
                                                    checkedColor={Colors.primary}
                                                    size={22}
                                                    onPress={() => {
                                                        cartList[index].items[idx].checked = !prod.checked;
                                                        this.setState({cartList}, this.calculate);
                                                    }}
                                                />
                                                <ListItem.Content style={{flexDirection: 'row'}}>
                                                    <FastImage source={{uri: prod.thumb}} style={styles.thumb}/>
                                                    <View style={styles.productMain}>
                                                        <Text style={styles.productTitle}>{prod.title}</Text>
                                                        {
                                                            prod.sku_title ?
                                                                <View style={{flexDirection: 'row', marginTop: 5}}>
                                                                    <TouchableOpacity style={styles.skuTouch}>
                                                                        <Text
                                                                            style={styles.skuTitle}>{prod.sku_title}</Text>
                                                                    </TouchableOpacity>
                                                                </View>
                                                                : null
                                                        }
                                                        <View style={{flex: 1}}/>
                                                        <View style={{flexDirection: 'row'}}>
                                                            <View style={styles.priceWrapper}>
                                                                <Text style={styles.price}>￥{prod.product.price}</Text>
                                                            </View>
                                                            <NumberControl
                                                                defaultValue={prod.quantity}
                                                                onValueChange={(value) => {
                                                                    CartActions.updateQuantity(prod.itemid, value).then(() => {
                                                                        cartList[index].items[idx].quantity = value;
                                                                        this.setState({cartList}, this.calculate);
                                                                    });
                                                                }}
                                                            />
                                                        </View>
                                                    </View>
                                                </ListItem.Content>
                                            </ListItem>
                                        </Swipeable>
                                    </View>
                                ))
                            }
                        </View>
                    )}
                    keyExtractor={((item, index) => index.toString())}
                    ListEmptyComponent={this.renderEmpty}
                    refreshing={refreshing}
                    onRefresh={this.onRefresh}
                />
                {this.renderFootBar()}
            </SafeAreaView>
        );
    }

    renderEmpty() {
        return (
            <View style={{
                height: Size.screenHeight * 0.5,
                alignItems: 'center',
                justifyContent: 'center'
            }}>
                <Icon name={'shoppingcart'} size={50} color={'#666'}/>
                <Text style={{textAlign: 'center', fontSize: 16, color: '#757575', marginTop: 20}}>购物车还是空的</Text>
            </View>
        );
    }

    renderLoginButton() {
        return (
            <View style={{
                alignItems: 'center',
                justifyContent: 'center',
                height: Size.screenHeight * 0.5
            }}>
                <Text style={{textAlign: 'center', fontSize: 14, color: '#666'}}>你还没有登录</Text>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => {
                        this.props.navigation.navigate('signin');
                    }}
                    style={{
                        paddingVertical: 8,
                        paddingHorizontal: 12,
                        borderRadius: 5,
                        borderWidth: 1,
                        borderColor: '#DDD',
                        backgroundColor: '#fff',
                        marginTop: 20
                    }}
                >
                    <Text style={{fontSize: 14, color: '#666', textAlign: 'center'}}>点击登录</Text>
                </TouchableOpacity>
            </View>
        )
    }

    renderFootBar = () => {
        return (
            <View style={styles.footerBar}>
                <CheckBox
                    title={'全选'}
                    iconType={'octicon'}
                    checkedIcon={'check-circle-fill'}
                    uncheckedIcon={'circle'}
                    checkedColor={Colors.primary}
                    size={22}
                    textStyle={{fontWeight: '400', color: '#666'}}
                    checked={this.state.checkAll}
                    onPress={this.onCheckAll}
                />
                <View style={{flexDirection: 'row', flex: 1}}>
                    <Text style={styles.settlementTotal}>合计</Text>
                    <Text style={styles.settlementAmount}>{this.state.totalFee.toFixed(2).toString()}</Text>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    style={styles.settlementTouch}
                    onPress={this.settlement}
                >
                    <View style={styles.settlementWrapper}>
                        <Text style={styles.settlementText}>结算({this.state.totalNum})</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    }

    onCheckAll = () => {
        let checkAll = !this.state.checkAll;
        let {cartList} = this.state;
        cartList.forEach((cart) => {
            cart.checked = checkAll;
            cart.items.forEach((prod) => {
                prod.checked = checkAll;
            });
        });
        this.setState({checkAll, cartList}, this.calculate);
    };

    calculate = () => {
        let totalFee = 0;
        let totalNum = 0;
        let totalCount = 0;
        this.selectedItems = [];
        this.state.cartList.forEach((cart) => {
            let count = 0;
            cart.items.map((prod) => {
                if (prod.checked) {
                    count += 1;
                    totalNum += prod.quantity;
                    totalFee += prod.price * prod.quantity;
                    this.selectedItems.push(prod);
                }
            });
            cart.checked = count === cart.items.length;
            if (cart.checked) {
                totalCount += 1;
            }
        });
        let checkAll = totalCount === this.state.cartList.length;
        this.setState({totalNum, totalFee, checkAll});
    };

    settlement = () => {
        if (this.selectedItems.length === 0) {
            Toast.fail('请选择要结算的商品');
            return false;
        }

        let ids = this.selectedItems.map((d) => d.itemid);
        this.props.navigation.navigate('confirm-order', {ids});
    };
}

const mapStateToProps = state => {
    return state;
};

export default connect(mapStateToProps)(Cart);


const styles = StyleSheet.create({
    flexCenter: {
        justifyContent: 'center',
        alignItems: 'center'
    },
    rightAction: {
        alignItems: 'center',
        justifyContent: 'center',
        width: 80
    },
    actionText: {
        fontSize: 16,
        color: '#fff'
    },
    shopWrapper: {
        backgroundColor: '#fff',
        marginBottom: 10,
    },
    thumb: {
        width: 90,
        height: 90,
        borderRadius: 3
    },
    productMain: {
        flex: 1,
        flexDirection: 'column',
        paddingHorizontal: 10
    },
    productTitle: {
        fontSize: 14,
        color: '#333'
    },
    skuTouch: {
        backgroundColor: '#f2f2f2',
        paddingHorizontal: 7,
        paddingVertical: 3,
        borderRadius: 5,
    },
    skuTitle: {
        fontSize: 12,
        color: '#555'
    },
    price: {
        fontSize: 16,
        color: '#f40',
        fontWeight: '500',
    },
    priceWrapper: {
        flex: 1,
        justifyContent: 'center'
    },
    footerBar: {
        backgroundColor: '#fff',
        borderTopColor: '#e5e5e5',
        borderTopWidth: 0.5,
        flexDirection: 'row'
    },
    settlementTouch: {
        width: 140,
        paddingVertical: 5,
        paddingHorizontal: 10
    },
    settlementWrapper: {
        backgroundColor: '#F9521F',
        borderRadius: 20,
        flex: 1,
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center'
    },
    settlementText: {
        fontSize: 14,
        fontWeight: '500',
        color: '#fff',
        textAlign: 'center'
    },
    settlementTotal: {
        flex: 1,
        textAlign: 'right',
        lineHeight: 49,
        fontSize: 14
    },
    settlementAmount: {
        color: '#f40',
        lineHeight: 49,
        fontSize: 14,
        paddingHorizontal: 10
    }
});

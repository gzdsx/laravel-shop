import React from 'react';
import {
    View,
    Text,
    Image,
    FlatList,
    TouchableOpacity,
    ScrollView,
    RefreshControl,
    DeviceEventEmitter
} from 'react-native';
import {connect} from 'react-redux';
import {Ticon} from "react-native-ticon";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import PropTypes from 'prop-types';
import {ListItem} from 'react-native-elements';
import ItemGridView from "../shop/components/ItemGridView";
import Settlement from "./Settlement";
import {Styles} from "../../styles";
import {Utils, ApiClient, Toast} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";


const CheckBox = ({
                      checked = false,
                      color = "#888",
                      activeColor = "#23C55D",
                      onPress = () => null,
                      size = 22,
                      style = {}
                  }) => {
    return (
        <TouchableOpacity activeOpacity={1} style={{width: size, height: size, ...style}} onPress={onPress}>
            <Image
                source={checked ? require('../../images/controls/round_check_fill.png') : require('../../images/controls/round.png')}
                style={{
                    flex: 1,
                    width: size,
                    height: size,
                    tintColor: checked ? activeColor : color,
                }}
            />
        </TouchableOpacity>
    );
};

class QuantityView extends React.Component {

    static propTypes = {
        style: PropTypes.object,
        defaultValue: PropTypes.number,
        onValueChange: PropTypes.func
    };

    static defaultProps = {
        style: {},
        defaultValue: 1,
        onValueChange: () => null
    };

    constructor(props) {
        super(props);
        this.state = {
            numberValue: props.defaultValue
        };
    }


    render() {
        return (
            <View style={{
                flexDirection: 'row',
                borderRadius: 4,
                borderColor: '#e5e5e5',
                borderWidth: 0.5,
                ...this.props.style
            }}>
                <TouchableOpacity
                    activeOpacity={0.8}
                    onPress={this.onDecrease}
                >
                    <Text style={{
                        fontSize: 16,
                        color: '#000',
                        marginLeft: 10,
                        marginRight: 10
                    }}>-</Text>
                </TouchableOpacity>
                <Text style={{
                    borderLeftColor: '#e5e5e5',
                    borderLeftWidth: 0.5,
                    borderRightColor: '#e5e5e5',
                    borderRightWidth: 0.5,
                    width: 40,
                    textAlign: 'center',
                    textAlignVertical: 'center',
                    fontSize: 14
                }}>{this.state.numberValue}</Text>
                <TouchableOpacity
                    activeOpacity={0.8}
                    onPress={this.onIncrease}
                >
                    <Text style={{
                        fontSize: 16,
                        color: '#000',
                        marginLeft: 10,
                        marginRight: 10
                    }}>+</Text>
                </TouchableOpacity>
            </View>
        );
    }

    onDecrease = () => {
        let {numberValue} = this.state;
        if (numberValue < 2) {
            return false;
        } else {
            numberValue--;
            this.setState({numberValue});
            this.props.onValueChange(numberValue);
        }
    };

    onIncrease = () => {
        let {numberValue} = this.state;
        numberValue++;
        this.setState({numberValue});
        this.props.onValueChange(numberValue);
    };
}

class FooterBar extends React.Component {
    static propTypes = {
        totalFee: PropTypes.number,
        totalNum: PropTypes.number,
        checked: PropTypes.bool,
        onCheckAll: PropTypes.func,
        onSettlement: PropTypes.func,
        visible: PropTypes.bool
    };

    static defaultProps = {
        totalFee: 0,
        totalNum: 0,
        checked: false,
        onCheckAll: () => null,
        onSettlement: () => null,
        visible: false
    };

    render() {
        return (
            <View style={{
                height: 49,
                backgroundColor: '#fff',
                borderTopColor: '#e5e5e5',
                borderTopWidth: 0.5,
                flexDirection: 'row',
                display: this.props.visible ? 'flex' : 'none'
            }}>
                <View style={{
                    flexDirection: 'row',
                    paddingTop: 13,
                    paddingLeft: 10
                }}>
                    <CheckBox checked={this.props.checked} onPress={this.props.onCheckAll}/>
                    <Text style={{
                        height: 22,
                        lineHeight: 22,
                        fontSize: 14,
                        color: '#000',
                        marginLeft: 8
                    }}>全选</Text>
                </View>
                <View style={{
                    flexDirection: 'row',
                    flex: 1
                }}>
                    <Text style={{
                        flex: 1,
                        textAlign: 'right',
                        lineHeight: 49,
                        fontSize: 14
                    }}>合计</Text>
                    <Text style={{
                        color: '#f40',
                        lineHeight: 49,
                        fontSize: 14,
                        paddingLeft: 10,
                        paddingRight: 10
                    }}>{this.props.totalFee.toFixed(2).toString()}</Text>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        width: 120,
                        backgroundColor: '#F9521F'
                    }}
                    onPress={this.props.onSettlement}
                >
                    <Text style={{
                        flex: 1,
                        lineHeight: 49,
                        fontSize: 16,
                        fontWeight: '500',
                        color: '#fff',
                        textAlign: 'center'
                    }}>结算({this.props.totalNum})</Text>
                </TouchableOpacity>
            </View>
        );
    }

}

class Cart extends React.Component {
    static navigationOptions = ({navigation, route}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '购物车',
        headerLeft: () => {
            let canBack = route.params?.canBack;
            if (canBack) {
                return (
                    <View style={Styles.headerLeft}>
                        <Ticon name={"back-light"} size={28} color={"#fff"} onPress={() => navigation.goBack()}/>
                    </View>
                );
            } else {
                return <View style={Styles.headerLeft}/>;
            }
        }
    });

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isLoading: true,
            checkall: false,
            totalFee: 0,
            totalNum: 0,
            isRefreshing: false
        };
    }


    render() {
        const {auth, navigation} = this.props;
        return (
            <View style={{flex: 1}}>
                <ScrollView
                    style={{flex: 1}}
                    refreshControl={<RefreshControl
                        refreshing={this.state.isRefreshing}
                        onRefresh={() => {
                            if (this.state.isRefreshing) return false;
                            this.setState({isRefreshing: true});
                            setTimeout(this.fetchData, 1000);
                        }}
                    />}
                >
                    {this.renderCartView()}
                    <Text style={{padding: 15, textAlign: 'center', fontSize: 16, color: '#666'}}>你可能喜欢</Text>
                    <ItemGridView
                        data={this.state.items}
                        isLoading={this.state.loadingItem}
                        onPressItem={(item) => {
                            navigation.navigate('ItemDetail', {itemid: item.itemid});
                        }}
                    />
                </ScrollView>
                <FooterBar
                    visible={auth.isLoggedIn}
                    totalFee={this.state.totalFee}
                    totalNum={this.state.totalNum}
                    checked={this.state.checkall}
                    onCheckAll={this.checkAll}
                    onSettlement={this.settilement}
                />
            </View>
        );
    }


    UNSAFE_componentWillMount() {
        const {auth, navigation} = this.props;
        this.props.navigation.addListener('willFocus', () => {
            Utils.setStatusBarStyle('light');
        });

        this.cartListener = DeviceEventEmitter.addListener('CartDidChanged', this.fetchData);
    }


    componentWillUnmount() {
        this.props.navigation.removeListener('willFocus');
        this.cartListener.remove();
    }


    componentDidMount() {
        if (this.props.auth.isLoggedIn) {
            this.fetchData();
        }

        ApiClient.get('/item/batchget', {
            offset: 0,
            count: 20
        }).then(response => {
            setTimeout(() => {
                this.setState({
                    isLoading: false,
                    items: response.data.items
                });
            }, 300);
        });
    }


    showSignin = () => {
        this.props.navigation.navigate('Signin');
    };

    fetchData = () => {
        ApiClient.get('/cart/getall').then(response => {
            let items = response.data.items;
            this.setState({items, isRefreshing: false});
        });
    };

    renderCartView = () => {
        const {auth} = this.props;
        if (auth.isLoggedIn) {
            if (this.state.items.length > 0) {
                return this.renderItems();
            } else {
                return this.renderEmpty();
            }
        } else {
            return this.renderLoginButton();
        }
    };

    renderEmpty() {
        return (
            <View style={{
                alignItems: 'center',
                alignSelf: 'center',
                paddingTop: 50,
                paddingBottom: 50
            }}>
                <Ticon name={"cart-light"} size={50} color={"#666"}/>
                <Text style={{textAlign: 'center', fontSize: 14, color: '#666', marginTop: 20}}>购物车是空的</Text>
            </View>
        );
    }

    renderLoginButton() {
        return (
            <View style={{
                alignItems: 'center',
                alignSelf: 'center',
                paddingTop: 50,
                paddingBottom: 50
            }}>
                <Text style={{textAlign: 'center', fontSize: 14, color: '#666'}}>你还没有登录</Text>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={this.showSignin}
                    style={{
                        paddingTop: 8,
                        paddingBottom: 8,
                        paddingLeft: 12,
                        paddingRight: 12,
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

    renderItems = () => {
        let contents = this.state.items.map((item) => {
            return (
                <View style={{
                    paddingTop: 5,
                    paddingBottom: 5,
                    paddingLeft: 10,
                    paddingRight: 10,
                    flexDirection: 'row',
                }} key={item.itemid.toString()}>
                    <View style={{
                        width: 22,
                        alignSelf: 'center'
                    }}>
                        <CheckBox checked={item.checked} onPress={() => this.onclickItem(item)}/>
                    </View>
                    <CacheImage source={{uri: item.thumb}} style={{
                        width: 100,
                        height: 80,
                        marginLeft: 6,
                        borderRadius: 2
                    }}/>
                    <View style={{
                        flex: 1,
                        marginLeft: 15
                    }}>
                        <Text style={{
                            fontSize: 14,
                            color: '#000',
                            lineHeight: 16,
                            flex: 1
                        }} numberOfLines={2}>{item.title}</Text>
                        <View style={{height: 24, flexDirection: 'row'}}>
                            <Text style={{
                                color: '#f40',
                                fontWeight: '500',
                                fontSize: 16,
                                flex: 1
                            }}>￥{item.price}</Text>
                            <QuantityView defaultValue={item.quantity} onValueChange={(quantity) => {
                                ApiClient.post('/cart/update_quantity', {
                                    itemid: item.itemid,
                                    quantity
                                }).then(response => {
                                    this.onQuantityChange(item, quantity);
                                });
                            }}/>
                        </View>
                    </View>
                </View>
            );
        });
        return (
            <View style={{
                paddingTop: 5,
                paddingBottom: 5,
                backgroundColor: '#fff'
            }}>{contents}</View>
        );
    };

    onclickShop = (shop) => {
        let {carts} = this.state;
        carts.forEach((cart) => {
            if (cart.shop.shop_id === shop.shop_id) {
                cart.shop.checked = !cart.shop.checked;
            }
            cart.items.forEach((item) => {
                item.checked = cart.shop.checked;
            });
        });
        this.setState({carts}, this.total);
    };

    onclickItem = (item) => {
        let {carts} = this.state;
        carts.forEach((cart) => {
            let iCount = 0;
            cart.items.forEach((i) => {
                if (item.itemid === i.itemid) {
                    i.checked = !i.checked;
                }
                if (i.checked) {
                    iCount++;
                }
            });
            cart.shop.checked = cart.items.length === iCount;
        });
        this.setState({carts}, this.total);
    };

    onQuantityChange = (item, quantity) => {
        let {carts} = this.state;
        carts.forEach((cart) => {
            cart.items.forEach((i) => {
                if (i.itemid === item.itemid) {
                    i.quantity = quantity;
                }
            });
        });
        this.setState({carts}, this.total);
    };

    checkAll = () => {
        let checkall = !this.state.checkall;
        let carts = this.state.carts;
        carts.forEach((cart) => {
            cart.shop.checked = checkall;
            cart.items.forEach((item) => {
                item.checked = checkall;
            });
        });
        this.setState({carts, checkall}, this.total);
    };

    total = () => {
        let totalFee = 0;
        let totalNum = 0;
        this.state.carts.map((cart) => {
            cart.items.map((item) => {
                if (item.checked) {
                    totalNum += item.quantity;
                    totalFee += item.price * item.quantity;
                }
            });
        });
        this.setState({totalNum, totalFee});
    };

    settilement = () => {
        let itemids = [];
        this.state.carts.map((cart) => {
            cart.items.map((item) => {
                if (item.checked) itemids.push(item.itemid);
            });
        });

        if (itemids.length > 0) {
            this.props.navigation.navigate('Settlement', {itemids, callback: this.fetchData});
        } else {
            Toast.show('请选择要结算的商品');
        }
    };
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth,
    };
};

export default connect(mapStateToProps)(Cart);

import React from 'react';
import {
    View,
    Text,
    TouchableOpacity,
    ScrollView,
    RefreshControl,
    DeviceEventEmitter,
    Animated,
    StyleSheet,
} from 'react-native';
import {connect} from 'react-redux';
import {Ticon, Toast, CheckBox} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import Swipeable from 'react-native-gesture-handler/Swipeable';
import {RectButton} from 'react-native-gesture-handler';
import ProductGridView from "../shop/components/ProductGridView";
import {Styles} from "../../styles";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {NumberControl} from "../shop/components/NumberControl";
import {CartDidChangedNotification} from "../../base/constants";

class Cart extends React.Component {
    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '购物车',
            headerLeft: () => {
                let canBack = route.params?.canBack;
                if (canBack) {
                    return (
                        <TouchableOpacity onPress={navigation.goBack} activeOpacity={1} style={Styles.headerLeft}>
                            <Ticon name={"back-light"} size={28} color={"#fff"}/>
                        </TouchableOpacity>
                    );
                } else {
                    return <View style={Styles.headerLeft}/>;
                }
            }
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            cartItems: [],
            isLoading: true,
            checkAll: false,
            totalFee: 0,
            totalNum: 0,
            isRefreshing: false
        };
        this.checkedItems = [];
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
                    <ProductGridView
                        data={this.state.items}
                        isLoading={this.state.loadingItem}
                        onPressItem={(item) => {
                            navigation.navigate('ProductDetail', {itemid: item.itemid});
                        }}
                    />
                </ScrollView>
                {auth.isSignined && this.renderFootBar()}
                <Toast ref={"toast"}/>
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        DeviceEventEmitter.addListener(CartDidChangedNotification, this.fetchData);
        this.fetchData();
        ApiClient.get('/product/batchget', {
            offset: 0,
            count: 20
        }).then(response => {
            this.setState({
                isLoading: false,
                items: response.result.items
            });
        });
    }

    showSignin = () => {
        this.props.navigation.navigate('Signin');
    };

    fetchData = () => {
        if (this.props.auth.isSignined) {
            ApiClient.get('/cart/getall').then(response => {
                let cartItems = response.result.items;
                this.setState({cartItems, isRefreshing: false, checkAll: false});
            });
        }
    };

    renderCartView = () => {
        const {auth} = this.props;
        if (auth.isSignined) {
            if (this.state.cartItems.length > 0) {
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

    renderItems = () => {
        const styles = StyleSheet.create({
            rightAction: {
                flexDirection: 'row',
                alignItems: 'center',
                justifyContent: 'center',
                paddingHorizontal: 20
            },
            actionText: {
                fontSize: 16,
                color: '#fff'
            }
        });
        let contents = this.state.cartItems.map((item, index) => {
            return (
                <View style={{backgroundColor: '#f00'}} key={item.itemid.toString()}>
                    <Swipeable
                        rightThreshold={75}
                        renderRightActions={(progress, dragX) => {
                            const trans = dragX.interpolate({
                                inputRange: [0, 100, 100, 101],
                                outputRange: [0, 0, 0, 1],
                            });
                            return (
                                <RectButton
                                    style={styles.rightAction}
                                    onPress={() => {
                                        ApiClient.post('/cart/delete', {items: [item.itemid]}).then(response => {
                                            this.fetchData();
                                        });
                                    }}
                                >
                                    <Animated.Text
                                        style={[
                                            styles.actionText,
                                            {
                                                transform: [{translateX: trans}],
                                            },
                                        ]}>
                                        删除
                                    </Animated.Text>
                                </RectButton>
                            );
                        }}>
                        <View style={{
                            flexDirection: 'row',
                            backgroundColor: '#fff',
                            paddingVertical: 10,
                            borderBottomWidth: 0.5,
                            borderBottomColor: '#e5e5e5'
                        }}>
                            <View style={{paddingHorizontal: 10, alignItems: 'center', justifyContent: 'center'}}>
                                <CheckBox checked={item.checked} onPress={() => {
                                    item.checked = !item.checked;
                                    let cartItems = this.state.cartItems;
                                    this.checkedItems = cartItems.filter((it) => {
                                        if (it.checked) return it;
                                    });
                                    let checkAll = this.checkedItems.length === cartItems.length;
                                    this.setState({cartItems, checkAll}, this.total);
                                }}/>
                            </View>
                            <CacheImage source={{uri: item.thumb}} style={{width: 80, height: 80, borderRadius: 3}}/>
                            <View style={{flex: 1, flexDirection: 'column', paddingHorizontal: 10}}>
                                <Text style={{fontSize: 14}}>{item.title}</Text>
                                {
                                    item.sku_id ?
                                        <View style={{flexDirection: 'row', marginTop: 5}}>
                                            <TouchableOpacity style={{
                                                backgroundColor: '#f2f2f2',
                                                paddingHorizontal: 5,
                                                paddingVertical: 3,
                                                borderRadius: 5
                                            }}>
                                                <Text style={{fontSize: 12, color: '#555'}}>{item.sku_title}</Text>
                                            </TouchableOpacity>
                                        </View>
                                        : null
                                }
                                <View style={{flex: 1}}/>
                                <View style={{flexDirection: 'row'}}>
                                    <Text style={{
                                        fontSize: 16,
                                        color: '#f40',
                                        fontWeight: '500',
                                        flex: 1
                                    }}>￥{item.price}</Text>
                                    <NumberControl
                                        defaultValue={item.quantity}
                                        onValueChange={(value) => {
                                            ApiClient.post('/cart/update', {
                                                itemid: item.itemid,
                                                quantity: value
                                            }).then(response => {
                                                item.quantity = value;
                                                this.total();
                                            });
                                        }}
                                    />
                                </View>
                            </View>
                        </View>
                    </Swipeable>
                </View>
            );
        });
        return (
            <View style={{backgroundColor: '#fff'}}>{contents}</View>
        );
    };

    renderFootBar = () => {
        return (
            <View style={{
                height: 49,
                backgroundColor: '#fff',
                borderTopColor: '#e5e5e5',
                borderTopWidth: 0.5,
                flexDirection: 'row'
            }}>
                <CheckBox
                    title={'全选'}
                    style={{paddingHorizontal: 10}}
                    checked={this.state.checkAll}
                    onPress={this.onCheckAll}
                />
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
                        paddingHorizontal: 10
                    }}>{this.state.totalFee.toFixed(2).toString()}</Text>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        width: 140,
                        paddingVertical: 5,
                        paddingHorizontal: 10
                    }}
                    onPress={this.settlement}
                >
                    <View style={{
                        backgroundColor: '#F9521F',
                        borderRadius: 20,
                        flex: 1,
                        flexDirection: 'row',
                        justifyContent: 'center',
                        alignItems: 'center'
                    }}>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '500',
                            color: '#fff',
                            textAlign: 'center'
                        }}>结算({this.state.totalNum})</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    }

    onCheckAll = () => {
        let checkAll = !this.state.checkAll;
        let cartItems = this.state.cartItems;
        cartItems.forEach((item) => {
            item.checked = checkAll;
        });
        this.setState({checkAll, cartItems}, this.total);
        this.checkedItems = checkAll ? cartItems : [];
    };

    total = () => {
        let totalFee = 0;
        let totalNum = 0;
        this.state.cartItems.map((item) => {
            if (item.checked) {
                totalNum += item.quantity;
                totalFee += item.price * item.quantity;
            }
        });
        this.setState({totalNum, totalFee});
    };

    settlement = () => {
        if (this.checkedItems.length === 0) {
            this.refs.toast.show('请选择要结算的商品');
            return false;
        }

        let items = this.checkedItems.map((d) => d.itemid);
        this.props.navigation.navigate('ConfirmOrder', {items});
    };
}

const mapStateToProps = (store) => {
    return {...store};
};

export default connect(mapStateToProps)(Cart);

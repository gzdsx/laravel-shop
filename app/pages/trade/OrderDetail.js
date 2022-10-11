import React from 'react';
import {View, Text, Image, ScrollView, StyleSheet, TouchableOpacity, Alert} from 'react-native';
import {LoadingView, Spinner, Ticon} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {Toast} from 'react-native-gzdsx-elements';
import {ApiClient, Utils} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors} from "../../styles";
import OrderActionBar from "./OrderActionBar";
import OrderActionButton from "./OrderActionButton";
import {AddToCart} from "../cart/CartActions";

const getStatusIcon = (status) => {
    let icon;
    switch (status) {
        case 1:
            icon = require('../../images/trade/waitPay.png');
            break;
        case 2:
            icon = require('../../images/trade/waitSend.png');
            break;
        case 3:
            icon = require('../../images/trade/send.png');
            break;
        case 4:
            icon = require('../../images/trade/received.png');
            break;
        case 5:
            icon = require('../../images/trade/refunding.png');
            break;
        case 6:
            icon = require('../../images/trade/closed.png');
            break;
        default:
            ;
    }
    return icon;
};

export default class OrderDetail extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '订单详情',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            order: null,
            items: [],
            shipping: null,
            transaction: null,
            loading: true,
            reasons: []
        };
    }

    render() {
        if (this.state.loading) return <LoadingView/>;
        const {order} = this.state;
        const {order_id, order_state, shipping_state} = order;
        return (
            <View style={{flex: 1}}>
                <ScrollView>
                    {this.renderTradeStatus()}
                    {this.renderShippingAddress()}
                    {this.renderContent()}
                    {this.renderOrderInfo()}
                </ScrollView>
                <OrderActionBar
                    order={order}
                    reasons={this.state.reasons}
                    style={{backgroundColor: '#fff', height: 49}}
                    onCancel={this.fetchData}
                    onPay={this.fetchData}
                    onNotice={() => {
                    }}
                    onConfirm={this.fetchData}
                    onRate={() => {

                    }}
                    onExpress={() => {

                    }}
                    onDelete={() => {
                        this.props.navigation.goBack();
                    }}
                />
                <Spinner ref={'spinner'}/>
                <Toast ref={'toast'}/>
            </View>
        );
    }

    UNSAFE_componentWillMount() {
        this.props.navigation.addListener('focus', () => Utils.setStatusBarStyle('light'));
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('focus');
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.fetchData();
        ApiClient.get('/order/closereason/getall').then(response => {
            this.setState({reasons: response.result.items});
        });
    }

    /**
     * 查询订单数据
     */
    fetchData = () => {
        const {order_id} = this.props.route.params;
        ApiClient.get('/bought/get', {order_id}).then(response => {
            const order = response.result.order;
            //console.log(order);
            const {items, shipping, transaction} = order;
            this.setState({
                order,
                items,
                shipping,
                transaction,
                loading: false
            });
        });
    };

    /**
     * 渲染订单状态
     * @returns {*}
     */
    renderTradeStatus = () => {
        const {order} = this.state;
        return (
            <View style={{
                backgroundColor: Colors.primary,
                paddingVertical: 20,
                paddingLeft: 20,
                paddingRight: 30,
                flexDirection: 'row'
            }}>
                <View style={{
                    flex: 1,
                    alignItems: 'flex-start',
                    alignSelf: 'center'
                }}>
                    <Text style={{
                        fontSize: 18,
                        fontWeight: '500',
                        color: '#fff'
                    }}>{order.buyer_state_des}</Text>
                </View>
                <Image
                    source={getStatusIcon(order.order_state)}
                    style={{
                        width: 60,
                        height: 60,
                        tintColor: '#fff'
                    }}
                />
            </View>
        );
    };

    /**
     * 渲染配送地址
     * @returns {*}
     */
    renderShippingAddress = () => {
        const {shipping} = this.state;
        return (
            <View style={{
                flexDirection: 'row',
                paddingHorizontal: 10,
                paddingVertical: 20,
                backgroundColor: '#fff',
                marginBottom: 10
            }}>
                <View style={{alignItems: 'center', alignSelf: 'center', marginRight: 10}}>
                    <Ticon name={"location"} size={24} color={"#666"}/>
                </View>
                <View style={{flex: 1}}>
                    <View style={{flexDirection: 'row'}}>
                        <Text style={{
                            flex: 1,
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333'
                        }}>收货人: {shipping.name}</Text>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333',
                            textAlign: 'right'
                        }}>{shipping.tel}</Text>
                    </View>
                    <Text
                        style={{
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333',
                            marginTop: 5
                        }}
                        numberOfLines={2}
                    >收货地址: {shipping.full_address}</Text>
                </View>
            </View>
        );
    };

    /**
     * 渲染订单内容
     * @returns {*}
     */
    renderContent = () => {
        const {order} = this.state;
        const {order_id, items} = order;
        let itemContents = items.map((item, index) => {
            return (
                <View key={index.toString()}>
                    <TouchableOpacity activeOpacity={1}>
                        <View style={css.itemBox}>
                            <CacheImage source={{uri: item.thumb}} style={css.itemImage}/>
                            <View style={css.itemTitleView}>
                                <Text style={css.itemTitle}>{item.title}</Text>
                                {
                                    item.sku_id ?
                                        <Text
                                            style={{fontSize: 12, color: '#666', marginTop: 5}}>{item.sku_title}</Text>
                                        : null
                                }
                            </View>
                            <View style={css.itemData}>
                                <Text style={css.itemPrice}>￥{item.price}</Text>
                                <Text style={css.itemQuantity}>x{item.quantity}</Text>
                            </View>
                        </View>
                    </TouchableOpacity>
                    <View style={{flexDirection: 'row', padding: 10, justifyContent: 'flex-end'}}>
                        <OrderActionButton title={"加入购物车"} onPress={() => {
                            AddToCart(item.itemid, 1, item.sku_id, () => {
                                this.refs.toast.show('已成功加入购物车');
                            });
                        }}/>
                        <OrderActionButton
                            title={order.receive_state ? "申请售后" : "申请退款"}
                            show={order.pay_state && item.refund_id === 0}
                            onPress={() => {
                                this.props.navigation.navigate('RefundRouter', {order_id, items: [item]});
                            }}
                        />
                        <OrderActionButton
                            title={"退款中"}
                            show={item.refund_state === 1}
                            onPress={() => {
                                this.props.navigation.navigate('RefundDetail', {refund_id: item.refund_id});
                            }}
                        />
                        <OrderActionButton
                            title={"退款完成"}
                            show={item.refund_state === 2}
                            onPress={() => {
                                this.props.navigation.navigate('RefundDetail', {refund_id: item.refund_id});
                            }}
                        />
                    </View>
                </View>
            );
        });

        return (
            <View style={{backgroundColor: '#fff'}}>
                <View style={{paddingTop: 5, paddingBottom: 5, backgroundColor: '#fff'}}>{itemContents}</View>
                <View style={{
                    backgroundColor: '#fff',
                    padding: 10
                }}>
                    <View style={css.row}>
                        <Text style={css.textLabel}>商品总价</Text>
                        <Text style={css.detailLabel}>￥{order.product_fee}</Text>
                    </View>
                    <View style={css.row}>
                        <Text style={css.textLabel}>运费</Text>
                        <Text style={css.detailLabel}>+￥{order.shipping_fee}</Text>
                    </View>
                    <View style={css.row}>
                        <Text style={css.textLabel}>优惠</Text>
                        <Text style={css.detailLabel}>-￥{order.discount_fee}</Text>
                    </View>
                    <View style={css.row}>
                        <Text style={css.textLabel}>实付款</Text>
                        <Text style={[css.detailLabel, {color: '#f00', fontSize: 14}]}>￥{order.order_fee}</Text>
                    </View>
                </View>
            </View>
        );
    };

    /**
     * 渲染订单信息
     * @returns {*}
     */
    renderOrderInfo = () => {
        const {order, transaction} = this.state;
        return (
            <View style={{
                backgroundColor: '#fff',
                padding: 7,
                marginTop: 10
            }}>
                <Text style={{fontSize: 12, color: '#777', padding: 3}}>订单编号: {order.order_no}</Text>
                <Text style={{
                    fontSize: 12,
                    color: '#777',
                    padding: 3
                }}>创建时间: {order.created_at}</Text>
                {transaction ?
                    <Text style={{fontSize: 12, color: '#777', padding: 3}}>交易流水: {transaction.out_trade_no}</Text>
                    :
                    null
                }
            </View>
        );
    };
}

const css = StyleSheet.create({
    itemBox: {
        flexDirection: 'row',
        paddingTop: 5,
        paddingBottom: 5,
        paddingLeft: 10,
        paddingRight: 10
    },
    itemImage: {
        width: 80,
        height: 80,
        borderRadius: 3,
        marginRight: 10
    },
    itemTitleView: {
        flex: 1
    },
    itemTitle: {
        fontSize: 14,
        color: '#333'
    },
    itemData: {
        marginLeft: 20
    },
    itemPrice: {
        fontSize: 14,
        color: '#666',
        textAlign: 'right'
    },
    itemQuantity: {
        marginTop: 5,
        fontSize: 12,
        color: '#666',
        textAlign: 'right'
    },
    row: {
        flexDirection: 'row',
        paddingTop: 5,
        paddingBottom: 5
    },
    textLabel: {
        fontSize: 14,
        color: '#333',
        flex: 1
    },
    detailLabel: {
        fontSize: 12,
        color: '#666',
        textAlign: 'right'
    }
});

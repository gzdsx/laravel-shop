import React from 'react';
import {View, Text, Image, ScrollView, StyleSheet, TouchableOpacity, Alert} from 'react-native';
import Alipay from 'react-native-gzdsx-alipay';
import {LoadingView, Spinner, Ticon} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {Button} from 'react-native-elements';
import {Toast, ApiClient, Utils} from "../../utils";
import * as WeChat from 'react-native-wechat';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors} from "../../styles";

const SectionTitleView = ({text}) => {
    return (
        <View style={{
            alignSelf: 'center',
            alignItems: 'flex-start',
            padding: 15
        }}>
            <Text style={{
                fontSize: 14,
                color: '#666'
            }}>{text}</Text>
        </View>
    )
};

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

const ActionButton = ({text, show = true, onPress = () => null}) => {
    return (
        <TouchableOpacity
            activeOpacity={1}
            style={{
                paddingVertical: 8,
                paddingHorizontal: 12,
                borderRadius: 18,
                borderWidth: 0.5,
                borderColor: '#ccc',
                marginLeft: 10,
                display: show ? 'flex' : 'none'
            }}
            onPress={onPress}
        >
            <Text style={{
                flex: 1,
                color: '#333',
                fontSize: 12,
                textAlign: 'center'
            }}>
                {text}
            </Text>
        </TouchableOpacity>
    );
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
            isLoading: true
        };
    }

    render() {
        if (this.state.isLoading) return <LoadingView/>;
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
                <View style={{
                    height: 49,
                    backgroundColor: '#fff',
                    flexDirection: 'row',
                    padding: 10
                }}>
                    <View style={{flex: 1}}/>
                    <ActionButton
                        text={"取消订单"}
                        show={order_state === 1}
                        onPress={() => this.cancelOrder()}
                    />
                    <ActionButton
                        text={"查看物流"}
                        show={shipping_state}
                        onPress={() => {
                            this.props.navigation.navigate('ViewExpress', {order_id});
                        }}
                    />
                    <ActionButton
                        text={"支付"}
                        show={order_state === 1}
                        onPress={this.payOrder}
                    />
                    <ActionButton
                        text={"提醒卖家发货"}
                        show={order_state === 2}
                        onPress={() => this.noticeOrder()}
                    />
                    <ActionButton
                        text={"确认收货"}
                        show={order_state === 3}
                        onPress={() => this.confirmOrder()}
                    />
                    <ActionButton
                        text={"评价"}
                        show={order_state === 4}
                    />
                    <ActionButton
                        text={"申请退款"}
                        show={order_state === 5}
                    />
                </View>
                <Spinner ref={'spinner'}/>
            </View>
        );
    }


    componentDidMount() {
        this.setNavigationOptions();
        this.fetchData();
    }

    fetchData = () => {
        const {order_id} = this.props.route.params;
        ApiClient.get('/bought/get', {order_id}).then(response => {
            const order = response.data.order;
            //console.log(order);
            const {items, shipping, transaction} = order;
            this.setState({
                order,
                items,
                shipping,
                transaction,
                isLoading: false
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
        const {items, order} = this.state;
        let itemContents = items.map((item, index) => {
            return (
                <TouchableOpacity activeOpacity={1} key={index.toString()}>
                    <View key={index.toString()} style={css.itemBox}>
                        <CacheImage source={{uri: item.thumb}} style={css.itemImage}/>
                        <View style={css.itemTitleView}>
                            <Text style={css.itemTitle}>{item.title}</Text>
                            {
                                item.sku_id ?
                                    <Text style={{fontSize: 12, color: '#666', marginTop: 5}}>{item.sku_title}</Text>
                                    : null
                            }
                        </View>
                        <View style={css.itemData}>
                            <Text style={css.itemPrice}>￥{item.price}</Text>
                            <Text style={css.itemQuantity}>x{item.quantity}</Text>
                        </View>
                    </View>
                </TouchableOpacity>
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
                        <Text style={css.detailLabel}>￥{order.goods_fee}</Text>
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
                        <Text style={[css.detailLabel, {color: '#f00', fontSize: 14}]}>￥{order.total_fee}</Text>
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
                    <Text style={{fontSize: 12, color: '#777', padding: 3}}>交易流水: {transaction.transaction_no}</Text>
                    :
                    null
                }
            </View>
        );
    };

    confirmOrder = () => {
        const {order_id} = this.state.order;
        Alert.alert(null, '请确认你收到的货物完好，以免钱财两空', [
            {text: '取消', onPress: () => null},
            {
                text: '确定',
                onPress: () => {
                    this.setState({
                        showSpinner: true,
                    });
                    ApiClient.post('/bought/confirm', {order_id}).then(response => {
                        this.fetchData();
                        Toast.show('收货成功');
                    }).catch(() => {
                        this.setState({
                            showSpinner: false,
                        });
                    });
                }
            }
        ]);
    };

    payOrder = () => {
        const {order_id} = this.state.order;
        ApiClient.get('/alipay/sign', {order_id}).then(response => {
            //console.log(response.data);
            Alipay.pay(response.data.payStr).then((data) => {
                //console.log(data)
                this.fetchData();
            }, (resean) => {
                console.log(resean);
            });
        });
    };

    cancelOrder = () => {
        const {order_id} = this.state.order;
        Alert.alert(null, '你确认要取消此订单吗?', [
            {text: '取消', onPress: () => null},
            {
                text: '确定',
                onPress: () => {
                    ApiClient.post('/bought/close', {order_id}).then(response => {
                        this.fetchData();
                    });
                }
            }
        ]);
    };

    noticeOrder = () => {

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

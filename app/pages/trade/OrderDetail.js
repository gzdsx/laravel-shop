import React from 'react';
import {View, Text, Image, ScrollView, StyleSheet, TouchableOpacity, Alert} from 'react-native';
import {LoadingView, Spinner} from "react-native-gzdsx-elements";
import {Toast} from 'react-native-gzdsx-elements';
import Icon from "react-native-vector-icons/AntDesign";
import FastImage from "react-native-fast-image";
import {ApiClient, Utils} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors, StatusBarStyles} from "../../styles";
import OrderActionBar from "./OrderActionBar";
import OrderActionButton from "./OrderActionButton";
import {SafeFooter} from "../../components/SafeView";
import {ListItem} from "react-native-elements";
import ImageIcon from "../../components/ImageIcon";
import CartActions from "../ecom/CartActions";

const getStatusIcon = (status) => {
    let icon;
    switch (status) {
        case 0:
            icon = require('../../images/trade/waitPay.png');
            break;
        case 1:
            icon = require('../../images/trade/waitSend.png');
            break;
        case 2:
            icon = require('../../images/trade/send.png');
            break;
        case 3:
            icon = require('../../images/trade/received.png');
            break;
        case 10:
            icon = require('../../images/trade/refunding.png');
            break;
        case 20:
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

    /**
     * 查询订单数据
     */
    fetchData = () => {
        const {order_id} = this.props.route.params;
        ApiClient.get('/trade/bought.getInfo', {order_id}).then(response => {
            const order = response.result;
            const {items, shipping, transaction} = order;
            this.setState({
                order,
                items,
                shipping,
                transaction,
                loading: false
            });
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    };

    fetchReasons = () => {
        ApiClient.get('/ecom/order.close.reasons').then(response => {
            this.setState({reasons: response.result.items});
        });
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        this.fetchData();
        this.fetchReasons();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        const {order, loading} = this.state;
        if (loading) return <LoadingView/>;

        const {order_id, order_state, shipping_state} = order;
        return (
            <View style={{flex: 1}}>
                <ScrollView>
                    {this.renderTradeStatus()}
                    {this.renderShippingAddress()}
                    {this.renderContent()}
                    {this.renderOrderInfo()}
                </ScrollView>
                <View style={{backgroundColor: '#fff'}}>
                    <OrderActionBar
                        order={order}
                        reasons={this.state.reasons}
                        style={{backgroundColor: '#fff', height: 49}}
                        onCancel={this.fetchData}
                        onPaySucceed={this.fetchData}
                        onPayFailed={() => {

                        }}
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
                    <SafeFooter/>
                </View>
                <Spinner ref={'spinner'}/>
                <Toast ref={'toast'}/>
            </View>
        );
    }

    /**
     * 渲染订单状态
     * @returns {*}
     */
    renderTradeStatus = () => {
        const {order} = this.state;
        return (
            <View style={styles.stateContainer}>
                <View style={{
                    flex: 1,
                    alignItems: 'flex-start',
                    justifyContent: 'center'
                }}>
                    <Text style={styles.stateText}>{order.state_des}</Text>
                </View>
                <Image
                    source={getStatusIcon(order.order_state)}
                    style={styles.stateIcon}
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
            <View style={styles.shippingContainer}>
                <View style={[styles.flexCenter, {marginRight: 10}]}>
                    <Icon
                        name={"enviromento"}
                        size={22}
                        color={"#666"}
                    />
                </View>
                <View style={{flex: 1}}>
                    <View style={styles.flexRow}>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333',
                            marginRight: 10
                        }}>收货人: {shipping.name}</Text>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333',
                            textAlign: 'right'
                        }}>{shipping.phone}</Text>
                    </View>
                    <Text
                        style={{
                            fontSize: 14,
                            fontWeight: '400',
                            color: '#333',
                            marginTop: 5
                        }}
                        numberOfLines={2}
                    >收货地址: {shipping.formatted_address}</Text>
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

        return (
            <View style={{backgroundColor: '#fff'}}>
                <ListItem containerStyle={styles.shopContainer}>
                    <ListItem.Content style={{flexDirection: 'row', justifyContent: 'flex-start'}}>
                        <ImageIcon
                            source={require('../../images/icon/shop.png')}
                            size={20} color={"#555"}
                            style={{marginRight: 3}}
                        />
                        <ListItem.Title style={styles.shopName}>{order.shop_name}</ListItem.Title>
                    </ListItem.Content>
                </ListItem>
                <View style={{paddingTop: 5, paddingBottom: 5, backgroundColor: '#fff'}}>
                    {
                        items.map((item, index) => (
                            <View key={index.toString()}>
                                <TouchableOpacity activeOpacity={1}>
                                    <View style={styles.itemBox}>
                                        <FastImage source={{uri: item.thumb}} style={styles.itemImage}/>
                                        <View style={styles.itemTitleView}>
                                            <Text style={styles.itemTitle}>{item.title}</Text>
                                            {
                                                item.sku_id ?
                                                    <Text
                                                        style={{
                                                            fontSize: 12,
                                                            color: '#666',
                                                            marginTop: 5
                                                        }}>{item.sku_title}</Text>
                                                    : null
                                            }
                                        </View>
                                        <View style={styles.itemData}>
                                            <Text style={styles.itemPrice}>￥{item.price}</Text>
                                            <Text style={styles.itemQuantity}>x{item.quantity}</Text>
                                        </View>
                                    </View>
                                </TouchableOpacity>
                                <View style={{flexDirection: 'row', padding: 10, justifyContent: 'flex-end'}}>
                                    <OrderActionButton title={"加入购物车"} onPress={() => {
                                        CartActions.addToCart(item.itemid, item.sku_id, 1).then(() => {
                                            Toast.success('已成功加入购物车');
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
                        ))
                    }
                </View>
                <View style={{backgroundColor: '#fff', padding: 10}}>
                    <View style={styles.row}>
                        <Text style={styles.textLabel}>商品总价</Text>
                        <Text style={styles.detailLabel}>￥{order.product_fee}</Text>
                    </View>
                    <View style={styles.row}>
                        <Text style={styles.textLabel}>运费</Text>
                        <Text style={styles.detailLabel}>+￥{order.shipping_fee}</Text>
                    </View>
                    <View style={styles.row}>
                        <Text style={styles.textLabel}>优惠</Text>
                        <Text style={styles.detailLabel}>-￥{order.discount_fee}</Text>
                    </View>
                    <View style={styles.row}>
                        <Text style={styles.textLabel}>实付款</Text>
                        <Text style={[styles.detailLabel, {color: '#f00', fontSize: 14}]}>￥{order.order_fee}</Text>
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
                <Text style={styles.orderInfoText}>订单编号: {order.order_no}</Text>
                <Text style={styles.orderInfoText}>创建时间: {order.created_at}</Text>
                {order.pay_state ?
                    <>
                        <Text style={styles.orderInfoText}>付款方式: {order.pay_type_des}</Text>
                        <Text style={styles.orderInfoText}>付款时间: {order.pay_at}</Text>
                    </>
                    :
                    null
                }
            </View>
        );
    };
}

const styles = StyleSheet.create({
    flexRow: {
        flexDirection: 'row'
    },
    flexCenter: {
        justifyContent: 'center',
        alignItems: 'center'
    },
    stateContainer: {
        backgroundColor: Colors.primary,
        paddingVertical: 20,
        paddingLeft: 20,
        paddingRight: 30,
        flexDirection: 'row'
    },
    stateText: {
        fontSize: 18,
        fontWeight: '500',
        color: '#fff'
    },
    stateIcon: {
        width: 60,
        height: 60,
        tintColor: '#fff'
    },
    shippingContainer: {
        flexDirection: 'row',
        paddingHorizontal: 10,
        paddingVertical: 20,
        backgroundColor: '#fff',
        marginBottom: 10
    },
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
    },
    orderInfoText: {
        fontSize: 12,
        color: '#777',
        padding: 5
    },
    shopContainer: {
        paddingHorizontal: 10,
        borderBottomColor: '#f2f2f2',
        borderBottomWidth: 0.5
    },
    shopName: {
        fontSize: 16,
        color: '#333'
    },
});

import React from 'react';
import {View, Text, ScrollView, TouchableOpacity, InteractionManager} from 'react-native';
import ActionSheet from 'react-native-actionsheet';
import {Ticon} from "react-native-ticon";
import {LoadingView,TableCellGroup,TableCell} from "react-native-dsxui";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {ApiClient, Utils} from "../../utils";
import {CustomTextInput} from "../../components";
import ShippingAddress from "../../components/ShippingAddress";
import {whiteNavigationConfigure} from "../../base/navconfig";

export default class Settlement extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...whiteNavigationConfigure(navigation),
        headerTitle: '确认订单'
    });

    constructor(props) {
        super(props);
        this.state = {
            carts: [],
            isLoading: true,
            address: null,
            shipping_type: 1,
            pay_type: 1,
            buyer_message: {},
            totalFee: 0,
            totalShippingFee: 0,
        };
        this.submiting = false;
        this.order_data = [];
    }

    render() {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    {this.renderAddress()}
                    {this.renderContent()}
                    {this.renderShippingType()}
                </ScrollView>
                {this.renderFooter()}
                <ActionSheet
                    ref={o => this.ActionSheet1 = o}
                    options={['快递', '物流', '上门自取', '取消']}
                    cancelButtonIndex={3}
                    onPress={(index) => {
                        if (index !== 3) {
                            this.setState({shipping_type: (index + 1)});
                        }
                    }}
                />
                <ActionSheet
                    ref={o => this.ActionSheet2 = o}
                    options={['在线支付', '货到付款', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index !== 2) {
                            this.setState({pay_type: (index + 1)});
                        }
                    }}
                />
            </View>
        );
    }

    componentDidMount() {
        this.listener = this.props.navigation.addListener('willFocus', () => {
            Utils.setStatusBarStyle();
        });

        InteractionManager.runAfterInteractions(() => {
            ApiClient.get('/address/get').then(response => {
                if (response.data.address) {
                    this.setState({
                        address: response.data.address,
                        isLoading: false
                    });
                } else {
                    this.props.navigation.navigate('AddressSelector', {
                        callback: (address) => {
                            this.setState({address, isLoading: false});
                        }
                    });
                }
            });

            const itemids = this.props.navigation.getParam('itemids', []);
            ApiClient.post('/cart/get_items', {itemids}).then(response => {
                //console.log(response.data.items);
                let carts = response.data.items;
                let totalFee = 0;
                let totalShippingFee = 0;
                let buyer_message = this.state.buyer_message;
                carts.forEach((cart) => {
                    cart.totalNum = 0;
                    cart.totalFee = 0;
                    cart.shippingFee = 0;

                    let order = {
                        shop_id: cart.shop.shop_id,
                        shop_name: cart.shop.shop_name,
                        shipping_type: 1,
                        pay_type: 1,
                        buyer_message: '',
                        items: []
                    };
                    cart.items.map((item) => {
                        cart.totalNum += item.quantity;
                        cart.totalFee += item.price * item.quantity;
                        //cart.shippingFee += item.shipping_fee;
                        order.items.push(item.itemid);
                    });
                    totalShippingFee += cart.shippingFee;
                    totalFee += cart.totalFee + cart.shippingFee;
                    this.order_data.push(order);
                });
                this.setState({
                    carts,
                    totalFee,
                    totalShippingFee,
                    buyer_message,
                    isLoading: false
                });
            });
        });
    }

    componentWillUnmount() {
        this.listener.remove();
    }

    getShippingTypeText = () => {
        const {shipping_type} = this.state;
        if (shipping_type === 1) {
            return '快递';
        } else if (shipping_type === 2) {
            return '物流配送';
        } else {
            return '上门自取';
        }
    };

    getPayTypeText = () => {
        const {pay_type} = this.state;
        if (pay_type === 1) {
            return '在线支付';
        } else {
            return '货到付款';
        }
    };

    renderAddress = () => {
        if (this.state.address) {
            return <ShippingAddress data={this.state.address} onPress={() => {
                this.props.navigation.navigate('AddressSelector', {
                    callback: (address) => {
                        this.setState({address});
                    }
                });
            }}/>
        } else {
            return null;
        }
    };

    renderContent = () => {
        if (this.state.carts.length === 0) return null;
        let contents = this.state.carts.map((cart) => {
            let itemContents = cart.items.map((item) => {
                return (
                    <TableCell key={item.itemid.toString()}>
                        <CacheImage
                            source={{uri: item.thumb}}
                            style={{
                                width: 80,
                                height: 80,
                                borderRadius: 3,
                                marginRight: 10
                            }}
                        />
                        <View style={{flex: 1}}>
                            <Text style={{
                                fontSize: 16,
                                color: '#333',
                            }} numberOfLines={2}>{item.title}</Text>
                            <View style={{
                                flexDirection: 'row',
                                marginTop: 10
                            }}>
                                <Text style={{
                                    color: '#f00',
                                    fontSize: 16,
                                    fontWeight: '600',
                                    flex: 1
                                }}>￥{item.price}</Text>
                                <Text style={{
                                    fontSize: 14,
                                    color: '#333'
                                }}>x{item.quantity}</Text>
                            </View>
                        </View>
                    </TableCell>
                )
            });

            const shop = cart.shop;
            return (
                <TableCellGroup style={{marginTop: 10}} key={shop.shop_id.toString()}>
                    <TableCell
                        icon={<Ticon name={"shop"} size={16} color={"#666"} style={{marginRight: 5}}/>}
                        title={shop.shop_name}
                    />
                    {itemContents}
                    <TableCell>
                        <View style={{
                            alignContent: 'center',
                            justifyContent: 'center',
                            marginRight: 10
                        }}
                        >
                            <Text style={{
                                fontSize: 16,
                                color: '#000',
                                textAlignVertical: 'center'
                            }}>给卖家留言</Text>
                        </View>
                        <View style={{flex: 1}}>
                            <CustomTextInput
                                placeholder={"选填,对本次交易的说明"}
                                style={{
                                    fontSize: 14
                                }}
                                onChangeText={(text) => this.onMessageChange(shop, text)}
                            />
                        </View>
                    </TableCell>
                    <TableCell>
                        <Text style={{
                            fontSize: 12,
                            color: '#333',
                            textAlign: 'right',
                            flex: 1
                        }}>总计{cart.totalNum}件商品 小计:￥{cart.totalFee}元(含运费:{cart.shippingFee.toFixed(2)})</Text>
                    </TableCell>
                </TableCellGroup>
            );
        });
        return (
            <View>{contents}</View>
        );
    };

    renderShippingType = () => {
        return (
            <TableCellGroup>
                <TableCell
                    title={"配送方式"}
                    detail={this.getShippingTypeText()}
                    isLink={true}
                    onPress={() => this.ActionSheet1.show()}
                />
                <TableCell
                    title={"付款方式"}
                    detail={this.getPayTypeText()}
                    isLink={true}
                    onPress={() => this.ActionSheet2.show()}
                />
            </TableCellGroup>
        );
    };

    renderFooter = () => {
        return (
            <View style={{
                backgroundColor: '#fff',
                height: 49,
                borderTopColor: '#e5e5e5',
                borderTopWidth: 0.5,
                flexDirection: 'row'
            }}>
                <View style={{flex: 1, flexDirection: 'row'}}>
                    <Text style={{
                        fontSize: 16,
                        color: '#333',
                        textAlign: 'right',
                        flex: 1,
                        lineHeight: 49
                    }}>总计:</Text>
                    <Text style={{
                        color: '#f00',
                        fontSize: 16,
                        fontWeight: '600',
                        lineHeight: 49,
                        paddingRight: 20,
                        paddingLeft: 5
                    }}>￥{this.state.totalFee.toFixed(2)}</Text>
                </View>
                <TouchableOpacity activeOpacity={1} onPress={this.submit}>
                    <View style={{
                        paddingLeft: 20,
                        paddingRight: 20,
                        alignSelf: 'center',
                        backgroundColor: '#FC461E',
                        flex: 1
                    }}>
                        <Text style={{
                            color: '#fff',
                            fontSize: 18,
                            textAlign: 'center',
                            lineHeight: 49
                        }}>提交订单</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    };

    onMessageChange = (shop, message) => {
        let {buyer_message} = this.state;
        buyer_message[shop.shop_id] = message;
        this.setState({buyer_message});
    };

    submit = () => {
        if (this.submiting) {
            return false;
        } else {
            this.submiting = true;
        }

        ApiClient.post('/auction/settlement', {
            order_data: this.order_data,
            address_id: this.state.address.address_id
        }).then(response => {
            const {params} = this.props.navigation.state;
            if (typeof params.callback === 'function') {
                params.callback();
            }
            this.props.navigation.navigate('OrderView', {trade_state: 1, backTo: 'backTo'});
        }).catch(() => {
            this.submiting = false;
        });
    };
}

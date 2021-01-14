import React from 'react';
import {View, ScrollView, Text, TouchableOpacity, Image} from 'react-native';
import ActionSheet from 'react-native-actionsheet';
import {LoadingView, TableView, TableCell, Toast, TextField} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import ShippingAddress from "../../components/ShippingAddress";

export default class BuyNow extends React.Component {

    setNavigationOptions() {
        const {navigation, router} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '确认订单',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            address: null,
            shipping_type: 1,
            pay_type: 1,
            remark: '',
            totalFee: 0,
            isLoading: true
        };
        this.submiting = false;
    }

    render() {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    {this.renderAddress()}
                    {this.renderContent()}
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
                <Toast ref={"toast"}/>
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        const {sku, quantity} = this.props.route.params;
        this.setState({totalFee: sku.price * quantity});

        ApiClient.get('/address/get').then(response => {
            if (response.data.address) {
                this.setState({
                    address: response.data.address,
                    isLoading: false
                });
            } else {
                this.setState({
                    address: null,
                    isLoading: false
                });
            }
        });
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
        const address = this.state.address;
        if (address) {
            return (
                <ShippingAddress
                    data={address}
                    onPress={() => {
                        this.props.navigation.navigate('AddressList', {
                            callback: (address) => {
                                this.setState({address});
                            }
                        });
                    }}
                />
            );
        } else {
            return (
                <TableView>
                    <TableCell
                        style={{
                            paddingVertical: 20,
                            justifyContent: 'center'
                        }}
                        onPress={() => {
                            this.props.navigation.navigate('AddressList', {
                                callback: (address) => {
                                    this.setState({address});
                                }
                            });
                        }}
                    >
                        <Image source={require('../../images/controls/add.png')} style={{width: 20, height: 20}}/>
                        <Text style={{lineHeight: 20, fontSize: 16, marginLeft: 5}}>添加收货地址</Text>
                    </TableCell>
                </TableView>
            )
        }
    };

    renderContent = () => {
        const {item, sku, quantity} = this.props.route.params;
        return (
            <TableView style={{marginTop: 10}}>
                <TableCell>
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
                            fontSize: 14,
                            color: '#333',
                        }} numberOfLines={2}>{item.title}</Text>
                        {
                            sku.sku_id ?
                                <View style={{flexDirection: 'row', marginTop: 5}}>
                                    <TouchableOpacity style={{
                                        backgroundColor: '#f2f2f2',
                                        paddingHorizontal: 5,
                                        paddingVertical: 3,
                                        borderRadius: 5
                                    }}>
                                        <Text style={{fontSize: 12, color: '#555'}}>{sku.title}</Text>
                                    </TouchableOpacity>
                                </View>
                                : null
                        }
                        <View style={{
                            flexDirection: 'row',
                            marginTop: 5
                        }}>
                            <Text style={{
                                color: '#f00',
                                fontSize: 14,
                                fontWeight: '500',
                                flex: 1
                            }}>￥{item.price}</Text>
                            <Text style={{
                                fontSize: 14,
                                color: '#333'
                            }}>x{quantity}</Text>
                        </View>
                    </View>
                </TableCell>
                <TableCell onPress={() => this.ActionSheet1.show()}>
                    <TableCell.Title title={"配送方式"}/>
                    <TableCell.Detail text={this.getShippingTypeText()}/>
                    <TableCell.Accessory/>
                </TableCell>
                <TableCell onPress={() => this.ActionSheet2.show()}>
                    <TableCell.Title title={"付款方式"}/>
                    <TableCell.Detail text={this.getPayTypeText()}/>
                    <TableCell.Accessory/>
                </TableCell>
                <TextField
                    label={"给卖家留言"}
                    placeholder={"选填,对本次交易的说明"}
                    style={{paddingHorizontal: 15}}
                    onChangeText={(text) => this.setState({remark: text})}
                    labelContainerStyle={{width: 95}}
                    inputStyle={{fontSize: 14}}
                />
            </TableView>
        );
    };

    renderFooter = () => {
        const {quantity} = this.props.route.params;
        return (
            <View style={{
                backgroundColor: '#fff',
                height: 49,
                borderTopColor: '#e5e5e5',
                borderTopWidth: 0.5,
                flexDirection: 'row'
            }}>
                <View style={{flex: 1, flexDirection: 'row', paddingHorizontal: 10}}>
                    <Text style={{
                        fontSize: 14,
                        color: '#333',
                        lineHeight: 49
                    }}>共{quantity}件商品，总计:</Text>
                    <Text style={{
                        color: '#f00',
                        fontSize: 15,
                        lineHeight: 49,
                    }}>￥{this.state.totalFee.toFixed(2)}</Text>
                </View>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={this.submit}
                    style={{paddingVertical: 5, paddingHorizontal: 10}}
                >
                    <View style={{
                        paddingLeft: 20,
                        paddingRight: 20,
                        backgroundColor: '#FC461E',
                        flex: 1,
                        borderRadius: 20,
                        flexDirection:'row',
                        justifyContent:'center',
                        alignItems:'center'
                    }}>
                        <Text style={{
                            color: '#fff',
                            fontSize: 16,
                            textAlign: 'center',
                        }}>提交订单</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    };

    submit = () => {
        const {item, sku, quantity} = this.props.route.params;
        const {shipping_type, pay_type, remark, address} = this.state;

        if (!address) {
            this.refs.toast.show('请选择收货地址');
            return false;
        }

        if (this.submiting) {
            return false;
        } else {
            this.submiting = true;
        }

        ApiClient.post('/order/create', {
            itemid: item.itemid,
            sku_id: sku.sku_id || 0,
            shipping_type,
            pay_type,
            remark,
            quantity,
            address_id: address.address_id
        }).then(response => {
            const order_id = response.data.order.order_id;
            this.props.navigation.replace('OrderDetail', {order_id});
        }).catch((err) => {
            this.submiting = false;
        });
    }
}

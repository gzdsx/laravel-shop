import React from 'react';
import {View, Text, ScrollView, TouchableOpacity, InteractionManager, DeviceEventEmitter} from 'react-native';
import ActionSheet from 'react-native-actionsheet';
import {LoadingView, TableCellGroup, TableCell} from "react-native-dsxui";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {ApiClient, Utils} from "../../utils";
import {CustomTextInput} from "../../components";
import ShippingAddress from "../../components/ShippingAddress";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CartDidChangedNotification} from "../../base/constants";

export default class ConfirmOrder extends React.Component {
    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '确认订单'
        });
    };

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isLoading: true,
            address: null,
            shipping_type: 1,
            pay_type: 1,
            remark: null,
            totalCount: 0,
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
        this.setNavigationOptions();
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

            const items = this.props.route.params.items;
            let totalFee = 0;
            let totalCount = 0;
            items.map((item) => {
                totalFee += item.price * item.quantity;
                totalCount += item.quantity;
            });

            this.setState({totalFee, totalCount});
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
        if (this.state.address) {
            return <ShippingAddress data={this.state.address} onPress={() => {
                this.props.navigation.navigate('AddressList', {
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
        const items = this.props.route.params.items;
        let itemContents = items.map((item) => {
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
                            fontSize: 14,
                            color: '#333',
                        }} numberOfLines={2}>{item.title}</Text>
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
                        <View style={{
                            flexDirection: 'row',
                            marginTop: 10
                        }}>
                            <Text style={{
                                color: '#f00',
                                fontSize: 16,
                                fontWeight: '500',
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


        return (
            <TableCellGroup>
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
                            onChangeText={(text) => {
                                this.setState({remark: text});
                            }}
                        />
                    </View>
                </TableCell>
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
                <View style={{flex: 1, flexDirection: 'row', paddingHorizontal: 10}}>
                    <Text style={{
                        fontSize: 14,
                        color: '#333',
                        lineHeight: 49
                    }}>共{this.state.totalCount}件商品, 总计:</Text>
                    <Text style={{
                        color: '#f00',
                        fontSize: 14,
                        lineHeight: 49,
                    }}>￥{this.state.totalFee.toFixed(2)}</Text>
                </View>
                <TouchableOpacity activeOpacity={1} onPress={this.submit}>
                    <View style={{
                        paddingHorizontal: 20,
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

    submit = () => {
        if (this.submiting) {
            return false;
        } else {
            this.submiting = true;
        }

        const items = this.props.route.params.items.map((item) => item.itemid);
        const address_id = this.state.address.address_id;
        const {pay_type, shipping_type, remark} = this.state;

        ApiClient.post('/order/settlement', {
            items,
            address_id,
            remark,
            pay_type,
            shipping_type
        }).then(response => {
            DeviceEventEmitter.emit(CartDidChangedNotification);
            const order_id = response.data.order.order_id;
            this.props.navigation.replace('OrderDetail', {order_id});
        }).catch(() => {
            this.submiting = false;
        });
    };
}

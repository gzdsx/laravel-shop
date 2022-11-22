import React from 'react';
import {
    View,
    Text,
    ScrollView,
    TouchableOpacity,
    InteractionManager,
    DeviceEventEmitter,
    Image,
    StyleSheet
} from 'react-native';
import ActionSheet from 'react-native-actionsheet';
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CartDidChangedNotification} from "../../base/constants";
import {StatusBarStyles} from "../../styles";
import {ListItem} from "react-native-elements";
import FastImage from "react-native-fast-image";
import Icon from "react-native-vector-icons/AntDesign";
import {SafeFooter} from "../../components/SafeView";

const shippingTypes = ['快递', '到店自取'];
const payTypes = ['在线支付', '货到付款'];
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
            loading: true,
            address: null,
            shipping_type: 1,
            pay_type: 1,
            remark: null,
            product_fee: 0,
            shipping_fee: 0,
            discount_fee: 0,
            order_fee: 0,
            total_count: 0,
            dataList: [],
            payType: '在线支付',
            shippingType: '快递'
        };
        this.submiting = false;
        this.order_data = [];
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        this.listener = DeviceEventEmitter.addListener('onChooseAddress', address => {
            this.setState({address});
        });

        InteractionManager.runAfterInteractions(() => {
            ApiClient.get('/user/address.getInfo').then(response => {
                const address = response.result;
                this.setState({address});
            });

            const ids = this.props.route.params?.ids || [];
            ApiClient.post('/ecom/cart.confirm', {ids}).then(response => {
                //const {items, product_fee, shipping_fee, discount_fee, order_fee, total_count} = response.result;
                let dataList = response.result;
                this.setState({
                    dataList,
                    loading: false
                }, this.caculate);
            });
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
        this.listener.remove();
    }

    caculate = () => {
        let totalCount = 0;
        let totalFee = 0;
        this.state.dataList.map((data) => {
            data.items.map(item => {
                totalFee += item.quantity;
                totalFee += item.price * item.quantity
            });
        });

        this.setState({total_count: totalCount, order_fee: totalFee});
    }

    render() {
        if (this.state.loading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    {this.renderAddress()}
                    {this.renderContent()}
                </ScrollView>
                {this.renderFooter()}
                <ActionSheet
                    ref={o => this.ActionSheet1 = o}
                    options={shippingTypes.concat('取消')}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index < 2) {
                            this.setState({
                                shippingType: shippingTypes[index],
                                shipping_type: index + 1
                            });
                        }
                    }}
                />
                <ActionSheet
                    ref={o => this.ActionSheet2 = o}
                    options={payTypes.concat('取消')}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index < 2) {
                            this.setState({
                                payType: payTypes[index],
                                pay_type: index + 1
                            });
                        }
                    }}
                />
            </View>
        );
    }

    renderAddress = () => {
        let {address} = this.state;
        let {navigation} = this.props;
        if (address) {
            return (
                <ListItem
                    containerStyle={styles.addressContainer}
                    onPress={() => {
                        navigation.navigate('address-admin', {choose: true});
                    }}
                >
                    <Icon
                        name={"enviromento"}
                        size={22}
                        color={"#666"}
                    />
                    <ListItem.Content>
                        <ListItem.Title style={styles.addressName}>{address.name}{'  '}{address.phone}</ListItem.Title>
                        <ListItem.Subtitle style={styles.addressDetail}>{address.formatted_address}</ListItem.Subtitle>
                    </ListItem.Content>
                    <ListItem.Chevron/>
                </ListItem>
            );
        } else {
            return (
                <ListItem
                    containerStyle={styles.addressContainer}
                    onPress={() => {
                        navigation.navigate('address-admin', {choose: true});
                    }}
                >
                    <View style={{flexDirection: 'row', justifyContent: 'center', alignItems: 'center', flex: 1}}>
                        <Icon name={'plus'} size={20} color={"#333"}/>
                        <Text style={{lineHeight: 20, fontSize: 16, marginLeft: 5, color: '#333'}}>添加收货地址</Text>
                    </View>
                </ListItem>
            )
        }
    };

    renderContent = () => {
        const {dataList, payType, shippingType} = this.state;
        let itemContents = dataList.map((data, index) => (
            <View style={{marginTop: 10}} key={index.toString()}>
                <ListItem>
                    <ListItem.Title>{data.shop.shop_name}</ListItem.Title>
                </ListItem>
                {
                    data.items.map((item, index) => (
                        <ListItem key={index.toString()}>
                            <FastImage
                                source={{uri: item.thumb}}
                                style={{
                                    width: 80,
                                    height: 80,
                                    borderRadius: 3,
                                    marginRight: 10
                                }}
                            />
                            <ListItem.Content>
                                <View style={{flex: 1}}>
                                    <Text style={{fontSize: 14, color: '#333'}} numberOfLines={2}>{item.title}</Text>
                                    {
                                        item.sku_title ?
                                            <View style={{flexDirection: 'row', marginTop: 5}}>
                                                <TouchableOpacity style={{
                                                    backgroundColor: '#f2f2f2',
                                                    paddingHorizontal: 5,
                                                    paddingVertical: 3,
                                                    borderRadius: 5
                                                }}>
                                                    <Text style={{
                                                        fontSize: 12,
                                                        color: '#555'
                                                    }}>{item.sku_title || ''}</Text>
                                                </TouchableOpacity>
                                            </View>
                                            : null
                                    }
                                    <View style={{flex: 1}}/>
                                    <View style={{flexDirection: 'row', marginTop: 10}}>
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
                            </ListItem.Content>
                        </ListItem>
                    ))
                }
            </View>
        ));


        return (
            <View>
                {itemContents}
                <ListItem onPress={() => this.ActionSheet1.show()}>
                    <ListItem.Content>
                        <ListItem.Title style={styles.label}>配送方式</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle style={styles.value}>{shippingType}</ListItem.Subtitle>
                    <ListItem.Chevron/>
                </ListItem>
                <ListItem onPress={() => this.ActionSheet2.show()}>
                    <ListItem.Content>
                        <ListItem.Title style={styles.label}>付款方式</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle style={styles.value}>{payType}</ListItem.Subtitle>
                    <ListItem.Chevron/>
                </ListItem>
                <ListItem>
                    <ListItem.Title style={styles.label}>给卖家留言</ListItem.Title>
                    <ListItem.Input
                        inputStyle={styles.input}
                        placeholder={"选填,对本次交易的说明"}
                        onChangeText={(text) => this.setState({remark: text})}
                    />
                </ListItem>
            </View>
        );
    };

    renderFooter = () => {
        const {order_fee, total_count} = this.state;
        return (
            <View style={{backgroundColor: '#fff'}}>
                <View style={{
                    borderTopColor: '#e5e5e5',
                    borderTopWidth: 0.5,
                    flexDirection: 'row'
                }}>
                    <View style={{flex: 1, flexDirection: 'row', paddingHorizontal: 10}}>
                        <Text style={{
                            fontSize: 14,
                            color: '#333',
                            lineHeight: 49
                        }}>共{total_count}件商品, 总计:</Text>
                        <Text style={{
                            color: '#f00',
                            fontSize: 14,
                            lineHeight: 49,
                        }}>￥{order_fee}</Text>
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
                            flexDirection: 'row',
                            justifyContent: 'center',
                            alignItems: 'center'
                        }}>
                            <Text style={{
                                color: '#fff',
                                fontSize: 14,
                                textAlign: 'center',
                            }}>提交订单</Text>
                        </View>
                    </TouchableOpacity>
                </View>
                <SafeFooter/>
            </View>
        );
    };

    submit = () => {
        const {pay_type, shipping_type, remark, address} = this.state;
        if (!address) {
            Toast.fail('请选择收货地址');
            return false;
        }

        const ids = this.props.route.params?.ids || [];
        if (ids.length === 0) {
            Toast.fail('请选择要结算的商品');
            return false;
        }

        if (this.submiting) {
            return false;
        } else {
            this.submiting = true;
        }

        ApiClient.post('/ecom/cart.settlement', {
            ids,
            remark,
            pay_type,
            shipping_type,
            address
        }).then(response => {
            //const {order_id} = response.result;
            this.props.navigation.replace('trade-order-list');
        }).catch(reason => {
            this.submiting = false;
            Toast.fail(reason.errMsg);
        });
    };
}

const styles = StyleSheet.create({
    addressName: {
        fontSize: 16,
        color: '#666'
    },
    addressDetail: {
        fontSize: 14,
        color: '#666',
        marginTop: 5
    },
    addressContainer: {
        paddingVertical: 20
    },
    label: {
        fontSize: 14,
        color: '#333'
    },
    value: {
        fontSize: 14,
        color: '#838383'
    },
    input: {
        fontSize: 14,
        textAlign: 'left'
    }
})

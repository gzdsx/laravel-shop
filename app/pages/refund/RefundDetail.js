import React from 'react';
import {Alert, ScrollView, Text, TouchableOpacity, View} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import FastImage from "react-native-fast-image";
import {ListItem} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {SafeFooter} from "../../components/SafeView";

export default class RefundDetail extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '退款详情',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            refund: {},
            loading: true
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        const {refund_id} = this.props.route.params;
        ApiClient.get('/trade/refund.getInfo', {refund_id}).then(response => {
            const {refund, trade, order} = response.result;
            this.setState({
                refund,
                trade,
                order,
                loading: false
            });
        });
    }

    render(): React.ReactNode {
        const {refund, loading} = this.state;
        const {trade, shipping, refund_id, refund_amount} = refund;
        if (loading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <ListItem>
                        <ListItem.Content>
                            <Text style={{
                                fontSize: 18,
                                fontWeight: '800',
                                color: '#f40'
                            }}>{refund.refund_state_des}</Text>
                            <View style={{flexDirection: 'row', marginTop: 15, marginRight: 45}}>
                                <Text style={{fontSize: 12, color: '#999', marginRight: 10}}>重要提示</Text>
                                <Text style={{fontSize: 12, color: '#999'}}>
                                    您好，卖家需要一定时间处理你的申请，你还可以主动联系卖家，要求尽快处理退款。
                                </Text>
                            </View>
                        </ListItem.Content>
                    </ListItem>
                    <View style={{height: 10}}/>
                    <ListItem containerStyle={{borderBottomWidth: 0.5, borderBottomColor: '#e5e5e5'}}>
                        <ListItem.Title>退款货品/协议</ListItem.Title>
                    </ListItem>
                    {this.renderItems()}
                    <ListItem>
                        <ListItem.Content>
                            {this.renderMeta('服务类型', refund.refund_type_des)}
                            {this.renderMeta('退款单号', refund.refund_no)}
                            {this.renderMeta('申请时间', refund.created_at)}
                            {this.renderMeta('退款原因', refund.refund_reason)}
                            {this.renderMeta('是否收货', refund.goods_state_des)}
                            {this.renderMeta('退款金额', '￥' + refund.refund_amount)}
                            {this.renderMeta('退款说明', refund.refund_desc)}
                        </ListItem.Content>
                    </ListItem>
                    {refund.shipping_state === 1 && this.renderShipping()}
                </ScrollView>
                {this.renderBottom()}
            </View>
        );
    }

    renderItems = () => {
        let {trade} = this.state.refund;
        return (
            <ListItem>
                <FastImage source={{uri: trade.image}} style={{
                    width: 80,
                    height: 80,
                    borderRadius: 3,
                    marginRight: 10
                }}/>
                <ListItem.Content>
                    <Text style={{fontSize: 14, color: '#333'}}>{trade.title}</Text>
                    <View style={{flex: 1}}>
                        <Text style={{fontSize: 12, color: '#777'}}>{trade.sku_title}</Text>
                    </View>
                    <View style={{flexDirection: 'row'}}>
                        <Text style={{fontSize: 12, color: '#999', flex: 1}}>￥{trade.price}</Text>
                        <Text style={{fontSize: 12, color: '#999'}}>退款数量:{trade.quantity}</Text>
                    </View>
                </ListItem.Content>
            </ListItem>
        )
    }

    renderMeta = (title, value) => {
        return (
            <View style={{
                flexDirection: 'row',
                paddingVertical: 10,
            }}>
                <View style={{width: 80}}>
                    <Text style={{fontSize: 12, color: '#888'}}>{title}</Text>
                </View>
                <View style={{flex: 1}}>
                    <Text style={{fontSize: 12, color: '#888', flexWrap: 'wrap'}}>{value}</Text>
                </View>
            </View>
        );
    }

    renderShipping = () => {
        let {shipping} = this.state.refund;
        if (!shipping) return null;
        return (
            <View style={{marginTop: 10}}>
                <ListItem containerStyle={{borderBottomWidth: 0.5, borderBottomColor: '#e5e5e5'}}>
                    <ListItem.Content>
                        <ListItem.Title>退货物流</ListItem.Title>
                    </ListItem.Content>
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        {this.renderMeta('收货人', shipping.name)}
                        {this.renderMeta('联系电话', shipping.phone)}
                        {this.renderMeta('收货地址', shipping.formatted_address)}
                    </ListItem.Content>
                </ListItem>
            </View>
        )
    }

    renderBottom = () => {
        const {refund} = this.state;
        const {refund_id, refund_state} = refund;
        if (refund_state > 4) return null;
        return (
            <View style={{backgroundColor: '#fff'}}>
                <View style={{height: 50, flexDirection: 'row'}}>
                    {refund_state < 4 && this.renderRevoke()}
                    {refund_state === 1 && this.renderEdit()}
                    {refund_state === 2 && this.renderSend()}
                </View>
                <SafeFooter/>
            </View>
        );
    }

    renderRevoke = () => {
        let {refund_id} = this.state.refund;
        return (
            <TouchableOpacity
                activeOpacity={1}
                style={{flex: 1, justifyContent: 'center', alignItems: 'center'}}
                onPress={() => {
                    Alert.alert(null, '确定要撤销退款申请吗?', [
                        {
                            text: '确定',
                            onPress: () => {
                                ApiClient.post('/trade/refund.revoke', {refund_id}).then(response => {
                                    this.props.navigation.goBack();
                                });
                            }
                        },
                        {
                            text: '取消',
                            onPress: () => null
                        }
                    ]);
                }}
            >
                <Text style={{fontSize: 14, color: '#333'}}>撤销退款</Text>
            </TouchableOpacity>
        )
    }

    /**
     * 修改协议
     * @returns {*}
     */
    renderEdit = () => {
        const {refund} = this.state;
        const {refund_id} = refund;
        return (
            <TouchableOpacity
                activeOpacity={1}
                style={{flex: 1, justifyContent: 'center', alignItems: 'center', backgroundColor: '#f00'}}
                onPress={() => {
                    this.props.navigation.replace('refund-apply', {refund_id});
                }}
            >
                <Text style={{fontSize: 14, color: '#fff'}}>修改协议</Text>
            </TouchableOpacity>
        )
    }

    renderSend = () => {
        const {refund} = this.state;
        const {refund_id} = refund;
        return (
            <TouchableOpacity
                activeOpacity={1}
                style={{flex: 1, justifyContent: 'center', alignItems: 'center', backgroundColor: '#f00'}}
                onPress={() => {
                    this.props.navigation.replace('refund-send', {refund_id});
                }}
            >
                <Text style={{fontSize: 14, color: '#fff'}}>退货</Text>
            </TouchableOpacity>
        )
    }
}

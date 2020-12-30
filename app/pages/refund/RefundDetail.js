import React from 'react';
import {ScrollView, Text, View} from 'react-native';
import {LoadingView, TableCell, TableView} from "react-native-gzdsx-elements";
import {CacheImage} from "react-native-gzdsx-cache-image";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import OrderActionButton from "../order/OrderActionButton";

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


    render(): React.ReactNode {
        const {refund, loading} = this.state;
        const {order, shipping} = refund;
        if (loading) return <LoadingView/>;
        return (
            <ScrollView style={{flex: 1}}>
                <TableView>
                    <TableCell touchAble={false}>
                        <TableCell.Content>
                            <Text style={{
                                fontSize: 18,
                                fontWeight: '800',
                                color: '#f40'
                            }}>{refund.refund_state_des}</Text>
                            <View style={{flexDirection: 'row', marginTop: 15}}>
                                <Text style={{fontSize: 12, color: '#999', marginRight: 10}}>重要提示</Text>
                                <Text style={{fontSize: 12, color: '#999'}}>
                                    您好，卖家需要一定时间处理你的申请，你还可以主动联系卖家，要求尽快处理退款。
                                </Text>
                            </View>
                        </TableCell.Content>
                    </TableCell>
                </TableView>
                <TableView>
                    <TableCell touchAble={false}>
                        <TableCell.Title title={"退款货品/协议"}/>
                    </TableCell>
                    {this.renderItems()}
                </TableView>
                <TableView>
                    {this.renderMeta('订单号', order.order_no)}
                    {this.renderMeta('退款单号', refund.refund_no)}
                    {this.renderMeta('申请时间', refund.created_at)}
                    {this.renderMeta('退款原因', refund.refund_reason)}
                    {this.renderMeta('是否收货', refund.receive_state_des)}
                    {this.renderMeta('退款金额', '￥'+refund.refund_amount)}
                    {this.renderMeta('退款说明', refund.refund_desc)}
                </TableView>
            </ScrollView>
        );
    }

    componentDidMount(): void {
        this.setNavigationOptions();

        const {refund_id} = this.props.route.params;
        ApiClient.get('/refund/get', {refund_id}).then(response => {
            console.log(response.data);
            const {refund} = response.data;
            this.setState({
                refund,
                loading: false
            })
        });
    }

    renderItems = () => {
        const {items} = this.state.refund;
        const contents = items.map((item, index) => {
            return (
                <TableCell key={index.toString()} touchAble={false}>
                    <CacheImage source={{uri: item.thumb}} style={{
                        width: 80,
                        height: 80,
                        borderRadius: 3,
                        marginRight: 10
                    }}/>
                    <View style={{flex: 1, flexDirection: 'column'}}>
                        <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                        <View style={{flex: 1}}>
                            <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                        </View>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{fontSize: 12, color: '#999', flex: 1}}>￥{item.price}</Text>
                            <Text style={{fontSize: 12, color: '#999'}}>退款数量:{item.quantity}</Text>
                        </View>
                    </View>
                </TableCell>
            )
        });

        return <View>{contents}</View>;
    }

    renderMeta = (title, value) => {
        return (
            <View style={{
                flexDirection: 'row',
                paddingVertical: 10,
                paddingHorizontal: 15
            }}>
                <Text style={{fontSize: 12, color: '#888', width: 80}}>{title}</Text>
                <Text style={{fontSize: 12, color: '#888'}}>{value}</Text>
            </View>
        );
    }
}

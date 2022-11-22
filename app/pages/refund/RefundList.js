import React from 'react';
import {View, FlatList, Text, StyleSheet, TouchableOpacity, Alert} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import FastImage from "react-native-fast-image";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import OrderActionButton from "../trade/OrderActionButton";
import ListComponent from "../../components/ListComponent";
import {StatusBarStyles} from "../../styles";

export default class RefundList extends ListComponent {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '退款/售后',
        });
    }

    listApi = '/trade/refund.getList';

    constructor(props) {
        super(props);
    }

    componentDidMount(): void {
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        })
        this.setNavigationOptions();
        this.fetchList();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        let {dataList, loading, refreshing} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <FlatList
                data={dataList}
                renderItem={this.renderItem}
                keyExtractor={(item, index) => index.toString()}
                refreshing={refreshing}
                onRefresh={this.onRefresh}
                onEndReached={this.onEndReached}
                onEndReachedThreshold={0.2}
                ListHeaderComponent={() => {
                    if (this.state.items.length === 0) {
                        return (
                            <Text style={{
                                textAlign: 'center',
                                color: '#666',
                                padding: 30
                            }}>
                                没有此类订单
                            </Text>
                        );
                    } else {
                        return null;
                    }
                }}
                ListFooterComponent={<LoadingView text="正在加载更多" show={this.state.loadMore}
                                                  style={{paddingTop: 10, paddingBottom: 10}}/>}
                style={{flex: 1}}
            />
        );
    }

    renderItem = ({item, index}) => {
        let refund = item;
        let {refund_id, order_id, items, refund_state} = refund;
        if (!refund) return null;
        return (
            <View style={styles.refund}>
                <View style={styles.content}>
                    <View style={{paddingVertical: 5}}>
                        <Text style={{fontSize: 14, color: '#333'}}>退款编号:{refund.refund_no}</Text>
                    </View>
                    {this.renderRefundItems(refund)}
                    {this.renderRefundState(refund)}
                    <View style={{flexDirection: 'row', justifyContent: 'flex-end', marginTop: 10}}>
                        <OrderActionButton
                            title={'删除记录'}
                            show={refund_state > 4}
                            onPress={() => {
                                ApiClient.post('/refund/delete', {items: [refund_id]}).then(response => {
                                    this.fetchData();
                                });
                            }}
                        />
                        <OrderActionButton
                            title={"撤销退款"}
                            onPress={() => {
                                Alert.alert(null, '确定要撤销退款申请吗?', [
                                    {
                                        text: '确定',
                                        onPress: () => {
                                            ApiClient.post('/refund/revoke', {refund_id}).then(response => {
                                                this.fetchData();
                                            });
                                        }
                                    },
                                    {
                                        text: '取消',
                                        onPress: () => null
                                    }
                                ])
                            }}
                            show={refund_state < 5}
                        />
                        <OrderActionButton title={'查看详情'} onPress={() => {
                            this.props.navigation.navigate('RefundDetail', {refund_id});
                        }}/>
                    </View>
                </View>
            </View>
        );
    };

    renderRefundItems = (refund) => {
        let contents = refund.items.map((item, index) => {
            const {order_id} = item;
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    style={styles.item}
                    key={index.toString()}
                    onPress={() => {
                        this.props.navigation.navigate('RefundDetail', {refund_id: refund.refund_id});
                    }}
                >
                    <FastImage source={{uri: item.thumb}} style={styles.thumb}/>
                    <View style={{flex: 1, flexDirection: 'column'}}>
                        <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                        <View style={{flex: 1}}>
                            <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                        </View>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{fontSize: 14, color: '#333', flex: 1}}>￥{item.price}</Text>
                            <Text style={{fontSize: 14, color: '#333'}}>x{item.quantity}</Text>
                        </View>
                    </View>
                </TouchableOpacity>
            );
        });
        return <View>{contents}</View>;
    };

    renderRefundState = (refund) => {
        const {refund_id, refund_state, refund_state_des, refund_amount} = refund;
        if (refund_state === 5) {
            return (
                <View style={styles.stateDes}>
                    <Text style={styles.stateDesText}>退款成功</Text>
                    <Text style={{fontSize: 14, color: '#333'}}>退款金额￥{refund_amount}</Text>
                </View>
            );
        }

        if (refund_state === 6) {
            return (
                <View style={styles.stateDes}>
                    <Text style={styles.stateDesText}>退款关闭</Text>
                    <Text style={{fontSize: 14, color: '#333'}}>退款关闭</Text>
                </View>
            );
        }

        return (
            <View style={styles.stateDes}>
                <Text style={styles.stateDesText}>退款中</Text>
                <Text style={{fontSize: 14, color: '#333'}}>{refund_state_des}</Text>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    refund: {
        padding: 10
    },
    content: {
        borderRadius: 5,
        backgroundColor: '#fff',
        padding: 10
    },
    stateDes: {
        backgroundColor: '#f5f5f5',
        borderRadius: 5,
        paddingVertical: 10,
        paddingHorizontal: 40,
        marginVertical: 10,
        flexDirection: 'row'
    },
    stateDesText: {
        fontSize: 14,
        color: '#333',
        fontWeight: '500',
        marginRight: 10
    },
    item: {
        paddingVertical: 10,
        flexDirection: 'row',
    },
    thumb: {
        width: 80,
        height: 80,
        marginRight: 15
    },
});

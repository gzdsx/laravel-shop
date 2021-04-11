import React from 'react';
import {View, FlatList, Text, StyleSheet, TouchableOpacity, Alert} from 'react-native';
import {CacheImage} from "react-native-gzdsx-cache-image";
import {LoadingView} from "react-native-gzdsx-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import OrderActionButton from "../order/OrderActionButton";

export default class RefundList extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '退款/售后',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            loading: true,
            refreshing: false,
            loadMore: false
        };
        this.offset = 0;
        this.loadMoreAble = false;
    }


    render(): React.ReactNode {
        if (this.state.loading) return <LoadingView/>;
        return (
            <FlatList
                data={this.state.items}
                renderItem={({item, index}) => this.renderItem(item, index)}
                keyExtractor={((item, index) => item.refund_id.toString())}
                refreshing={this.state.refreshing}
                onRefresh={this.onRefresh}
                onEndReached={this.onEndReached}
                onEndReachedThreshold={0}
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

    componentDidMount(): void {
        this.setNavigationOptions();
        this.fetchData();
    }

    fetchData = () => {
        ApiClient.get('/refund/batchget').then(response => {
            //console.log(response.result);
            const {items} = response.result;
            this.setState({
                items,
                loading: false,
                refreshing: false,
                loadMore: false
            });
            this.loadMoreAble = items.length >= 10;
        })
    }

    reLoad = () => {
        this.offset = 0;
        this.setState({
            loading: true
        }, this.fetchData);
    }

    onRefresh = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore) {
            return false;
        }
        this.offset = 0;
        this.setState({refreshing: true});
        setTimeout(this.fetchData, 500);
    };

    onEndReached = () => {

        if (this.state.loading || this.state.refreshing || this.state.loadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 10;
        this.setState({loadMore: true});
        setTimeout(this.fetchData, 500);
    };

    renderItem = (refund, index) => {
        let {refund_id, order_id, items, refund_state} = refund;
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
                    <CacheImage source={{uri: item.thumb}} style={styles.thumb}/>
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

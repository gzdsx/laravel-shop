import React from 'react';
import {
    FlatList,
    View,
    Text,
    TouchableOpacity,
    StyleSheet,
} from 'react-native';
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {ApiClient, Utils} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import OrderActionBar from "./OrderActionBar";

class OrderList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            isLoadMore: false,
            orders: [],
            order_state: 0,
            tab: 'all',
            reasons: []
        };
        this.offset = 0;
        this.loadMoreAble = false;
        this.obj = null;
        this.index = 0;
    }

    render() {
        const {reasons} = this.state;
        return (
            <View style={{flex: 1}}>
                {this.renderTabs()}
                {this.renderContent()}
                <Toast ref={'toast'}/>
            </View>
        );
    }

    UNSAFE_componentWillMount() {
        this.props.navigation.addListener('focus', () => Utils.setStatusBarStyle('light'));
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('focus');
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '我的订单'
        });

        const tab = route.params?.tab || 'all'
        this.setState({tab}, this.fetchData);
        ApiClient.get('/order/closereason/getall').then(response => {
            this.setState({reasons: response.result.items});
        });
    }

    fetchData = () => {
        const {tab} = this.state;
        ApiClient.get('/bought/batchget', {
            offset: this.offset,
            count: 10,
            tab
        }).then(response => {
            //console.log(response.result);
            let orders = this.state.orders;
            if (this.state.isLoadMore) {
                orders = orders.concat(response.result.items);
            } else {
                orders = response.result.items;
            }
            this.setState({
                orders,
                isLoadMore: false,
                isLoading: false,
                isRefreshing: false
            });
            this.loadMoreAble = response.result.items.length >= 10;
        });
    };

    reLoad = () => {
        this.offset = 0;
        this.setState({
            isLoading: true
        }, this.fetchData);
    }

    onRefresh = () => {
        if (this.state.isLoading || this.state.isRefreshing || this.state.isLoadMore) {
            return false;
        }
        this.offset = 0;
        this.setState({isRefreshing: true});
        setTimeout(this.fetchData, 500);
    };

    onEndReached = () => {

        if (this.state.isLoading || this.state.isRefreshing
            || this.state.isLoadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 10;
        this.setState({isLoadMore: true});
        setTimeout(this.fetchData, 500);
    };

    renderTabs = () => {
        const styles = StyleSheet.create({
            container: {
                flexDirection: 'row',
                backgroundColor: '#fff',
                borderBottomWidth: 0.5,
                borderBottomColor: '#e5e5e5'
            },
            tabItem: {
                flex: 1,
                flexDirection: 'column',
                alignItems: 'center',
                paddingVertical: 15
            },
            tabText: {
                textAlign: 'center',
                fontSize: 14
            },
            tabActive: {
                fontWeight: '500',
                color: '#f00'
            }
        });

        const {order_state, tab} = this.state;

        return (
            <View style={styles.container}>
                <TouchableOpacity
                    style={styles.tabItem}
                    activeOpacity={1}
                    onPress={() => this.setState({tab: 'all'}, this.reLoad)}
                >
                    <Text style={[styles.tabText, tab === 'all' && styles.tabActive]}>全部</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    style={styles.tabItem}
                    activeOpacity={1}
                    onPress={() => this.setState({tab: 'waitPay'}, this.reLoad)}
                >
                    <Text style={[styles.tabText, tab === 'waitPay' && styles.tabActive]}>待付款</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    style={styles.tabItem}
                    activeOpacity={1}
                    onPress={() => this.setState({tab: 'waitSend'}, this.reLoad)}
                >
                    <Text style={[styles.tabText, tab === 'waitSend' && styles.tabActive]}>待发货</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    style={styles.tabItem}
                    activeOpacity={1}
                    onPress={() => this.setState({tab: 'waitConfirm'}, this.reLoad)}
                >
                    <Text style={[styles.tabText, tab === 'waitConfirm' && styles.tabActive]}>待收货</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    style={styles.tabItem}
                    activeOpacity={1}
                    onPress={() => this.setState({tab: 'waitRate'}, this.reLoad)}
                >
                    <Text style={[styles.tabText, tab === 'waitRate' && styles.tabActive]}>待评价</Text>
                </TouchableOpacity>
            </View>
        );
    }

    renderContent = () => {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <FlatList
                data={this.state.orders}
                renderItem={({item, index}) => this.renderItem(item, index)}
                ItemSeparatorComponent={() => <View style={{height: 10}}/>}
                refreshing={this.state.isRefreshing}
                onRefresh={this.onRefresh}
                onEndReached={this.onEndReached}
                onEndReachedThreshold={1}
                keyExtractor={(item, index) => index.toString()}
                ListHeaderComponent={() => {
                    if (this.state.orders.length === 0) {
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
                ListFooterComponent={<LoadingView text="正在加载更多" show={this.state.isLoadMore}
                                                  style={{paddingTop: 10, paddingBottom: 10}}/>}
                style={{flex: 1}}
            />
        )
    }

    renderItem = (order, index) => {
        let {order_id, items} = order;
        let totalCount = items.reduce((a, b) => a + b.quantity, 0);
        return (
            <View style={css.order}>
                <View style={css.orderMeta}>
                    <Text style={css.orderNo}>单号:{order.order_no}</Text>
                    <Text style={css.orderState}>{order.buyer_state_des}</Text>
                </View>
                <View>
                    {this.renderOrderItems(order.items)}
                </View>
                <View style={css.simpleTotal}>
                    <Text style={css.simpleTotalText}>
                        共计{totalCount}件商品 合计:{order.total_fee}(含运费￥{order.shipping_fee})
                    </Text>
                </View>
                <OrderActionBar
                    order={order}
                    reasons={this.state.reasons}
                    onCancel={this.fetchData}
                    onExpress={() => {
                        this.props.navigation.navigate('Logistics', {order_id});
                    }}
                    onPay={this.fetchData}
                    onNotice={() => {
                    }}
                    onConfirm={this.fetchData}
                    onRate={() => {
                        this.props.navigation.navigate('OrderRate', {order_id, items});
                    }}
                    onDelete={() => {
                        this.state.orders.splice(index, 1);
                        this.setState({orders: this.state.orders});
                    }}
                />
            </View>
        );
    };

    renderOrderItems = (items) => {
        return items.map((item) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    key={item.itemid.toString()}
                    style={css.item}
                    onPress={() => {
                        this.props.navigation.navigate('OrderDetail', {order_id: item.order_id});
                    }}
                >
                    <CacheImage source={{uri: item.thumb}} style={css.itemImage}/>
                    <View style={css.itemContent}>
                        <Text numberOfLines={2} style={css.itemTitle}>{item.title}</Text>
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
                    </View>
                    <View style={css.itemData}>
                        <Text style={css.itemPrice}>￥{item.price}</Text>
                        <Text style={css.itemQuantity}>x{item.quantity}</Text>
                    </View>
                </TouchableOpacity>
            );
        });
    };
}

const css = {
    order: {
        backgroundColor: '#fff'
    },
    orderMeta: {
        flexDirection: 'row',
        paddingVertical: 12,
        paddingHorizontal: 5,
        borderBottomColor: '#e5e5e5',
        borderBottomWidth: 0.5,
    },
    orderNo: {
        fontSize: 14,
        color: '#333',
        lineHeight: 16,
        marginLeft: 5,
        marginRight: 10,
        flex: 1
    },
    orderState: {
        fontSize: 14,
        color: '#FC461E',
        lineHeight: 16,
    },
    item: {
        padding: 10,
        flexDirection: 'row',
    },
    itemImage: {
        width: 80,
        height: 80,
        marginRight: 15
    },
    itemContent: {
        flex: 1
    },
    itemTitle: {
        fontSize: 14,
        fontWeight: '400',
        color: '#333'
    },
    itemData: {
        marginLeft: 30
    },
    itemPrice: {
        paddingTop: 2,
        fontSize: 14,
        color: '#333',
        textAlign: 'right'
    },
    itemQuantity: {
        paddingTop: 5,
        fontSize: 14,
        color: '#777',
        textAlign: 'right'
    },
    simpleTotal: {
        padding: 10,
        borderBottomColor: '#e5e5e5',
        borderBottomWidth: 0.5,
    },
    simpleTotalText: {
        flex: 1,
        textAlign: 'right',
        fontSize: 12,
        color: '#333'
    },
};

export default OrderList;

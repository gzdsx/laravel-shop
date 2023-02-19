import React from 'react';
import {
    FlatList,
    View,
    Text,
    TouchableOpacity,
    StyleSheet,
    SafeAreaView,
} from 'react-native';
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import OrderActionBar from "./OrderActionBar";
import {Size, StatusBarStyles} from "../../styles";
import ListComponent from "../../components/ListComponent";
import {ListItem} from 'react-native-elements';
import ImageIcon from "../../components/ImageIcon";
import FastImage from "react-native-fast-image";
import OrderTabs from "./OrderTabs";

class OrderList extends ListComponent {

    listApi = '/trade/bought.getList';

    constructor(props) {
        super(props);
        this.state.reasons = [];
        this.state.params.tab = 'all';
        this.obj = null;
        this.index = 0;
    }

    fetchReasons = () => {
        ApiClient.get('/ecom/order.close.reasons').then(response => {
            this.setState({reasons: response.result.items});
        });
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '我的订单'
        });
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        const tab = route.params?.tab || 'all'
        this.setState({tab}, this.fetchList);
        this.fetchReasons();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        const {reasons} = this.state;
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#f2f2f2'}}>
                {this.renderTabs()}
                {this.renderContent()}
            </SafeAreaView>
        );
    }

    renderTabs = () => {
        const {params} = this.state;
        return (
            <View style={styles.tabContainer}>
                {
                    OrderTabs.map((ot, index) => (
                        <TouchableOpacity
                            key={index.toString()}
                            style={styles.tabItem}
                            activeOpacity={1}
                            onPress={() => {
                                params.tab = ot.value;
                                this.setState({
                                    params,
                                    dataList: [],
                                    loading: true
                                }, () => {
                                    this.offset = 0;
                                    this.fetchList();
                                });
                            }}
                        >
                            <Text style={[styles.tabText, params.tab === ot.value && styles.tabActive]}>{ot.name}</Text>
                        </TouchableOpacity>
                    ))
                }
            </View>
        );
    }

    renderContent = () => {
        let {loading, dataList, refreshing, loadingMore} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <FlatList
                data={dataList}
                renderItem={({item, index}) => this.renderItem(item, index)}
                keyExtractor={(item, index) => index.toString()}
                ItemSeparatorComponent={() => <View style={{height: 10}}/>}
                refreshing={refreshing}
                onRefresh={this.onRefresh}
                onEndReached={this.onEndReached}
                onEndReachedThreshold={0.2}
                ListEmptyComponent={() => (
                    <View style={{
                        height: Size.screenHeight * 0.5,
                        alignItems: 'center',
                        justifyContent: 'center'
                    }}>
                        <Text style={{
                            color: '#666',
                            padding: 30,
                            fontSize: 16
                        }}>没有此类订单</Text>
                    </View>
                )}
                ListFooterComponent={
                    <LoadingView
                        text="正在加载更多"
                        show={loadingMore}
                        style={{paddingTop: 10, paddingBottom: 10}}/>}
                style={{flex: 1}}
            />
        )
    }

    renderItem = (order, index) => {
        let {order_id, items} = order;
        let totalCount = items.reduce((a, b) => a + b.quantity, 0);
        return (
            <View style={styles.order}>
                <ListItem containerStyle={styles.shopContainer}>
                    <ListItem.Content style={{flexDirection: 'row', justifyContent: 'flex-start'}}>
                        <ImageIcon
                            source={require('../../images/icon/shop.png')}
                            size={20} color={"#555"}
                            style={{marginRight: 3}}
                        />
                        <ListItem.Title style={styles.shopName}>{order.shop_name}</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle style={styles.orderState}>{order.state_des}</ListItem.Subtitle>
                </ListItem>
                <View>
                    {
                        order.items.map((item, idx) => (
                            <ListItem
                                activeOpacity={1}
                                key={idx.toString()}
                                containerStyle={styles.orderItem}
                                onPress={() => {
                                    this.props.navigation.navigate('trade-order-detail', {order_id: item.order_id});
                                }}
                            >
                                <FastImage source={{uri: item.image}} style={css.itemImage}/>
                                <View style={css.itemContent}>
                                    <Text numberOfLines={2} style={css.itemTitle}>{item.title}</Text>
                                    {
                                        item.sku_title ?
                                            <View style={{flexDirection: 'row', marginTop: 5}}>
                                                <TouchableOpacity style={styles.skuTouch}>
                                                    <Text style={styles.skuTitle}>{item.sku_title}</Text>
                                                </TouchableOpacity>
                                            </View>
                                            : null
                                    }
                                    <View style={{flex: 1}}/>
                                </View>
                                <View style={css.itemData}>
                                    <Text style={css.itemPrice}>￥{item.price}</Text>
                                    <Text style={css.itemQuantity}>x{item.quantity}</Text>
                                    <View style={{flex: 1}}/>
                                </View>
                            </ListItem>
                        ))
                    }
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
}

export default OrderList;

const styles = StyleSheet.create({
    tabContainer: {
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
        fontSize: 16
    },
    tabActive: {
        fontWeight: '800',
        color: '#f00',
    },
    order: {
        backgroundColor: '#fff'
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
    shopContainer: {
        paddingHorizontal: 10,
        borderBottomColor: '#f2f2f2',
        borderBottomWidth: 0.5
    },
    shopName: {
        fontSize: 16,
        color: '#333'
    },
    orderItem: {
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
    skuTouch: {
        backgroundColor: '#f2f2f2',
        paddingHorizontal: 5,
        paddingVertical: 3,
        borderRadius: 5
    },
    skuTitle: {
        fontSize: 12, color: '#555'
    }
});

const css = {

    item: {
        padding: 10,
        flexDirection: 'row',
    },
    itemImage: {
        width: 80,
        height: 80,
        borderRadius: 5,
        resizeMode: 'cover'
    },
    itemContent: {
        flex: 1,
        alignItems: 'flex-start',
        justifyContent: 'flex-start'
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

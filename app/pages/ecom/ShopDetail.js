import React from 'react';
import {FlatList, SafeAreaView, StyleSheet, Text, View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {StatusBarStyles} from "../../styles";
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import Icon from "react-native-vector-icons/AntDesign";
import {ShareView} from "../../components";
import ListComponent from "../../components/ListComponent";
import {ListItem} from "react-native-elements";
import FastImage from "react-native-fast-image";

export default class ShopDetail extends ListComponent {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '',
        })
    }

    setNavigationRight = () => {
        const {navigation} = this.props;
        const {subscribe} = this.state;

        let name = subscribe ? 'heart' : 'hearto';
        let color = subscribe ? '#FF4101' : '#333';
        navigation.setOptions({
            headerRight: () => (
                <View style={{flexDirection: 'row'}}>
                    <Icon
                        size={24}
                        name={name}
                        color={'#333'}
                        suppressHighlighting={true}
                        onPress={this.toggleSubscribe}
                    />
                    <View style={{width: 10}}/>
                    <Icon
                        name={'sharealt'}
                        size={25}
                        color={"#333"}
                        suppressHighlighting={true}
                        onPress={() => {
                            this.share.show();
                        }}
                    />
                </View>
            )
        })
    }

    listApi = '/ecom/product.getList';

    constructor(props) {
        super(props);
        this.state.shop = {};
        this.state.subscribe = false;
    }

    fetchData = () => {
        let {route, navigation} = this.props;
        let shop_id = route.params?.shop_id;
        ApiClient.get('/ecom/shop.getInfo', {shop_id}).then(response => {
            let shop = response.result;
            navigation.setOptions({
                title: shop.shop_name
            });

            this.setState({
                shop,
                loading: false
            });
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    }

    querySubscribe = () => {
        let shop_id = this.props.route.params?.shop_id;
        ApiClient.post('/ecom/shop.subscribe.query', {shop_id}).then((response) => {
            console.log(response);
            let {subscribe} = response.result;
            this.setState({subscribe}, this.setNavigationRight);
        });
    }

    toggleSubscribe = () => {
        let shop_id = this.props.route.params?.shop_id;
        ApiClient.post('/ecom/shop.subscribe.toggle', {shop_id}).then(response => {
            if (response.result.attached.length) {
                Toast.success('关注成功');
                this.setState({subscribe: true}, this.setNavigationRight);
            } else {
                Toast.success('取消关注成功');
                this.setState({subscribe: false}, this.setNavigationRight);
            }
        });
    }

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        this.fetchData();
        let shop_id = this.props.route.params?.shop_id;
        this.setState({
            params: {shop_id}
        }, this.fetchList);
        this.querySubscribe();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        let {navigation} = this.props;
        let {loading, shop, dataList, refreshing} = this.state;
        if (loading) return <LoadingView/>
        return (
            <SafeAreaView>
                <FlatList
                    data={dataList}
                    renderItem={({item, index}) => (
                        <ListItem
                            containerStyle={styles.row}
                            onPress={() => navigation.push('product-detail', {itemid: item.itemid})}
                        >
                            <FastImage
                                source={{uri: item.thumb}}
                                style={styles.thumb}
                            />
                            <ListItem.Content>
                                <ListItem.Title style={styles.title}>{item.title}</ListItem.Title>
                                <View style={{flex: 1}}/>
                                <View style={{flexDirection: 'row'}}>
                                    <View style={{flex: 1, justifyContent: 'center'}}>
                                        <Text style={styles.price}>￥{item.price}</Text>
                                    </View>
                                    <View style={{justifyContent: 'center'}}>
                                        <Text style={styles.sold}>已售{item.sold}</Text>
                                    </View>
                                </View>
                            </ListItem.Content>
                        </ListItem>
                    )}
                    keyExtractor={(item, index) => index.toString()}
                    refreshing={refreshing}
                    onRefresh={this.onRefresh}
                    onEndReached={this.onEndReached}
                    onEndReachedThreshold={0.2}
                    ListHeaderComponent={() => (
                        <ListItem
                            containerStyle={styles.shopContainer}
                            onPress={() => {
                                navigation.navigate('shop-map', {shop_id: shop.shop_id});
                            }}
                        >
                            <FastImage
                                source={{uri: shop.logo}}
                                style={styles.shopLogo}
                            />
                            <ListItem.Content>
                                <ListItem.Title style={styles.shopName}>{shop.shop_name}</ListItem.Title>
                                <ListItem.Subtitle
                                    style={styles.shopAddress}>{shop.province}{shop.city}{shop.district}</ListItem.Subtitle>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                    )}
                    stickyHeaderIndices={[0]}
                />
                <ShareView ref={o => this.share = o}/>
            </SafeAreaView>
        );
    }

}

const styles = StyleSheet.create({
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0'
    },
    thumb: {
        width: 100,
        height: 100,
        borderRadius: 10
    },
    title: {
        fontSize: 16,
        color: '#666'
    },
    price: {
        fontSize: 18,
        color: '#f40',
        fontWeight: 'bold'
    },
    sold: {
        fontSize: 14,
        color: '#838383'
    },
    shopContainer: {
        marginBottom: 10
    },
    shopLogo: {
        width: 60,
        height: 60,
        borderRadius: 6
    },
    shopName: {
        fontSize: 16,
        color: '#333'
    },
    shopAddress: {
        fontSize: 14,
        color: '#838383',
        marginTop: 5
    }
})

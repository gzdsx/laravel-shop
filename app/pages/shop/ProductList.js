import React from "react";
import {
    View,
    Text,
    StyleSheet,
    TouchableOpacity,
} from "react-native";
import {Ticon} from "react-native-gzdsx-elements";
import {Header} from "react-native-elements";
import {Utils, ApiClient} from "../../utils";
import ProductListView from "./components/ProductListView";
import {Colors, Size} from "../../styles";
import {SearchBar} from "../../components";

const TabItem = ({text, active = false, onPress = () => null}) => {
    return (
        <TouchableOpacity
            style={[css.tabItem, {borderBottomWidth: active ? 2 : 0}]}
            activeOpacity={1}
            onPress={onPress}
        >
            <Text style={[css.tabText, {color: active ? '#f00' : '#333'}]}>{text}</Text>
        </TouchableOpacity>
    );
};

class ProductList extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        const value = route.params?.q;
        navigation.setOptions({
            header: () => (
                <Header
                    backgroundColor={Colors.primary}
                    leftComponent={() => (
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => navigation.goBack()}
                        >
                            <Ticon name={"back-light"} size={28} color={"#fff"}/>
                        </TouchableOpacity>
                    )}
                    leftContainerStyle={{flex: 0}}
                    centerComponent={() => (
                        <SearchBar
                            placeholderTextColor={"#666"}
                            placeholder={"猕猴桃,果酒,羊肉粉"}
                            containerStyle={{
                                backgroundColor: "transparent",
                                flex: 1,
                                padding: 0,
                                borderRadius: 10,
                                borderTopWidth: 0,
                                borderBottomWidth: 0,
                            }}
                            inputContainerStyle={{
                                backgroundColor: '#fefefe',
                                height: 34
                            }}

                            inputStyle={{
                                fontSize: 12,
                            }}
                            round={true}
                            lightTheme={true}
                            value={value}
                            onSearch={(q) => {
                                this.searchFileds.q = q;
                                this.fetchData();
                            }}
                        />
                    )}
                    centerContainerStyle={{
                        flexDirection: "row",
                        marginLeft: 10,
                        marginRight: 10
                    }}
                    rightComponent={() => (
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => {

                            }}
                        >
                            <Ticon name={"more-light"} size={28} color={"#fff"}/>
                        </TouchableOpacity>
                    )}
                    rightContainerStyle={{flex: 0}}
                    containerStyle={{
                        borderBottomColor: Colors.primary,
                        borderBottomWidth: 0,
                    }}
                >
                </Header>
            )
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            loading: true,
            refreshing: false,
            loadMore: false,
            sort: 'sold-desc'
        };
        this.offset = 0;
        this.loadMoreAble = false;
        this.searchFileds = {};
    }

    render() {
        const {sort} = this.state;
        return (
            <View style={{flex: 1}}>
                <View style={css.tabs}>
                    <TabItem text={"热销"} active={sort === 'sold-desc'} onPress={() => {
                        this.setState({sort: 'sold-desc', isRefreshing: true}, this.fetchData);
                    }}/>
                    <TabItem text={"新品"} active={sort === 'time-desc'} onPress={() => {
                        this.setState({sort: 'time-desc', isRefreshing: true}, this.fetchData);
                    }}/>
                    <TabItem text={"好评"} active={sort === 'rate-desc'} onPress={() => {
                        this.setState({sort: 'rate-desc', isRefreshing: true}, this.fetchData);
                    }}/>
                </View>
                <ProductListView
                    data={this.state.items}
                    loading={this.state.loading}
                    refreshing={this.state.refreshing}
                    loadMore={this.state.loadMore}
                    onRefresh={this.onRefresh}
                    onEndReached={this.onEndReached}
                    onPressItem={(item) => {
                        this.props.navigation.navigate('ProductDetail', {itemid: item.itemid});
                    }}
                />
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.searchFileds = {...this.props.route.params};
        this.fetchData();
    }

    fetchData = () => {
        let sort = this.state.sort;
        ApiClient.get('/product/batchget', {
            ...this.searchFileds,
            offset: this.offset,
            count: 20,
            sort,
        }).then(response => {
            let items;
            if (this.state.loadMore) {
                items = this.state.items.concat(response.data.items);
            } else {
                items = response.data.items;
            }
            setTimeout(() => {
                this.setState({
                    items,
                    loading: false,
                    refreshing: false,
                    loadMore: false,
                });
                this.loadMoreAble = response.data.items.length >= 20;
            }, 300);
        });
    };

    onRefresh = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore) {
            return false;
        }

        this.setState({
            refreshing: true
        }, () => {

        });
        setTimeout(() => {
            this.offset = 0;
            this.fetchData();
        }, 1000)
    };

    onEndReached = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore || !this.loadMoreAble) {
            return false;
        }

        this.setState({
            loadMore: true
        }, () => {

        });
        setTimeout(() => {
            this.offset += 20;
            this.fetchData();
        }, 500);
    }
}

const css = StyleSheet.create({
    tabs: {
        backgroundColor: '#fff',
        height: 48,
        borderBottomColor: '#e5e5e5',
        borderBottomWidth: 0.5,
        flexDirection: 'row'
    },
    tabItem: {
        flex: 1,
        alignContent: 'center',
        borderBottomColor: '#f00'
    },
    tabText: {
        lineHeight: 48,
        fontSize: 16,
        color: '#333',
        textAlign: 'center',
        textAlignVertical: 'center'
    }
});

export default ProductList;

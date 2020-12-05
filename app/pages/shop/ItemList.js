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
import ItemListView from "./components/ItemListView";
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

class ItemList extends React.Component {

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
            isLoading: true,
            isRefreshing: false,
            isLoadMore: false,
            sort: 'sold-desc'
        };
        this.offset = 0;
        this.loadMoreAble = false;
        this.searchFileds = {
            q: '',
            catid: '',
        }
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
                <ItemListView
                    data={this.state.items}
                    isLoading={this.state.isLoading}
                    isRefreshing={this.state.isRefreshing}
                    isLoadMore={this.state.isLoadMore}
                    onRefresh={this.onRefresh}
                    onEndReached={this.onEndReached}
                    onPressItem={(item) => {
                        this.props.navigation.navigate('ItemDetail', {itemid: item.itemid});
                    }}
                />
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.searchFileds.q = this.props.route.params?.q || '';
        this.searchFileds.catid = this.props.route.params?.catid || '';
        this.fetchData();
    }

    fetchData = () => {
        let sort = this.state.sort;
        let {q, catid} = this.searchFileds;
        ApiClient.get('/item/batchget', {
            offset: this.offset,
            count: 20,
            q,
            catid,
            sort,
        }).then(response => {
            let items;
            if (this.state.isLoadMore) {
                items = this.state.items.concat(response.data.items);
            } else {
                items = response.data.items;
            }
            setTimeout(() => {
                this.setState({
                    items,
                    isLoading: false,
                    isRefreshing: false,
                    isLoadMore: false,
                });
                this.loadMoreAble = response.data.items.length >= 20;
            }, 300);
        });
    };

    onRefresh = () => {
        if (this.state.isLoading || this.state.isRefreshing || this.state.isLoadMore) {
            return false;
        }

        this.setState({
            isRefreshing: true
        });
        setTimeout(() => {
            this.offset = 0;
            this.fetchData();
        }, 1000)
    };

    onEndReached = () => {
        if (this.state.isLoading || this.state.isRefreshing || this.state.isLoadMore || !this.loadMoreAble) {
            return false;
        }

        this.setState({
            isLoadMore: true
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

export default ItemList;

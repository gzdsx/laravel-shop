import React from "react";
import {
    View,
    Text,
    StyleSheet,
    TouchableOpacity,
    FlatList,
    SafeAreaView,
} from "react-native";
import {Header, ListItem, SearchBar} from "react-native-elements";
import {Colors, StatusBarStyles} from "../../styles";
import ListComponent from "../../components/ListComponent";
import FastImage from "react-native-fast-image";
import {useNavigation} from "@react-navigation/native";
import Icon from "react-native-vector-icons/Entypo";

const TabItem = ({text, active = false, onPress = () => null}) => {
    return (
        <TouchableOpacity
            style={[styles.tabItem, {borderBottomWidth: active ? 2 : 0}]}
            activeOpacity={1}
            onPress={onPress}
        >
            <Text style={[styles.tabText, {color: active ? '#f00' : '#333'}]}>{text}</Text>
        </TouchableOpacity>
    );
};

const SearchHeader = (props) => {
    let [keywords, setKeywords] = React.useState(props.defaultValue);
    let navigation = useNavigation();
    return (
        <Header
            backgroundColor={'#f2f2f2'}
            centerComponent={() => (
                <SearchBar
                    placeholderTextColor={"#666"}
                    placeholder={"输入关键字搜索"}
                    containerStyle={{
                        flex: 1,
                        padding: 0,
                        borderRadius: 20,
                        borderTopWidth: 0,
                        borderBottomWidth: 0,
                        paddingBottom: 0
                    }}
                    inputContainerStyle={{
                        backgroundColor: '#fff',
                        height: 34,
                        borderRadius: 20
                    }}

                    inputStyle={{
                        fontSize: 14,
                    }}
                    lightTheme={true}
                    returnKeyType={'search'}
                    returnKeyLabel={'搜索'}
                    value={keywords}
                    onChangeText={text => {
                        setKeywords(text);
                    }}
                    onSubmitEditing={props.onSubmit}
                    clearButtonMode={"while-editing"}
                    clearTextOnFocus={true}
                />
            )}
            centerContainerStyle={{flexDirection: "row", paddingHorizontal: 10}}
            leftContainerStyle={{flex: 0}}
            rightContainerStyle={{flex: 0}}
            containerStyle={{
                borderBottomColor: Colors.primary,
                borderBottomWidth: 0,
            }}
            leftComponent={
                <View style={{
                    alignItems: 'center',
                    justifyContent: 'center',
                    marginRight: 5,
                    flex: 1
                }}>
                    <Icon
                        name={'chevron-thin-left'}
                        color={'#666'}
                        size={22}
                        suppressHighlighting={true}
                        onPress={() => {
                            navigation.goBack();
                        }}
                    />
                </View>
            }
        >
        </Header>
    )
}

class ProductList extends ListComponent {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        const value = route.params?.q;
        navigation.setOptions({
            header: () => (
                <SearchHeader
                    defaultValue={value}
                    onSubmit={event => {
                        let {params} = this.state;
                        params.q = event.nativeEvent.text;
                        this.setState({params}, this.fetchList);
                    }}
                />
            )
        })
    }

    listApi = '/ecom/product.getList';

    constructor(props) {
        super(props);
        this.state.params.sort = 'sold-desc';
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        let {params} = this.state;
        params.q = this.props.route.params?.q || '';
        params.cate_id = this.props.route.params?.cate_id || '';
        this.setState({params}, this.fetchList);
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        const {params, dataList, refreshing} = this.state;
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#fff'}}>
                <View style={styles.tabs}>
                    <TabItem text={"热销"} active={params.sort === 'sold-desc'} onPress={() => {
                        params.sort = 'sold-desc';
                        this.setState({params}, this.fetchList);
                    }}/>
                    <TabItem text={"新品"} active={params.sort === 'time-desc'} onPress={() => {
                        params.sort = 'time-desc';
                        this.setState({params}, this.fetchList);
                    }}/>
                    <TabItem text={"好评"} active={params.sort === 'rate-desc'} onPress={() => {
                        params.sort = 'rate-desc';
                        this.setState({params}, this.fetchList);
                    }}/>
                </View>
                <FlatList
                    data={dataList}
                    renderItem={this.renderItem}
                    keyExtractor={(item, index) => index.toString()}
                    refreshing={refreshing}
                    onRefresh={this.onRefresh}
                    onEndReached={this.onEndReached}
                    onEndReachedThreshold={0.2}
                    style={{
                        paddingTop: 5,
                        backgroundColor: '#fff'
                    }}
                    ListEmptyComponent={
                        <View style={{flex: 1, alignItems: 'center', justifyContent: 'center', paddingTop: 50}}>
                            <Text style={{fontSize: 16, color: '#737373'}}>暂无此类商品</Text>
                        </View>
                    }
                />
            </SafeAreaView>
        );
    }

    renderItem = ({item, index}) => {
        return (
            <ListItem containerStyle={styles.item} onPress={() => {
                this.props.navigation.navigate('product-detail', {itemid: item.itemid});
            }}>
                <FastImage source={{uri: item.thumb}} style={styles.image}/>
                <ListItem.Content>
                    <View style={styles.meta}>
                        <Text style={styles.title} numberOfLines={2}>{item.title}</Text>
                        {
                            item.shop ?
                                <Text style={styles.shopName}>{item.shop.shop_name}</Text>
                                : null
                        }
                        <View style={{flex: 1}}/>
                        <View style={styles.prop}>
                            <Text style={styles.yuan}>￥</Text>
                            <Text style={styles.price}>{item.price}</Text>
                            <Text style={styles.sold}>已售{item.sold}件</Text>
                        </View>
                    </View>
                </ListItem.Content>
            </ListItem>
        );
    };
}

const styles = StyleSheet.create({
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
    },
    item: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#e5e5e5'
    },
    image: {
        width: 120,
        height: 120,
        borderRadius: 10
    },
    meta: {
        flex: 1,
        paddingTop: 5
    },
    title: {
        fontSize: 16,
        color: '#000',
    },
    prop: {
        flexDirection: 'row',
    },
    yuan: {
        fontSize: 12,
        color: '#f40',
        fontWeight: '400',
        paddingTop: 4
    },
    price: {
        fontSize: 16,
        color: '#f40',
        marginRight: 10,
        fontWeight: '600',
        flex: 1
    },
    sold: {
        fontSize: 12,
        color: '#777',
        paddingTop: 4
    },
    shopName: {
        fontSize: 14,
        color: '#838383',
        marginTop: 8
    },
    location: {
        fontSize: 12,
        color: '#888',
    },
});

export default ProductList;

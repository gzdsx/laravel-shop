import React from "react";
import {FlatList, View, Text, TouchableOpacity, StyleSheet} from 'react-native';
import PropTypes from 'prop-types';
import {LoadingView} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';

class ItemListView extends React.Component {

    static propTypes = {
        style: PropTypes.object,
        onPressItem: PropTypes.func,
        data: PropTypes.array,
        isLoading: PropTypes.bool,
        isRefreshing: PropTypes.bool,
        isLoadMore: PropTypes.bool,
        onRefresh: PropTypes.func,
        onEndReached: PropTypes.func
    };

    static defaultProps = {
        style: {},
        onPressItem: () => null,
        data: [],
        isLoading: false,
        isRefreshing: false,
        isLoadMore: false,
        onRefresh: () => null,
        onEndReached: () => null
    };

    constructor(props) {
        super(props);
    }

    render() {
        if (this.props.isLoading) return <LoadingView/>;
        return (
            <FlatList
                data={this.props.data}
                renderItem={({item}) => this.renderItem(item)}
                keyExtractor={(item) => item.itemid.toString()}
                refreshing={this.props.isRefreshing}
                onRefresh={this.props.onRefresh}
                onEndReached={this.props.onEndReached}
                onEndReachedThreshold={1}
                ListFooterComponent={<LoadingView text="正在加载更多" show={this.props.isLoadMore}
                                                  style={{paddingTop: 10, paddingBottom: 10}}/>}
                style={{
                    paddingTop: 5,
                    backgroundColor: '#fff',
                    ...this.props.style
                }}
            />
        );
    }

    renderItem = (item) => {
        return (
            <TouchableOpacity
                activeOpacity={1}
                onPress={() => this.props.onPressItem(item)}
            >
                <View style={css.item}>
                    <CacheImage source={{uri: item.thumb}} style={css.image}/>
                    <View style={css.meta}>
                        <Text style={css.title} numberOfLines={2}>{item.title}</Text>
                        <View style={css.prop}>
                            <Text style={css.yuan}>￥</Text>
                            <Text style={css.price}>{item.price}</Text>
                            <Text style={css.sold}>已售{item.sold}件</Text>
                        </View>
                    </View>
                </View>
            </TouchableOpacity>
        );
    };
}

const css = StyleSheet.create({
    item: {
        paddingLeft: 10,
        paddingRight: 10,
        paddingTop: 5,
        paddingBottom: 5,
        borderBottomWidth: 0.5,
        borderBottomColor: '#e5e5e5',
        flexDirection: 'row',
    },
    image: {
        width: 120,
        height: 100,
        marginRight: 10,
        borderRadius: 2
    },
    meta: {
        flex: 1,
        height: 100,
        flexDirection: 'column',
        paddingBottom: 5
    },
    title: {
        fontSize: 14,
        color: '#000',
        height: 53,
        flex: 1
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
        fontSize: 12,
        color: '#888',
        marginRight: 10,
        flex: 1
    },
    location: {
        fontSize: 12,
        color: '#888',
    },
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

export default ItemListView;

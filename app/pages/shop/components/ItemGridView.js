import React from 'react';
import {FlatList, View, Text, TouchableOpacity, StyleSheet} from 'react-native';
import PropTypes from 'prop-types';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {LoadingView} from "react-native-dsxui";
import {Size} from "../../../styles";

export default class ItemGridView extends React.Component {

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
                {...this.props}
                data={this.props.data}
                renderItem={({item}) => this.renderItem(item)}
                keyExtractor={(item) => item.itemid.toString()}
                numColumns={2}
                refreshing={this.props.isRefreshing}
                onRefresh={this.props.onRefresh}
                onEndReached={this.props.onEndReached}
                onEndReachedThreshold={-0.1}
                ListFooterComponent={<LoadingView text="正在加载更多" show={this.props.isLoadMore}
                                              style={{paddingTop: 10, paddingBottom: 10}}/>}
                style={{
                    ...this.props.style
                }}
            />
        );
    }

    renderItem = (item) => {
        return (
            <TouchableOpacity
                style={css.item}
                activeOpacity={1} key={item.itemid.toString()}
                onPress={() => this.props.onPressItem(item)}
            >
                <View style={css.itemContent}>
                    <CacheImage source={{uri: item.thumb}} style={css.itemImage}/>
                    <Text style={css.itemTitle} numberOfLines={2}>{item.title}</Text>
                    <View style={css.itemData}>
                        <Text style={css.itemPrice}>￥{item.price}</Text>
                        <Text style={css.totalSold}>已售{item.sold}</Text>
                    </View>
                </View>
            </TouchableOpacity>
        );
    };
}

const itemWidth = Size.screenWidth/2;
const css = StyleSheet.create({
    item: {
        padding: 3,
        width: itemWidth
    },
    itemContent: {
        backgroundColor: '#fff',
        borderRadius: 2
    },
    itemImage: {
        height: (Size.screenWidth - 12) / 2,
        width: (Size.screenWidth - 12) / 2
    },
    itemTitle: {
        fontSize: 14,
        color: '#000',
        height: 60,
        padding: 10,
        fontWeight: '400'
    },
    itemData: {
        flexDirection: 'row',
        paddingLeft: 10,
        paddingRight: 10,
        paddingBottom: 10
    },
    itemPrice: {
        flex: 1,
        color: '#f40',
        fontSize: 16,
        fontWeight: '600',
    },
    totalSold: {
        color: '#888',
        textAlign: 'right',
        fontSize: 14,
        fontWeight: '300',
        paddingTop: 2
    }
});

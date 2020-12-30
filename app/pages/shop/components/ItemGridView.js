import React from 'react';
import {FlatList, View, Text, TouchableOpacity, StyleSheet, FlatListProps} from 'react-native';
import PropTypes from 'prop-types';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {LoadingView} from "react-native-gzdsx-elements";
import {Size} from "../../../styles";

export default class ItemGridView extends React.Component<FlatListProps, any> {

    static propTypes = {
        loading: PropTypes.bool,
        onPressItem: PropTypes.func,
    };

    static defaultProps = {
        loading: false,
        onPressItem: () => null,
    };

    render() {
        if (this.props.isLoading) return <LoadingView/>;
        return (
            <FlatList
                {...this.props}
                data={this.props.data}
                renderItem={({item, index}) => this.renderItem(item, index)}
                keyExtractor={(item) => item.itemid.toString()}
                numColumns={2}
                onEndReachedThreshold={2}
                ListFooterComponent={<LoadingView text="正在加载更多" show={this.props.isLoadMore}
                                                  style={{paddingTop: 10, paddingBottom: 10}}/>}
                columnWrapperStyle={{
                    paddingVertical: 6,
                    paddingHorizontal: 3,
                    ...this.props.columnWrapperStyle
                }}
            />
        );
    }

    renderItem = (item, index) => {
        return (
            <TouchableOpacity
                style={styles.item}
                activeOpacity={1} key={item.itemid.toString()}
                onPress={() => this.props.onPressItem(item)}
            >
                <View style={styles.content}>
                    <CacheImage source={{uri: item.thumb}} style={styles.image}/>
                    <Text style={styles.title} numberOfLines={2}>{item.title}</Text>
                    <View style={styles.meta}>
                        <Text style={styles.price}>￥{item.price}</Text>
                        <Text style={styles.sold}>已售{item.sold}</Text>
                    </View>
                </View>
            </TouchableOpacity>
        );
    };
}

const styles = StyleSheet.create({
    item: {
        paddingHorizontal: 3,
        width: Size.screenWidth / 2 - 3,
    },
    content: {
        backgroundColor: '#fff',
        borderRadius: 2
    },
    image: {
        width: Size.screenWidth/2-9,
        height: Size.screenWidth/2-9,
        resizeMode: 'cover'
    },
    title: {
        fontSize: 14,
        color: '#000',
        height: 60,
        padding: 10,
        fontWeight: '400'
    },
    meta: {
        flexDirection: 'row',
        paddingLeft: 10,
        paddingRight: 10,
        paddingBottom: 10
    },
    price: {
        flex: 1,
        color: '#f40',
        fontSize: 16,
        fontWeight: '600',
    },
    sold: {
        color: '#888',
        textAlign: 'right',
        fontSize: 14,
        fontWeight: '300',
        paddingTop: 2
    }
});

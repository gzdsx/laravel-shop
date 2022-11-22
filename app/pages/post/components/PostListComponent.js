import React from 'react';
import {View, FlatList, Text, StyleSheet} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import FastImage from "react-native-fast-image";
import {ListItem} from "react-native-elements";
import ListComponent from "../../../components/ListComponent";


export default class PostListComponent extends ListComponent {

    listApi = '/post/item.getList'

    constructor(props) {
        super(props);
        this.state.params.cate_id = props.cate_id;
        this.state.params.sort = 'time-desc';
    }

    render(): React.ReactNode {
        let {loading, refreshing, dataList} = this.state;
        if (loading) return <LoadingView/>;
        return <FlatList
            data={dataList}
            renderItem={this.renderItem}
            keyExtractor={(item, index) => index.toString()}
            refreshing={refreshing}
            onRefresh={this.onRefresh}
            onEndReached={this.onEndReached}
            onEndReachedThreshold={0.2}
            ListEmptyComponent={() => {
                return (
                    <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                        <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>此栏目下还没有内容</Text>
                    </View>
                );
            }}
        />
    }

    componentDidMount(): void {
        this.fetchList();
    }

    renderItem = ({item, index}) => {
        return (
            <ListItem
                containerStyle={styles.postTtem}
                onPress={() => {
                    this.props.navigation.navigate('post-detail', {aid: item.aid});
                }}
            >
                <ListItem.Content>
                    <Text style={styles.postTitle} numberOfLines={2}>{item.title}</Text>
                    <View style={{flex: 1}}/>
                    <View style={{flexDirection: 'row'}}>
                        <View style={{flex: 1}}>
                            <Text style={styles.createdAt}>{item.created_at}</Text>
                        </View>
                        <View>
                            <Text style={styles.views}>{item.views}次阅读</Text>
                        </View>
                    </View>
                </ListItem.Content>
                {
                    item.image ?
                        <FastImage
                            source={{uri: item.image}}
                            style={styles.thumb}
                            resizeMode={FastImage.resizeMode.cover}
                        />
                        : null
                }
            </ListItem>
        );
    };
}

const styles = StyleSheet.create({
    postTtem: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0'
    },
    postTitle: {
        fontSize: 18,
        fontWeight: '400',
        color: '#333',
        lineHeight: 24
    },
    createdAt: {
        fontSize: 14,
        color: '#838383',
        flex: 1
    },
    views: {
        fontSize: 14,
        color: '#838383'
    },
    thumb: {
        width: 120,
        height: 100,
        borderRadius: 3,
        resizeMode: 'cover'
    }
});

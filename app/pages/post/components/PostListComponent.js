import React from 'react';
import {View, FlatList, TouchableOpacity, Text} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import PropTypes from 'prop-types';
import {ApiClient} from "../../../utils";


export default class PostListComponent extends React.Component {

    static propTypes = {
        catid: PropTypes.number,
        onPressItem: PropTypes.func
    };

    static defaultProps = {
        catid: 0,
        onPressItem: () => {
        }
    };

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            isLoadMore: false,
            items: []
        };
        this.catid = props.catid;
        this.offset = 0;
        this.loadMoreAble = false;
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        return <FlatList
            keyExtractor={(item) => item.aid.toString()}
            data={this.state.items}
            renderItem={({item}) => this.renderItem(item)}
            refreshing={this.state.isRefreshing}
            onRefresh={this.onRefresh}
            onEndReached={this.onEndReached}
            onEndReachedThreshold={2}
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
        this.fetchData();
    }

    fetchData = async () => {
        const offset = this.offset;
        const catid = this.props.catid;

        let items = this.state.items;
        let response = await ApiClient.get('/post/batchget', {offset, catid, count: 20});
        if (this.state.isLoadMore) {
            items = items.concat(response.result.items);
        } else {
            items = response.result.items;
        }

        this.setState({
            isLoading: false,
            isRefreshing: false,
            isLoadMore: false,
            items
        });
        this.loadMoreAble = response.result.items.length === 20;
    };

    onRefresh = () => {
        if (this.state.isRefreshing || this.state.isLoading
            || this.state.isLoadMore) {
            return false;
        }

        this.offset = 0;
        this.setState({isRefreshing: true});
        setTimeout(this.fetchData, 1000);
    };

    onEndReached = () => {
        if (this.state.isRefreshing || this.state.isLoading
            || this.state.isLoadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 20;
        this.setState({isLoadMore: true});
        setTimeout(this.fetchData, 500);
    };

    renderItem = (item) => {
        return (
            <TouchableOpacity
                activeOpacity={0.9}
                style={{
                    padding: 15,
                    borderBottomColor: '#e5e5e5',
                    borderBottomWidth: 0.5,
                    flexDirection: 'row',
                    backgroundColor: '#fff'
                }}
                onPress={() => this.props.onPressItem(item)}
            >
                <View style={{flex: 1}}>
                    <Text style={{fontSize: 16, fontWeight: '400', color: '#333'}} numberOfLines={2}>{item.title}</Text>
                    <View style={{flex: 1}}/>
                    <View style={{flexDirection: 'row', marginTop: 15}}>
                        <Text style={{fontSize: 12, color: '#666', flex: 1}}>{item.created_at}</Text>
                        <Text style={{fontSize: 12, color: '#333'}}>{item.views}次阅读</Text>
                    </View>
                </View>
                {this.renderImage(item.image)}
            </TouchableOpacity>
        );
    };

    renderImage = (image) => {
        if (image) {
            return (
                <CacheImage
                    source={{uri: image}}
                    style={{
                        width: 120,
                        height: 90,
                        borderRadius: 3,
                        resizeMode: 'cover',
                        marginLeft: 10
                    }}
                />
            );
        }
        return null;
    }
}

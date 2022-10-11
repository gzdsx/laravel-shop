import React from 'react';
import {View, FlatList, Text, TouchableOpacity} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import {ApiClient} from "../../../utils";

export default class PostCollect extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            refreshing: false,
            loadMore: false,
            items: []
        };
        this.offset = 0;
        this.loadMoreAble = false;
    }


    render(): React.ReactNode {
        if (this.state.loading) return <LoadingView/>;
        return <FlatList
            keyExtractor={(item) => item.aid.toString()}
            data={this.state.items}
            renderItem={({item}) => this.renderItem(item)}
            refreshing={this.state.refreshing}
            onRefresh={this.onRefresh}
            onEndReached={this.onEndReached}
            onEndReachedThreshold={2}
            ListEmptyComponent={() => {
                return (
                    <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                        <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>你的收藏夹还是空的哦</Text>
                    </View>
                );
            }}
            style={{backgroundColor: '#fff'}}
        />
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = async () => {
        let offset = this.offset;
        let items = this.state.items;
        let response = await ApiClient.get('/post/collect/batchget', {offset});
        if (this.state.loadMore) {
            items = items.concat(response.result.items);
        } else {
            items = response.result.items;
        }

        this.setState({
            loading: false,
            refreshing: false,
            loadMore: false,
            items
        });
        this.loadMoreAble = response.result.items.length === 20;
    };

    onRefresh = () => {
        if (this.state.refreshing || this.state.loading || this.state.loadMore) {
            return false;
        }

        this.offset = 0;
        this.setState({refreshing: true});
        setTimeout(this.fetchData, 1000);
    };

    onEndReached = () => {
        if (this.state.refreshing || this.state.loading
            || this.state.loadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 20;
        this.setState({loadMore: true});
        setTimeout(this.fetchData, 500);
    };

    renderItem = (item) => {
        return (
            <TouchableOpacity
                activeOpacity={0.9}
                style={{
                    paddingTop: 20,
                    paddingBottom: 20,
                    paddingLeft: 15,
                    paddingRight: 15,
                    borderBottomColor: '#ddd',
                    borderBottomWidth: 0.5
                }}
                onPress={() => this.props.onPressItem(item)}
            >
                <Text style={{fontSize: 16, fontWeight: '400', color: '#333'}} numberOfLines={2}>{item.post.title}</Text>
            </TouchableOpacity>
        );
    };
}

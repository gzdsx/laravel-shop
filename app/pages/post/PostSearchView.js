import React from 'react';
import {FlatList, Text, TouchableOpacity, View} from 'react-native';
import {LoadingView} from "react-native-dsxui";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";

export default class PostSearchView extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '查询结果'
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            isLoadMore: false,
            items: []
        };
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
        const q = this.props.navigation.getParam('q', '');

        let items = this.state.items;
        let response = await ApiClient.get('/post/batchget', {offset, q, count: 20});
        if (this.state.isLoadMore) {
            items = items.concat(response.data.items);
        } else {
            items = response.data.items;
        }

        this.setState({
            isLoading: false,
            isRefreshing: false,
            isLoadMore: false,
            items
        });
        this.loadMoreAble = response.data.items.length === 20;
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
                onPress={() => {
                    this.props.navigation.navigate('PostDetail', {aid: item.aid});
                }}
            >
                <View style={{flex: 1}}>
                    <Text style={{fontSize: 16, fontWeight: '400', color: '#333'}} numberOfLines={2}>{item.title}</Text>
                    <View style={{flex: 1}}/>
                    <View style={{flexDirection: 'row', marginTop: 15}}>
                        <Text style={{fontSize: 12, color: '#666', flex: 1}}>{item.created_at}</Text>
                        <Text style={{fontSize: 12, color: '#333'}}>{item.views}次阅读</Text>
                    </View>
                </View>
            </TouchableOpacity>
        );
    };
}

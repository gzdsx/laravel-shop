import React from 'react';
import {View, FlatList, TouchableOpacity, Text} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import PropTypes from 'prop-types';
import {ApiClient} from "../../utils";
import {Size} from "../../styles";


export default class LiveListComponent extends React.Component {

    static propTypes = {
        channel_id: PropTypes.number,
        onPressItem: PropTypes.func
    };

    static defaultProps = {
        channel_id: 0,
        onPressItem: () => null
    };

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
            keyExtractor={(item) => item.id.toString()}
            data={this.state.items}
            renderItem={({item}) => this.renderItem(item)}
            refreshing={this.state.isRefreshing}
            onRefresh={this.onRefresh}
            onEndReached={this.onEndReached}
            onEndReachedThreshold={2}
            ListEmptyComponent={() => {
                return (
                    <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                        <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>没有此类直播内容</Text>
                    </View>
                );
            }}
            numColumns={2}
            style={{backgroundColor:'#fff'}}
        />
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = async () => {
        const offset = this.offset;
        const channel_id = this.props.channel_id;

        let items = this.state.items;
        let response = await ApiClient.get('/live/batchget', {offset, channel_id});
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
                    width: Size.screenWidth / 2,
                    height: 180
                }}
                onPress={() => this.props.onPressItem(item)}
            >
                {
                    item.image ?
                        <CacheImage
                            source={{uri: item.image}}
                            style={{
                                resizeMode: 'cover',
                                flex: 1
                            }}
                        />
                        : null
                }
                <View style={{marginTop: 10}}>
                    <Text style={{fontSize: 16, fontWeight: '400', color: '#333'}} numberOfLines={2}>{item.title}</Text>
                </View>
            </TouchableOpacity>
        );
    };
}

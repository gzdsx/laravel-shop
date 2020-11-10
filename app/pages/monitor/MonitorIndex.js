import React from 'react';
import {FlatList, Text, TouchableOpacity, View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {LoadingView} from "react-native-dsxui";
import {ApiClient} from "../../utils";
import {TableCell} from "react-native-dsxui";

export default class MonitorIndex extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '远程监控',
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
            style={{backgroundColor: '#fff'}}
        />
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = async () => {
        const offset = this.offset;
        const typeid = this.props.typeid;

        let items = this.state.items;
        let response = await ApiClient.get('/school/batchget', {offset, typeid});
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
            <TableCell
                title={item.title}
                isLink={true}
                onPress={() => {
                    this.props.navigation.navigate('MonitorList', {school_id: item.id});
                }}
            />
        );
    };
}

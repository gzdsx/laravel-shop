import React from 'react';
import {FlatList, StyleSheet, Text, View} from 'react-native';
import ListComponent from "../../../components/ListComponent";
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {ListItem} from "react-native-elements";
import moment from "moment";
import {Swipeable, RectButton} from "react-native-gesture-handler";
import {ApiClient} from "../../../utils";
import Empty from "../../../components/Empty";

export default class PostSubscribe extends ListComponent {

    listApi = '/post/subscribe.getList';

    constructor(props) {
        super(props);
    }

    componentDidMount(): void {
        this.fetchList();
    }

    render(): React.ReactNode {
        let {navigation} = this.props;
        let {loading, refreshing, dataList} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <FlatList
                data={dataList}
                renderItem={({item, index}) => (
                    <View style={{backgroundColor: '#f00'}}>
                        <Swipeable
                            rightThreshold={0.2}
                            renderRightActions={() => (
                                <RectButton
                                    style={styles.deleteButton}
                                    onPress={() => {
                                        ApiClient.post('/post/subscribe.delete', {aid: item.aid}).then(() => {
                                            dataList.splice(index, 1);
                                            this.setState({dataList});
                                        }).catch(reason => {
                                            Toast.fail(reason.errMsg);
                                        })
                                    }}
                                >
                                    <Text style={styles.deleteText}>删除</Text>
                                </RectButton>
                            )}
                        >
                            <ListItem
                                containerStyle={styles.row}
                                onPress={() => {
                                    navigation && navigation.navigate('post-detail', {aid: item.aid});
                                }}
                            >
                                <ListItem.Content>
                                    <ListItem.Title style={styles.title}>{item.title}</ListItem.Title>
                                    <ListItem.Subtitle style={styles.subTitle}>
                                        收藏时间:{moment(item.subscribe.created_at).format('yyyy-MM-DD HH:MM:ss')}
                                    </ListItem.Subtitle>
                                </ListItem.Content>
                            </ListItem>
                        </Swipeable>
                    </View>
                )}
                keyExtractor={(item, index) => index.toString()}
                refreshing={refreshing}
                onRefresh={this.onRefresh}
                onEndReached={this.onEndReached}
                onEndReachedThreshold={0.2}
                ListEmptyComponent={() => (
                    <Empty description={'暂无收藏记录'} style={{height: 300}}/>
                )}
            />
        );
    }

}

const styles = StyleSheet.create({
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0'
    },
    title: {
        fontSize: 18,
        color: '#555'
    },
    subTitle: {
        fontSize: 14,
        color: '#838383',
        marginTop: 10
    },
    deleteButton: {
        width: 80,
        backgroundColor: '#f00',
        alignItems: 'center',
        justifyContent: 'center',
    },
    deleteText: {
        fontSize: 16,
        color: '#fff'
    }
})

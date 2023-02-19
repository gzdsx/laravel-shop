import React from 'react';
import {FlatList, StyleSheet, Text, View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {StatusBarStyles} from "../../styles";
import ListComponent from "../../components/ListComponent";
import {LoadingView} from "react-native-gzdsx-elements";
import {ListItem} from "react-native-elements";
import moment from "moment";

export default class NotificationIndex extends ListComponent {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '消息',
            headerLeft: () => null
        })
    }

    listApi = '/user/notification';

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        this.fetchList();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        let {dataList, loading, refreshing, loadingMore} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <FlatList
                data={dataList}
                keyExtractor={((item, index) => index.toString())}
                renderItem={({item, index}) => {
                    return (
                        <ListItem containerStyle={styles.row}>
                            <ListItem.Content>
                                <View style={{flexDirection: 'row'}}>
                                    <ListItem.Title style={styles.from}>{item.data.from}</ListItem.Title>
                                    <Text style={styles.time}>{moment(item.updated_at).format('yy/M/D')}</Text>
                                </View>
                                <ListItem.Subtitle style={styles.message}>{item.data.message}</ListItem.Subtitle>
                            </ListItem.Content>
                        </ListItem>
                    )
                }}
                refreshing={refreshing}
                onRefresh={this.onRefresh}
                onEndReachedThreshold={0.2}
                onEndReached={this.onEndReached}
            />
        );
    }

}


const styles = StyleSheet.create({
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#e9e9e9',
        paddingVertical: 15
    },
    from: {
        fontSize: 18,
        color: '#333',
        flex: 1
    },
    message: {
        fontSize: 14,
        color: '#666',
        marginTop: 8
    },
    time: {
        fontSize: 14,
        color: '#939393'
    }
})

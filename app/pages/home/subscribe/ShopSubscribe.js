import React from 'react';
import {FlatList, StyleSheet, Text, View} from 'react-native';
import ListComponent from "../../../components/ListComponent";
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {ListItem} from "react-native-elements";
import FastImage from "react-native-fast-image";
import {Swipeable, RectButton} from "react-native-gesture-handler";
import Empty from "../../../components/Empty";
import {ApiClient} from "../../../utils";

export default class ShopSubscribe extends ListComponent {

    listApi = '/ecom/shop.subscribe.getList';

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
                    <View style={styles.swipeWrap}>
                        <Swipeable
                            rightThreshold={0.2}
                            renderRightActions={() => (
                                <RectButton
                                    style={styles.rectButton}
                                    onPress={() => {
                                        ApiClient.post('/ecom/shop.subscribe.delete', {shop_id: item.shop_id}).then(() => {
                                            dataList.splice(index, 1);
                                            this.setState({dataList});
                                        }).catch(reason => {
                                            Toast.fail(reason.errMsg);
                                        });
                                    }}
                                >
                                    <Text style={styles.buttonText}>取消关注</Text>
                                </RectButton>
                            )}
                        >
                            <ListItem
                                containerStyle={styles.row}
                                onPress={() => {
                                    navigation && navigation.navigate('shop-detail', {shop_id: item.shop_id});
                                }}
                            >
                                <FastImage
                                    source={{uri: item.logo}}
                                    style={styles.logo}
                                />
                                <ListItem.Content>
                                    <ListItem.Title style={styles.shopName}>{item.shop_name}</ListItem.Title>
                                    <ListItem.Subtitle
                                        style={styles.subTitle}>{item.subscribe_count}人关注</ListItem.Subtitle>
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
                ListEmptyComponent={<Empty description={"暂无记录"} style={{height: 300}}/>}
            />
        );
    }

}

const styles = StyleSheet.create({
    swipeWrap: {
        backgroundColor: '#f00'
    },
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0'
    },
    logo: {
        width: 50,
        height: 50,
        borderRadius: 25
    },
    shopName: {
        fontSize: 16,
        fontWeight: '500'
    },
    subTitle: {
        fontSize: 14,
        color: '#838383',
        marginTop: 8
    },
    rectButton: {
        width: 120,
        alignItems: 'center',
        justifyContent: 'center'
    },
    buttonText: {
        color: '#fff',
        fontSize: 16
    }
})

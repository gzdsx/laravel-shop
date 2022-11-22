import React from 'react';
import {FlatList, StyleSheet, Text, View} from 'react-native';
import ListComponent from "../../../components/ListComponent";
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import {ListItem} from "react-native-elements";
import FastImage from "react-native-fast-image";
import {Swipeable, RectButton} from "react-native-gesture-handler";
import {ApiClient} from "../../../utils";
import Empty from "../../../components/Empty";

export default class ProductSubscribe extends ListComponent {

    listApi = '/ecom/product.subscribe.getList';

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
                                        ApiClient.post('/ecom/product.subscribe.delete', {itemid: item.itemid}).then(() => {
                                            dataList.splice(index, 1);
                                            this.setState({dataList});
                                        }).catch(reason => {
                                            Toast.fail(reason.errMsg);
                                        })
                                    }}
                                >
                                    <Text style={styles.buttonText}>取消收藏</Text>
                                </RectButton>
                            )}
                        >
                            <ListItem
                                containerStyle={styles.row}
                                onPress={() => {
                                    navigation && navigation.navigate('product-detail', {itemid: item.itemid});
                                }}
                            >
                                <FastImage
                                    source={{uri: item.thumb}}
                                    style={styles.thumb}
                                />
                                <ListItem.Content>
                                    <View style={{flex: 1}}>
                                        <ListItem.Title style={styles.title}>{item.title}</ListItem.Title>
                                        <ListItem.Subtitle style={styles.subTitle}>1人收藏</ListItem.Subtitle>
                                    </View>
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
                ListEmptyComponent={<Empty description={'暂无记录'} style={{height: 300}}/>}
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
    thumb: {
        width: 150,
        height: 150,
        borderRadius: 10
    },
    title: {
        fontSize: 18,
        fontWeight: '400'
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

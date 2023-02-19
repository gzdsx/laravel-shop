import React from 'react';
import {SafeAreaView, ScrollView, StyleSheet, Text, View} from 'react-native';
import {LoadingView} from "react-native-gzdsx-elements";
import FastImage from "react-native-fast-image";
import {ListItem} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";

export default class RefundRouter extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '选择服务',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            dataList: []
        };
    }

    render(): React.ReactNode {
        if (this.state.loading) return <LoadingView/>;

        const {navigation} = this.props;
        return (
            <SafeAreaView style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <View style={styles.section}>
                        <ListItem containerStyle={styles.sectionRow}>
                            <ListItem.Title style={styles.sesctionHeader}>退款商品</ListItem.Title>
                        </ListItem>
                        {this.renderItems()}
                    </View>
                    <View style={styles.section}>
                        <ListItem containerStyle={styles.sectionRow}>
                            <ListItem.Title style={styles.sesctionHeader}>选择服务类型</ListItem.Title>
                        </ListItem>
                        <ListItem
                            onPress={() => this.showForm(1)}
                            containerStyle={styles.sectionRow}
                        >
                            <ListItem.Content>
                                <ListItem.Title style={styles.title}>我要退款(无需退货)</ListItem.Title>
                                <ListItem.Subtitle style={styles.subTitle}>没收到货，或与卖家协商同意不用退货只退款</ListItem.Subtitle>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem
                            onPress={() => this.showForm(2)}
                            containerStyle={styles.sectionRow}
                        >
                            <ListItem.Content>
                                <ListItem.Title style={styles.title}>我要退货退款</ListItem.Title>
                                <ListItem.Subtitle style={styles.subTitle}>已收到货，需要退还收到的货物</ListItem.Subtitle>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                    </View>
                </ScrollView>
            </SafeAreaView>
        );
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        const {trade_id, order_id} = this.props.route.params;
        if (trade_id) {
            ApiClient.get('/trade/bought.getTradeDetail', {trade_id}).then(response => {
                this.setState({
                    loading: false,
                    dataList: [response.result]
                })
            });
        } else {
            ApiClient.get('/trade/bought.getTradeList', {order_id}).then(response => {
                this.setState({
                    loading: false,
                    dataList: response.result.items
                });
            });
        }
    }

    renderItems = () => {
        let {dataList} = this.state;
        let contents = dataList.map((item, index) => (
            <ListItem key={index.toString()}>
                <FastImage source={{uri: item.image}} style={{
                    width: 80,
                    height: 80,
                    borderRadius: 3,
                    marginRight: 10
                }}/>
                <ListItem.Content>
                    <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                    <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                    <View style={{flex: 1}}/>
                    <View style={{flexDirection: 'row'}}>
                        <Text style={{fontSize: 14, color: '#333', flex: 1}}>￥{item.price}</Text>
                        <Text style={{fontSize: 14, color: '#333'}}>x{item.quantity}</Text>
                    </View>
                </ListItem.Content>
            </ListItem>
        ))

        return <View>{contents}</View>;
    }

    showForm = (refund_type) => {
        let {order_id, trade_id} = this.props.route.params;
        this.props.navigation.push('refund-apply', {refund_type, order_id, trade_id});
    }
}

const styles = StyleSheet.create({
    section: {
        marginBottom: 10
    },
    sesctionHeader: {
        fontSize: 18,
        fontWeight: '500'
    },
    sectionRow: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#e5e5e5',
        paddingVertical: 16
    },
    title: {
        fontSize: 16,
        color: '#333'
    },
    subTitle: {
        fontSize: 14,
        color: '#666',
        marginTop: 8
    }
})

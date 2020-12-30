import React from 'react';
import {ScrollView, Text, View} from 'react-native';
import {LoadingView, TableCell, TableView, CheckBox, Toast} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {defaultNavigationConfigure} from "../../base/navconfig";

import {ApiClient} from "../../utils";

export default class RefundApply extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '选择服务',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            order: {},
            items: [],
            loading: true
        };
    }


    render(): React.ReactNode {
        const {order, loading} = this.state;
        const {navigation} = this.props;
        if (loading) return <LoadingView/>;

        return (
            <ScrollView style={{flex: 1}}>
                <TableView>
                    <TableCell touchAble={false}>
                        <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>退款商品</Text>
                    </TableCell>
                    {this.renderItems()}
                </TableView>
                <TableView>
                    <TableCell touchAble={false}>
                        <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>选择服务类型</Text>
                    </TableCell>
                    <TableCell onPress={() => this.showForm(1)}>
                        <TableCell.Content>
                            <TableCell.Title title={"我要退款(无需退货)"}/>
                            <TableCell.SubTitle title={"没收到货，或与卖家协商同意不用退货只退款"} style={{marginTop: 5}}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => this.showForm(2)}>
                        <TableCell.Content>
                            <TableCell.Title title={"我要退货退款"}/>
                            <TableCell.SubTitle title={"已收到货，需要退还收到的货物"} style={{marginTop: 5}}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                </TableView>
                <Toast ref={'toast'}/>
            </ScrollView>
        );
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        const item = this.props.route.params?.item;
        this.setState({
            items: [item],
            loading: false
        });
    }

    renderItems = () => {
        let {items} = this.state;
        let contents = items.map((item, index) => {
            return (
                <View style={{
                    padding: 15,
                    flexDirection: 'row'
                }} key={index.toString()}>
                    <CacheImage source={{uri: item.thumb}} style={{
                        width: 80,
                        height: 80,
                        borderRadius: 3,
                        marginRight: 10
                    }}/>
                    <View style={{flex: 1, flexDirection: 'column'}}>
                        <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                        <View style={{flex: 1}}>
                            <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                        </View>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{fontSize: 14, color: '#333', flex: 1}}>￥{item.price}</Text>
                            <Text style={{fontSize: 14, color: '#333'}}>x{item.quantity}</Text>
                        </View>
                    </View>
                </View>
            );
        })

        return <View>{contents}</View>;
    }

    showForm = (refund_type) => {
        let {items} = this.state;
        this.props.navigation.navigate('RefundForm', {refund_type, items});
    }
}

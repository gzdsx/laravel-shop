import React from 'react';
import {KeyboardAvoidingView, ScrollView, Text, View} from 'react-native';
import {LoadingView, Spinner, TableCell, TableView, TextField, Toast} from "react-native-gzdsx-elements";
import ActionSheet from "react-native-actionsheet";
import {Button} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {ButtonStyles} from "../../styles/ButtonStyles";
import {isAndroid} from "../../base/constants";

export default class RefundSend extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '退货',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            refund: {},
            shipping: {},
            expresses: [],
            loading: true
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        ApiClient.get('/express/getall').then(response => {
            let expresses = response.result.items;
            this.setState({expresses});
        });

        let {refund_id} = this.props.route.params;
        ApiClient.get('/refund/get', {refund_id}).then(response => {
            //console.log(response.result);
            let {refund} = response.result;
            let {shipping} = refund;
            this.setState({
                refund,
                shipping: {...shipping},
                loading: false
            });
        });
    }

    render(): React.ReactNode {
        let {refund, shipping, expresses, loading} = this.state;
        let expressOptions = expresses.map((express) => express.name).concat(['取消']);
        if (loading) return <LoadingView/>;
        return (
            <KeyboardAvoidingView style={{flex: 1}} behavior={isAndroid ? "height" : "padding"}>
                <ScrollView style={{flex: 1}}>
                    <TableView>
                        <TableCell touchAble={false}>
                            <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>退货地址</Text>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"收货人"} titleStyle={{fontSize: 14}}/>
                            <TableCell.Detail text={shipping.name}/>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"联系电话"} titleStyle={{fontSize: 14}}/>
                            <TableCell.Detail text={shipping.tel}/>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"收货地址"} style={{minWidth: 80}} titleStyle={{fontSize: 14}}/>
                            <TableCell.Detail text={shipping.full_address} textStyle={{width: 280}}/>
                            <View/>
                        </TableCell>
                    </TableView>
                    {this.renderShipping()}
                </ScrollView>
                <View style={{backgroundColor: '#fff', paddingHorizontal: 15, paddingVertical: 7}}>
                    <Button
                        title={"提交"}
                        buttonStyle={[ButtonStyles.primary, {borderRadius: 20}]}
                        onPress={this.submit}
                    />
                </View>
                <ActionSheet
                    ref={'as'}
                    options={expressOptions}
                    cancelButtonIndex={expresses.length}
                    onPress={(index) => {
                        if (index < expresses.length) {
                            let express = expresses[index];
                            shipping.express_name = express.name;
                            shipping.express_code = express.code;
                            this.setState({shipping});
                        }
                    }}
                />
                <Toast ref={'toast'}/>
                <Spinner ref={'spinner'}/>
            </KeyboardAvoidingView>
        );
    }

    renderShipping = () => {
        let {shipping} = this.state;
        return (
            <TableView>
                <TableCell touchAble={false}>
                    <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>退货物流</Text>
                </TableCell>
                <TableCell onPress={() => {
                    this.refs.as.show();
                }}>
                    <TableCell.Title title={"快递名称"} titleStyle={{fontSize: 14}}/>
                    <TableCell.Detail text={shipping.express_name ? shipping.express_name : "请选择"}/>
                    <TableCell.Accessory/>
                </TableCell>
                <TextField
                    defaultValue={shipping.express_no}
                    containerStyle={{
                        borderBottomWidth: 0,
                        paddingHorizontal: 15,
                    }}
                    inputStyle={{
                        fontSize: 14,
                        textAlign: 'right',
                    }}
                    inputContainerStyle={{height: 40, width: 100, flex: 0}}
                    keyboardType={'numeric'}
                    onChangeText={text => {
                        shipping.express_no = text;
                        this.setState({shipping});
                    }}
                    numberOfLines={1}
                    label={"快递单号"}
                    labelStyle={{fontSize: 14}}
                    labelContainerStyle={{flex:1}}
                    placeholder={"请填写快递单号"}
                />
            </TableView>
        )
    }

    submit = async () => {
        let {refund, shipping} = this.state;
        let {refund_id} = refund;
        let {express_name, express_no} = shipping;
        if (!express_name) {
            this.refs.toast.show('请选择快递公司');
            return false;
        }

        if (!express_no) {
            this.refs.toast.show('请填写快递单号');
            return false;
        }

        ApiClient.post('/refund/send', {refund_id, shipping}).then(response => {
            //console.log(response);
            this.props.navigation.replace('RefundDetail', {refund_id});
        }).catch(reason => {
        });
    }
}

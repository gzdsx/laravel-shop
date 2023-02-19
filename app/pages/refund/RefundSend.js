import React from 'react';
import {ScrollView, StyleSheet, View} from 'react-native';
import {LoadingView, Toast} from "react-native-gzdsx-elements";
import ActionSheet from "react-native-actionsheet";
import {Button, ListItem} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {ButtonStyles} from "../../styles";
import {SafeFooter} from "../../components/SafeView";

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
            expresses: [],
            address: {},
            express_name: '',
            express_code: '',
            express_no: '',
            loading: true
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        ApiClient.get('/common/express.getList').then(response => {
            let expresses = response.result.items;
            this.setState({expresses});
        });

        ApiClient.get('/trade/refund.getAddress').then(response => {
            let address = response.result;
            this.setState({address, loading: false});
        });
    }

    render(): React.ReactNode {
        let {expresses, loading} = this.state;
        let expressOptions = expresses.map((express) => express.name).concat(['取消']);
        if (loading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    {this.renderAddress()}
                    {this.renderWuliu()}
                </ScrollView>
                <View style={{backgroundColor: '#fff', paddingHorizontal: 15, paddingVertical: 7}}>
                    <Button
                        title={"提交"}
                        buttonStyle={[ButtonStyles.primary, {borderRadius: 20}]}
                        onPress={this.submit}
                    />
                    <SafeFooter/>
                </View>
                <ActionSheet
                    ref={'as'}
                    options={expressOptions}
                    cancelButtonIndex={expresses.length}
                    onPress={(index) => {
                        if (index < expresses.length) {
                            let express = expresses[index];
                            let express_name = express.name;
                            let express_code = express.code;
                            this.setState({
                                express_name,
                                express_code
                            });
                        }
                    }}
                />
            </View>
        );
    }

    renderAddress = () => {
        let {address} = this.state;
        return (
            <View style={{backgroundColor: '#fff'}}>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Title style={styles.sectionTitle}>退货地址</ListItem.Title>
                    </ListItem.Content>
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Title style={styles.title}>收货人</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle style={styles.subTitle}>{address.name}</ListItem.Subtitle>
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Title style={styles.title}>联系电话</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle style={styles.subTitle}>{address.phone}</ListItem.Subtitle>
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Subtitle style={styles.subTitle}>{address.formatted_address}</ListItem.Subtitle>
                    </ListItem.Content>
                </ListItem>
            </View>
        )
    }

    renderWuliu = () => {
        let {express_name} = this.state;
        return (
            <View style={{marginTop: 10, backgroundColor: '#fff'}}>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Title style={styles.sectionTitle}>退货物流</ListItem.Title>
                    </ListItem.Content>
                </ListItem>
                <ListItem
                    onPress={() => {
                        this.refs.as.show();
                    }}
                >
                    <ListItem.Content>
                        <ListItem.Title style={styles.title}>快递名称</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle
                        style={styles.title}>{express_name ? express_name : "请选择"}</ListItem.Subtitle>
                    <ListItem.Chevron/>
                </ListItem>
                <ListItem>
                    <ListItem.Title style={styles.title}>快递单号</ListItem.Title>
                    <ListItem.Content>
                        <ListItem.Input
                            placeholder={"请填写快递单号"}
                            onChangeText={text => {
                                let express_no = text;
                                this.setState({express_no});
                            }}
                            inputStyle={{
                                fontSize: 16,
                            }}
                        />
                    </ListItem.Content>
                </ListItem>
            </View>
        )
    }

    submit = async () => {
        let {refund_id} = this.props.route.params;
        let {express_name, express_code, express_no, address} = this.state;
        if (!express_name) {
            Toast.fail('请选择快递公司');
            return false;
        }

        if (!express_no) {
            Toast.show('请填写快递单号');
            return false;
        }

        ApiClient.post('/trade/refund.send', {
            refund_id,
            express_name,
            express_code,
            express_no,
            address
        }).then(() => {
            //console.log(response);
            this.props.navigation.replace('refund-detail', {refund_id});
        }).catch(reason => {
            console.log(reason);
        });
    }
}


const styles = StyleSheet.create({
    sectionTitle: {
        fontSize: 18,
        fontWeight: '600'
    },
    title: {
        fontSize: 16,
        color: '#333'
    },
    subTitle: {
        fontSize: 14,
        color: '#666'
    }
})

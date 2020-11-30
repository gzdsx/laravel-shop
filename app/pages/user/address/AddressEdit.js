import React from 'react';
import {ScrollView, View, Text, TextInput, DeviceEventEmitter, StyleSheet, TouchableOpacity} from 'react-native';
import {Ticon} from "react-native-ticon";
import {Button, Input} from 'react-native-elements';
import {CustomTextInput, CustomButton} from "../../../components";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {Toast, Validate, ApiClient, Utils} from '../../../utils';
import {Colors} from '../../../styles';

const LabelView = ({text, style = {}}) => {
    return (
        <View style={{
            width: 80,
            marginRight: 8,
            alignContent: 'center',
            justifyContent: 'center'
        }}>
            <Text style={{
                color: '#333',
                fontSize: 16,
                ...style
            }}>{text}</Text>
        </View>
    );
};

const TextInputView = ({...props}) => {
    return (
        <View style={{flex: 1}}>
            <TextInput
                underlineColorAndroid={"transparent"}
                placeholderTextColor={"#999"}
                returnKeyType={"done"}
                style={{
                    flex: 1,
                    borderWidth: 0,
                    textAlignVertical: 'center',
                    fontSize: 16
                }}
                {...props}
            />
        </View>
    );
};

export default class AddressEdit extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            address: {
                consignee: '',
                phone: '',
                province: '',
                city: '',
                district: '',
                street: '',
                isdefault: 0
            },
        };

        this.submiting = false;
    }


    render() {
        let {address} = this.state;
        let district;
        if (address.province && address.city && address.district) {
            district = address.province + '/' + address.city + '/' + address.district;
        } else {
            district = '选择所在区域';
        }
        return (
            <ScrollView>
                <View style={css.formGroup}>
                    <LabelView text={"收货人"}/>
                    <View style={css.cellInput}>
                        <CustomTextInput
                            placeholder={"真实姓名"}
                            onChangeText={(text) => {
                                this.setState({
                                    address: {
                                        ...address,
                                        consignee: text
                                    }
                                });
                            }}
                            defaultValue={address.name}
                        />
                    </View>
                </View>
                <View style={css.formGroup}>
                    <LabelView text={"联系电话"}/>
                    <View style={css.cellInput}>
                        <CustomTextInput
                            placeholder={"手机号码"}
                            onChangeText={(text) => {
                                address.phone = text;
                                this.setState({address});
                            }}
                            keyboardType={"phone-pad"}
                            defaultValue={address.tel}
                        />
                    </View>
                </View>
                <View style={css.formGroup}>
                    <LabelView text={"所在区域"}/>
                    <TouchableOpacity
                        style={css.cellInput}
                        activeOpacity={1}
                        onPress={() => {
                            this.props.navigation.navigate('DistrictSelector');
                        }}
                    >
                        <Text
                            style={{
                                color: '#333',
                                fontSize: 16,
                            }}
                        >{district}</Text>
                    </TouchableOpacity>
                </View>
                <View style={css.formGroup}>
                    <LabelView text={"街道地址"}/>
                    <View style={css.cellInput}>
                        <CustomTextInput
                            placeholder={"社区,街道,门牌号"}
                            onChangeText={(text) => {
                                address.street = text;
                                this.setState({address});
                            }}
                            defaultValue={address.street}
                        />
                    </View>
                </View>
                <View style={css.formGroup}>
                    <LabelView text={"设为默认"}/>
                    <View style={{flex: 1, alignItems: 'flex-end'}}>
                        <Ticon
                            name={address.isdefault ? "round-check-fill" : "round-check"}
                            size={24} color={address.isdefault ? Colors.primary : "#666"}
                            onPress={() => {
                                address.isdefault = address.isdefault === 1 ? 0 : 1;
                                this.setState({address});
                            }}
                        />
                    </View>
                </View>
                <View style={{padding: 20}}>
                    <Button
                        title={"提交"}
                        buttonStyle={{backgroundColor: Colors.primary, height: 40}}
                        onPress={this.submit}
                    />
                </View>
            </ScrollView>
        );
    }


    componentDidMount() {
        const {navigation,route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '编辑收货地址',
        });

        let {address} = this.state;
        DeviceEventEmitter.addListener('onPickedDistrict', (dst) => {
            const {province,city,district} = dst;
            address = {
                ...address,
                province,
                city,
                district
            }
            this.setState({address});
        });

        const address_id = route?.params.address_id;
        if (address_id) {
            ApiClient.get('/address/get', {address_id}).then(response => {
                this.setState({
                    address: response.data.address
                });
            });
        }
    }

    componentWillUnmount() {
        DeviceEventEmitter.removeAllListeners('onPickedDistrict');
    }

    submit = () => {
        const {address} = this.state;
        const {address_id} = address;

        if (this.submiting) {
            return false;
        }

        if (!Validate.IsChineseName(address.name)) {
            Toast.show('请填写收货人姓名');
            return false;
        }

        if (!Validate.IsMobile(address.tel)) {
            Toast.show('手机号码填写错误');
            return false;
        }

        if (!address.province || !address.city) {
            Toast.show('请选择所在区域');
            return false;
        }

        if (!address.street) {
            Toast.show('请填写街道地址');
            return false;
        }

        this.submiting = true;
        ApiClient.post('/address/save', {address, address_id}).then(response => {
            this.submiting = false;
            Toast.show('地址保存成功', {
                onHidden: () => {
                    const callback = this.props.route?.params.callback;
                    if (typeof callback === 'function') {
                        callback(address);
                    }
                    this.props.navigation.goBack();
                }
            });
        }).then(error => {
            this.submiting = false;
        });
    }
}

const css = StyleSheet.create({
    formGroup: {
        padding: 15,
        flexDirection: 'row',
        borderBottomColor: '#e5e5e5',
        borderBottomWidth: 0.5
    },
    cellLabel: {
        width: 80,
        justifyContent: 'center'
    },
    cellInput: {
        flex: 1,
        justifyContent: 'center',
        alignContent: 'center'
    }
});

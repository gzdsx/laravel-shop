import React from 'react';
import {ScrollView, View, Text, DeviceEventEmitter, TouchableOpacity} from 'react-native';
import {Button} from 'react-native-elements';
import {Toast, TextField, TableCell, CheckBox, LoadingView} from 'react-native-gzdsx-elements';
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {Validate, ApiClient, Utils} from '../../../utils';
import {ButtonStyles} from "../../../styles/ButtonStyles";

export default class AddressEdit extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            address: {
                name: '',
                tel: '',
                province: '',
                city: '',
                district: '',
                street: '',
                isdefault: 0
            },
            isLoading: true
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
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <ScrollView style={{paddingHorizontal: 15, backgroundColor: '#fff'}}>
                <TextField
                    label={"收货人"}
                    placeholder={"真实姓名"}
                    onChangeText={(text) => {
                        address.name = text;
                        this.setState({address});
                    }}
                    defaultValue={address.name}
                />
                <TextField
                    label={"联系电话"}
                    placeholder={"手机号码"}
                    onChangeText={(text) => {
                        address.tel = text;
                        this.setState({address});
                    }}
                    keyboardType={"phone-pad"}
                    defaultValue={address.tel}
                />
                <TextField
                    label={"所在区域"}
                    Component={false}
                    rightComponent={
                        <TouchableOpacity
                            style={{
                                flexDirection: 'row',
                                flex: 1,
                                minHeight: 40,
                                alignContent: 'center',
                                justifyContent: 'center'
                            }}
                            activeOpacity={1}
                            onPress={() => {
                                this.props.navigation.navigate('DistrictSelector');
                            }}
                        >
                            <View style={{flex: 1, justifyContent: 'center'}}>
                                <Text style={{
                                    color: '#333',
                                    fontSize: 16,
                                    textAlignVertical: 'center'
                                }}>{district}</Text>
                            </View>
                            <TableCell.Accessory/>
                        </TouchableOpacity>
                    }
                />
                <TextField
                    label={"街道地址"}
                    placeholder={"社区,街道,门牌号"}
                    onChangeText={(text) => {
                        address.street = text;
                        this.setState({address});
                    }}
                    defaultValue={address.street}
                />
                <TextField
                    label={"设为默认"}
                    labelContainerStyle={{flex: 1}}
                    Component={null}
                    rightComponent={
                        <View style={{minHeight: 40, alignContent: 'center', justifyContent: 'center'}}>
                            <CheckBox
                                checked={address.isdefault === 1}
                                size={24}
                                onPress={() => {
                                    address.isdefault = address.isdefault === 1 ? 0 : 1;
                                    this.setState({address});
                                }}
                            />
                        </View>
                    }
                />
                <View style={{marginTop: 40}}>
                    <Button
                        title={"提交"}
                        buttonStyle={ButtonStyles.primary}
                        onPress={this.submit}
                    />
                </View>
                <Toast ref={"toast"}/>
            </ScrollView>
        );
    }


    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '编辑收货地址',
        });


        DeviceEventEmitter.addListener('onPickedDistrict', (dist) => {
            let {address} = this.state;
            let {province, city, district} = dist;
            address = {
                ...address,
                province,
                city,
                district
            }
            this.setState({address});
        });

        const address_id = route.params?.address_id || 0;
        if (address_id) {
            ApiClient.get('/address/get', {address_id}).then(response => {
                this.setState({
                    address: response.data.address,
                    isLoading: false
                });
            });
        } else {
            this.setState({
                isLoading: false
            });
        }
    }

    componentWillUnmount() {
        DeviceEventEmitter.removeAllListeners('onPickedDistrict');
    }

    submit = () => {
        const {address} = this.state;
        const {address_id} = address;
        console.log(address);

        if (this.submiting) {
            return false;
        }

        if (!address.name){
            this.refs.toast.show('请填写收货人姓名');
            return false;
        }

        if (!Validate.IsChineseName(address.name)) {
            this.refs.toast.show('收货人姓名填写不正确');
            return false;
        }

        if (!address.tel){
            this.refs.toast.show('请填写联系电话');
            return false;
        }

        if (!Validate.IsMobile(address.tel)) {
            this.refs.toast.show('手机号码填写错误');
            return false;
        }

        if (!address.province || !address.city) {
            this.refs.toast.show('请选择所在区域');
            return false;
        }

        if (!address.street) {
            this.refs.toast.show('请填写街道地址');
            return false;
        }

        this.submiting = true;
        ApiClient.post('/address/save', {address, address_id}).then(response => {
            console.log(response.data);
            this.refs.toast.show('地址保存成功', {
                onHide: () => {
                    this.props.navigation.goBack();
                }
            });
        }).then(error => {
            this.submiting = false;
        });
    }
}

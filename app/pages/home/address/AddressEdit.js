import React from 'react';
import {
    DeviceEventEmitter,
    SafeAreaView,
    ScrollView,
    StyleSheet,
    Text,
    TouchableOpacity
} from 'react-native';
import {ListItem} from "react-native-elements";
import {Toast} from "react-native-gzdsx-elements";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ApiClient} from "../../../utils";
import {StatusBarStyles} from "../../../styles";

export default class AddressEdit extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '编辑地址',
            headerRight: () => (
                <TouchableOpacity
                    activeOpacity={0.8}
                    onPress={this.submit}
                >
                    <Text style={{fontSize: 18, color: '#333'}}>完成</Text>
                </TouchableOpacity>
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            address: {}
        };
    }

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        this.listener = DeviceEventEmitter.addListener('onChooseLocation', res => {
            //console.log(res);
            let {address} = this.state;
            let {province, city, district, street, longitude, latitude} = res;
            this.setState({
                address: {
                    ...address,
                    province,
                    city,
                    district,
                    street,
                    longitude,
                    latitude
                }
            });
        });

        let id = this.props.route.params?.id;
        if (id) {
            ApiClient.get('/user/address.getInfo', {id}).then(response => {
                let address = response.result;
                this.setState({address});
            });
        }
    }

    componentWillUnmount() {
        this.unsubscribe();
        this.listener.remove();
    }

    render(): React.ReactNode {
        let {navigation, route} = this.props;
        let {address} = this.state;
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#fff'}}>
                <ScrollView style={styles.scrollView}>
                    <ListItem containerStyle={styles.section}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.label}>收货人姓名</ListItem.Title>
                            <ListItem.Input
                                placeholder={"请输入"}
                                inputStyle={styles.input}
                                containerStyle={styles.inputContainer}
                                renderErrorMessage={false}
                                defaultValue={address.name}
                                onChangeText={text => {
                                    address.name = text;
                                    this.setState({address});
                                }}
                            />
                        </ListItem.Content>
                    </ListItem>
                    <ListItem containerStyle={styles.section}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.label}>收货人联系电话</ListItem.Title>
                            <ListItem.Input
                                placeholder={"请输入"}
                                inputStyle={styles.input}
                                containerStyle={styles.inputContainer}
                                renderErrorMessage={false}
                                defaultValue={address.phone}
                                keyboardType={'number-pad'}
                                onChangeText={text => {
                                    address.phone = text;
                                    this.setState({address});
                                }}
                            />
                        </ListItem.Content>
                    </ListItem>
                    <ListItem containerStyle={styles.section} onPress={() => {
                        navigation.navigate('choose-location', {title: '选择收货地址'});
                    }}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.label}>省/市/区县</ListItem.Title>
                            <ListItem.Input
                                placeholder={"请选择"}
                                inputStyle={styles.input}
                                containerStyle={styles.inputContainer}
                                renderErrorMessage={false}
                                editable={false}
                                defaultValue={[address.province, address.city, address.district].join('')}
                                pointerEvents={'none'}
                            />
                        </ListItem.Content>
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={styles.section}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.label}>详细地址</ListItem.Title>
                            <ListItem.Input
                                placeholder={"请输入"}
                                inputStyle={styles.input}
                                containerStyle={styles.inputContainer}
                                renderErrorMessage={false}
                                defaultValue={address.street}
                                onChangeText={text => {
                                    address.street = text;
                                    this.setState({address});
                                }}
                            />
                        </ListItem.Content>
                    </ListItem>
                </ScrollView>
            </SafeAreaView>
        );
    }

    submit = () => {
        let {address} = this.state;
        if (!address.name) {
            Toast.fail('请填写收货人姓名');
            return false;
        }

        if (!address.phone) {
            Toast.fail('请填写联系电话');
            return false;
        }

        if (!address.province) {
            Toast.fail('请选择地区');
            return false;
        }

        if (!address.street) {
            Toast.fail('请填写详细地址');
            return false;
        }

        let {id} = address;
        let api = id ? '/user/address.update' : '/user/address.create';
        ApiClient.post(api, {id, address}).then(() => {
            Toast.success('地址保存成功', {
                onHidden: () => {
                    this.props.navigation.goBack();
                }
            });
        }).catch(reason => {
            console.log(reason);
        });
    }
}

const styles = StyleSheet.create({
    footer: {
        backgroundColor: '#fff',
        borderTopColor: '#e2e2e2',
        borderTopWidth: 0.5,
        padding: 10
    },
    scrollView: {
        padding: 15,
        flex: 1,
        backgroundColor: '#fff'
    },
    section: {
        paddingHorizontal: 0,
        borderBottomWidth: 0.5,
        borderBottomColor: '#e2e2e2'
    },
    input: {
        textAlign: 'left'
    },
    inputContainer: {
        paddingHorizontal: 0,
    },
    label: {
        fontSize: 14,
        fontWeight: '300',
        color: '#838383',
        marginBottom: 5
    },
    locationName: {
        fontSize: 18
    },
    locationAddress: {
        fontSize: 12,
        color: '#939393',
        marginTop: 5
    }
});

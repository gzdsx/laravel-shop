import React from 'react';
import {
    View,
    Image,
    Keyboard,
    DeviceEventEmitter,
    Text,
    TouchableOpacity,
    StyleSheet,
} from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import * as WeChat from 'react-native-wechat-lib';
import {Button} from 'react-native-elements';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import {UserDidSigninedNotification} from '../../base/constants';
import {ApiClient} from '../../utils';
import {defaultNavigationConfigure} from '../../base/navconfig';
import {ButtonStyles, StatusBarStyles} from "../../styles";

class Signin extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            account: '',
            password: '',
            isWXAppInstalled: false,
        };
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '登录',
        });

        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        AsyncStorage.getItem('account').then(account => {
            this.setState({account});
        });
        AsyncStorage.getItem('password').then(password => {
            this.setState({password});
        });

        WeChat.isWXAppInstalled().then(installed => {
            if (installed) {
                this.setState({isWXAppInstalled: true});
            }
        }).catch(reason => {
            console.log(reason);
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        let {isWXAppInstalled} = this.state;
        return (
            <View style={style.container}>
                <TextField
                    placeholder="手机号/邮箱/用户名"
                    defaultValue={this.state.account}
                    onSubmitEditing={() => {
                        Keyboard.dismiss();
                    }}
                    onChangeText={(text) => {
                        this.setState({
                            account: text,
                        });
                    }}
                    style={{
                        paddingVertical: 10
                    }}
                    placeholderTextColor={"#959595"}
                    returnKeyType={"done"}
                    returnKeyLabel={"完成"}
                />
                <TextField
                    placeholder="密码"
                    defaultValue={this.state.password}
                    secureTextEntry={true}
                    onSubmitEditing={() => {
                        Keyboard.dismiss();
                    }}
                    onChangeText={(text) => {
                        this.setState({
                            password: text,
                        });
                    }}
                    style={{
                        paddingVertical: 10,
                    }}
                    placeholderTextColor={"#959595"}
                    returnKeyType={"done"}
                    returnKeyLabel={"完成"}
                />
                <View style={{height: 50}}/>
                <Button title={'登录'} onPress={this.submit} buttonStyle={ButtonStyles.primary}/>

                <View style={{
                    marginTop: 30,
                    flexDirection: 'row',
                }}>
                    <Text
                        style={style.registerText}
                        onPress={() => {
                            this.props.navigation.navigate('signup');
                        }}
                    >快速注册</Text>
                </View>
                {isWXAppInstalled && this.renderWechatLogin()}
            </View>
        );
    }

    renderWechatLogin = () => {
        if (this.state.isWXAppInstalled) {
            return (
                <View style={{
                    marginTop: 60,
                    alignItems: 'center',
                    justifyContent: 'center',
                }}>
                    <Text style={{
                        fontSize: 12,
                        color: '#888',
                        textAlign: 'center',
                    }}>使用微信账号登录</Text>
                    <TouchableOpacity
                        style={{
                            marginTop: 10,
                        }}
                        activeOpacity={1}
                        onPress={() => {
                            WeChat.sendAuthRequest('snsapi_userinfo', 'success').then(res => {
                                ApiClient.post('/wechatapp/login', {
                                    code: res.code,
                                    grant_type: 'oauth',
                                    client_id: 2,
                                }).then(response => {
                                    console.log(response.result);
                                    const {access_token} = response.result;
                                    this.doLogin(access_token);
                                });
                            }).catch(reason => {
                                console.log(reason);
                            });
                        }}
                    >
                        <Image
                            style={{
                                width: 50,
                                height: 50,
                            }}
                            source={require('../../images/common/wechat.png')}
                        />
                    </TouchableOpacity>
                </View>
            );
        }
        return null;
    };

    submit = () => {
        let {navigation} = this.props;
        let {account, password} = this.state;
        if (!account) {
            Toast.fail('请填写账号');
            return false;
        }

        if (!password) {
            Toast.fail('请填写密码');
            return false;
        }

        AsyncStorage.setItem('account', account);
        AsyncStorage.setItem('password', password);

        ApiClient.login(account, password).then((res) => {
            DeviceEventEmitter.emit(UserDidSigninedNotification);
            if (navigation.canGoBack()) {
                navigation.goBack();
            }
        }).catch(reason => {
            console.log(reason);
            Toast.fail('你输入的账号和密码不匹配');
        });
    };
}

export default Signin;

const style = StyleSheet.create({
    container: {
        backgroundColor: '#fff',
        paddingTop: 60,
        paddingLeft: 30,
        paddingRight: 20,
        flex: 1,
    },
    registerText: {
        flex: 1,
        textAlign: 'center',
        color: '#1998E0',
        fontSize: 14
    }
});

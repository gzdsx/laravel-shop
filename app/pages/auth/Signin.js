import React from 'react';
import {
    View,
    Image,
    StyleSheet,
    Keyboard,
    DeviceEventEmitter,
    Text,
    TouchableOpacity
} from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import * as WeChat from 'react-native-wechat';
import axios from 'axios';
import {Button} from "react-native-elements";
import {Toast, TextField} from "react-native-gzdsx-elements";
import {
    AccessToken,
    OauthApi,
    UserDidSigninedNotification,
    WeChatAppId
} from "../../base/constants";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors} from "../../styles";

class Signin extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            account: "",
            password: "",
            isWXAppInstalled: false
        }
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
                        textAlign: 'center'
                    }}>使用微信账号登录</Text>
                    <TouchableOpacity
                        style={{
                            marginTop: 10
                        }}
                        activeOpacity={1}
                        onPress={() => {
                            WeChat.sendAuthRequest('snsapi_userinfo', 'success').then(res => {
                                ApiClient.post('/wechatapp/login', {
                                    code: res.code,
                                    grant_type: 'oauth',
                                    client_id: 2
                                }).then(response => {
                                    console.log(response.data);
                                    const {access_token} = response.data;
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

    render() {
        return (
            <View style={{
                backgroundColor: '#fff',
                paddingTop: 60,
                paddingLeft: 30,
                paddingRight: 20,
                flex: 1
            }}>
                <TextField
                    placeholder="手机号/邮箱/用户名"
                    defaultValue={this.state.account}
                    onSubmitEditing={() => {
                        Keyboard.dismiss();
                    }}
                    onChangeText={(text) => {
                        this.setState({
                            account: text
                        });
                    }}
                    style={{paddingVertical: 10}}
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
                            password: text
                        });
                    }}
                    style={{paddingVertical: 10}}
                />
                <View style={{height: 50}}/>
                <Button title={"登录"} onPress={this.submit} buttonStyle={{backgroundColor: Colors.primary, height: 45}}/>

                <View style={{
                    marginTop: 30,
                    flexDirection: 'row'
                }}>
                    <Text style={{
                        flex: 1,
                        textAlign: 'center',
                        color: '#1998E0'
                    }}
                          onPress={() => {
                              this.props.navigation.navigate('Signup');
                          }}
                    >快速注册</Text>
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '登录',
        });

        AsyncStorage.getItem('account').then(account => {
            this.setState({account});
        });
        AsyncStorage.getItem('password').then(password => {
            this.setState({password});
        });
        WeChat.isWXAppInstalled().then(installed => {
            //console.log(installed);
            if (installed) {
                this.setState({isWXAppInstalled: true});
            }
        }).catch(reason => {
            console.log(reason);
        });
    }

    submit = () => {
        const {account, password} = this.state;
        if (!account) {
            this.refs.toast.show('请填写账号');
            return false;
        }

        if (!password) {
            this.refs.toast.show('请填写密码');
            return false;
        }

        AsyncStorage.setItem('account', account);
        AsyncStorage.setItem('password', password);

        axios.post(OauthApi + '/token', {
            'grant_type': 'password',
            'client_id': '2',
            'client_secret': 'Rw7FTTT4ouOIIWJx6eMQ28ENG7Tnq9lifOewqyce',
            'username': account,
            'password': password,
            'scope': '*',
        }).then(response => {
            //console.log(response.data);
            const {access_token} = response.data;
            if (access_token) this.doLogin(access_token);
        }).catch(reason => {
            this.refs.toast.show('你输入的账号和密码不匹配');
        });
    };

    doLogin = (access_token) => {
        AsyncStorage.setItem(AccessToken, access_token).then(() => {
            ApiClient.get('/user/info').then(response => {
                //console.log('==========');
                //console.log(response.data);
                const userinfo = response.data.userinfo;
                DeviceEventEmitter.emit(UserDidSigninedNotification, userinfo);
                this.props.navigation.goBack();
            }).catch(reason => {
                if (reason.data) {
                    this.refs.toast.show(reason.data.errmsg);
                }
            });
        }).catch(reason => {
            console.log(reason);
        });
    };
}

export default Signin;

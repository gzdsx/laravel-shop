import React from 'react';
import {DeviceEventEmitter, View} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import Validate from "gzdsx-validate";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Button} from "react-native-elements";
import {ButtonStyles} from "../../styles/ButtonStyles";
import AsyncStorage from "@react-native-async-storage/async-storage";
import {AccessToken, UserDidSigninedNotification} from "../../base/constants";

export default class Signup extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '快速注册',
    });

    constructor(props) {
        super(props);
        this.state = {
            username: null,
            password: null,
            mobile: {}
        };
    }


    render() {
        return (
            <View style={{
                backgroundColor: '#fff',
                padding: 30,
                flex: 1
            }}>
                <TextField
                    placeholder="用户名"
                    onChangeText={(text) => {
                        this.setState({
                            username: text
                        });
                    }}
                />
                <TextField
                    placeholder="手机号码"
                    keyboardType={"phone-pad"}
                    onChangeText={(text) => {
                        this.setState({
                            mobile: text
                        });
                    }}
                />
                <TextField
                    placeholder="登录密码"
                    secureTextEntry={true}
                    onChangeText={(text) => {
                        this.setState({
                            password: text
                        });
                    }}
                />
                <View style={{height: 50}}/>
                <Button onPress={this.submit} title={"立即注册"} buttonStyle={ButtonStyles.primary}/>
                <Toast ref={"toast"}/>
            </View>
        );
    }


    submit = () => {

        const {username, mobile, password} = this.state;

        let data = {
            username,
            mobile,
            password
        };

        if (!username) {
            this.refs.toast.show('请输入用户名');
            return false;
        }
        if (!Validate.isUserName(username)) {
            this.refs.toast.show('用户名输入错误');
            return false;
        }

        if (!mobile) {
            this.refs.toast.show('请输入手机号码');
            return false;
        }
        if (!Validate.isMobile(mobile)) {
            this.refs.toast.show('手机号码输入错误');
            return false;
        }

        if (!password) {
            this.refs.toast.show('请输入登录密码');
            return false;
        }
        if (!Validate.isPassword(password)) {
            this.refs.toast.show('密码输入错误');
            return false;
        }

        ApiClient.post('/register', data).then(response => {
            //console.log(response.data);
            const {userinfo, access_token} = response.data;
            this.refs.toast.show('注册成功', {
                onHide: () => {
                    AsyncStorage.setItem(AccessToken, access_token).then(() => {
                        DeviceEventEmitter.emit(UserDidSigninedNotification, userinfo);
                        this.props.navigation.popToTop();
                    }).catch(reason => {
                        console.log(reason);
                    });
                }
            });
        }).catch(error => {
            if (error.data) {
                this.refs.toast.show(error.data.errmsg);
            }
        });
    }
}

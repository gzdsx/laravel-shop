import React from 'react';
import {DeviceEventEmitter, StyleSheet, View} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import Validate from "gzdsx-validate";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Button} from "react-native-elements";
import AsyncStorage from "@react-native-async-storage/async-storage";
import {AccessToken, UserDidSigninedNotification} from "../../base/constants";
import {ButtonStyles} from "../../styles";

export default class Signup extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            nickname: '',
            password: '',
            phone: '',
            code: ''
        };
    }

    componentDidMount() {
        let {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '快速注册',
        });
    }

    render() {
        return (
            <View style={style.container}>
                <TextField
                    placeholder="昵称"
                    onChangeText={(text) => {
                        this.setState({
                            nickname: text
                        });
                    }}
                    placeholderTextColor={"#959595"}
                    returnKeyType={"done"}
                    returnKeyLabel={"完成"}
                />
                <TextField
                    placeholder="手机"
                    keyboardType={"phone-pad"}
                    onChangeText={(text) => {
                        this.setState({
                            phone: text
                        });
                    }}
                    placeholderTextColor={"#959595"}
                    returnKeyType={"done"}
                    returnKeyLabel={"完成"}
                />
                <TextField
                    placeholder="密码"
                    secureTextEntry={true}
                    onChangeText={(text) => {
                        this.setState({
                            password: text
                        });
                    }}
                    placeholderTextColor={"#959595"}
                    returnKeyType={"done"}
                    returnKeyLabel={"完成"}
                />
                <View style={{
                    height: 50
                }}/>
                <Button onPress={this.submit} title={"立即注册"} buttonStyle={ButtonStyles.primary}/>
            </View>
        );
    }


    submit = () => {

        const {nickname, phone, password, code} = this.state;

        let data = {
            nickname,
            phone,
            password
        };

        if (!nickname) {
            Toast.fail('请输入用户名');
            return false;
        }

        if (!phone) {
            Toast.fail('请输入手机号码');
            return false;
        }
        if (!Validate.isMobile(phone)) {
            Toast.fail('手机号码输入错误');
            return false;
        }

        if (!password) {
            Toast.fail('请输入登录密码');
            return false;
        }
        if (!Validate.isPassword(password)) {
            Toast.fail('密码输入错误');
            return false;
        }

        ApiClient.post('/register', data).then(response => {
            console.log(response);
            const {access_token} = response.result;
            AsyncStorage.setItem(AccessToken, access_token).then(() => {
                DeviceEventEmitter.emit(UserDidSigninedNotification);
                Toast.success('注册成功', {
                    onHidden: () => {
                        this.props.navigation.popToTop();
                    }
                });
            }).catch(reason => {
                console.log(reason);
            });

        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    }
}

const style = StyleSheet.create({
    container: {
        backgroundColor: '#fff',
        padding: 30,
        flex: 1
    },
});

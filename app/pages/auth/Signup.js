import React from 'react';
import {View, StyleSheet} from 'react-native';
import {ApiClient, Utils, Toast, Validate} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CustomButton, CustomTextInput} from "../../components";

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
            <View
                style={{
                    backgroundColor: '#fff',
                    paddingTop: 30,
                    paddingLeft: 30,
                    paddingRight: 20,
                    flex: 1
                }}
            >
                <View style={css.row}>
                    <CustomTextInput
                        placeholder="用户名"
                        onChangeText={(text) => {
                            this.setState({
                                username: text
                            });
                        }}
                    />
                </View>
                <View style={css.row}>
                    <CustomTextInput
                        placeholder="手机号码"
                        keyboardType={"phone-pad"}
                        onChangeText={(text) => {
                            this.setState({
                                mobile: text
                            });
                        }}
                    />
                </View>
                <View style={css.row}>
                    <CustomTextInput
                        placeholder="登录密码"
                        secureTextEntry={true}
                        onChangeText={(text) => {
                            this.setState({
                                password: text
                            });
                        }}
                    />
                </View>
                <View style={{height: 50}}/>
                <CustomButton onPress={this.submit} text={"立即注册"}/>
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
            Toast.show('请输入用户名');
            return false;
        }
        if (!Validate.IsUserName(username)) {
            Toast.show('用户名输入错误');
            return false;
        }

        if (!mobile) {
            Toast.show('请输入手机号码');
            return false;
        }
        if (!Validate.IsMobile(mobile)) {
            Toast.show('手机号码输入错误');
            return false;
        }

        if (!password) {
            Toast.show('请输入登录密码');
            return false;
        }
        if (!Validate.IsPassword(password)) {
            Toast.show('密码输入错误');
            return false;
        }

        ApiClient.post('/register', data).then(response => {
            Toast.show('注册成功', {
                onHidden: () => {
                    this.props.navigation.popToTop();
                }
            });
        }).catch(error => {
            if (error.data) {
                Toast.show(error.data.errmsg);
            }
        });
    }
}

const css = StyleSheet.create({
    row: {
        paddingTop: 20,
        paddingBottom: 20,
        borderBottomWidth: 0.5,
        borderBottomColor: '#DDD',
    }
});

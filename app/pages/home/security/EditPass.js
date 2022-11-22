import React from 'react';
import {View, StyleSheet, SafeAreaView} from 'react-native';
import {Button} from "react-native-elements";
import {TextField, Toast} from "react-native-gzdsx-elements";
import Validate from "gzdsx-validate";
import {ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles";

export default class EditPass extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            oldpassword: null,
            newpassword: null,
            saveing: false,
            disabled: false
        };
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '修改密码',
        });
    }

    render() {
        return (
            <SafeAreaView style={{flex: 1}}>
                <View style={{paddingHorizontal: 20, backgroundColor: '#fff'}}>
                    <TextField
                        placeholder={"请输入当前密码"}
                        underlineColorAndroid={"transparent"}
                        secureTextEntry={true}
                        onChangeText={(text) => this.setState({oldpassword: text})}
                        style={css.textField}
                    />
                    <TextField
                        placeholder={"请输入新密码"}
                        underlineColorAndroid={"transparent"}
                        secureTextEntry={true}
                        onChangeText={(text) => this.setState({newpassword: text})}
                        style={css.textField}
                    />
                </View>
                <View style={{marginTop: 20, paddingHorizontal: 20}}>
                    <Button
                        title={"提交"}
                        disabled={this.state.disabled}
                        onPress={this.submit}
                        buttonStyle={ButtonStyles.primary}
                    />
                </View>
            </SafeAreaView>
        );
    }

    submit = () => {
        const {oldpassword, newpassword, disabled} = this.state;

        if (this.state.saveing) return false;
        if (!oldpassword) {
            Toast.fail('请输入当前密码');
            return false;
        }

        if (!Validate.isPassword(oldpassword)) {
            Toast.fail('当前密码输入错误，至少6位');
            return false;
        }

        if (!newpassword) {
            Toast.fail('请输入新密码');
            return false;
        }

        if (!Validate.isPassword(newpassword)) {
            Toast.fail('新密码输入错误，至少6位');
            return false;
        }

        this.setState({disabled: true});
        ApiClient.post('/user/password.reset', {
            oldpassword,
            newpassword
        }).then(() => {
            Toast.success('密码修改成功', {
                onHidden: () => this.props.navigation.goBack()
            });
        }).catch(reason => {
            this.setState({disabled: false});
            Toast.fail(reason.errMsg);
        });
    }
}

const css = StyleSheet.create({
    textField: {
        marginBottom: 20,
        borderBottomWidth: 0.5,
        borderBottomColor: '#e5e5e5',
        paddingHorizontal: 0,
        paddingVertical: 15
    }
});

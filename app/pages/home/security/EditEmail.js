import React from 'react';
import {View, StyleSheet, SafeAreaView} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import {Button} from "react-native-elements";
import Validate from "gzdsx-validate";
import {ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles";

export default class EditEmail extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            email: null,
            disabled: false
        };
    }

    componentDidMount() {
        let {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '绑定邮箱',
        });
    }

    render() {
        return (
            <SafeAreaView>
                <View style={{paddingHorizontal: 20, backgroundColor: '#fff'}}>
                    <TextField
                        style={css.textField}
                        placeholder={"请输入邮箱地址"}
                        onChangeText={(text) => this.setState({email: text})}
                        keyboardType={"email-address"}
                    />
                </View>
                <View style={{paddingHorizontal: 20, marginTop: 40}}>
                    <Button
                        title={"提交"}
                        onPress={this.submit}
                        disbaled={this.state.disabled}
                        buttonStyle={ButtonStyles.primary}/>
                </View>
            </SafeAreaView>
        );
    }

    submit = () => {
        const {email} = this.state;
        if (!email) {
            Toast.fail('请输入邮箱地址');
            return false;
        }

        if (!Validate.isEmail(email)) {
            Toast.fail('邮箱地址输入错误');
            return false;
        }

        this.setState({disabled: true});
        ApiClient.post('/user/email.bind', {email}).then(response => {
            Toast.success('邮箱绑定成功', {
                onHidden: () => this.props.navigation.goBack()
            });
        }).catch(error => {
            this.setState({disabled: false});
            Toast.fail(error.errMsg);
        });
    }
}

const css = StyleSheet.create({
    textField: {
        marginBottom: 20,
        paddingHorizontal: 0
    }
});

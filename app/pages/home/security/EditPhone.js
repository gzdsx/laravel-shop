import React from 'react';
import {View, StyleSheet, SafeAreaView} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import {Button} from "react-native-elements";
import Validate from "gzdsx-validate";
import {ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles";

export default class EditPhone extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            phone: null,
            disabled: false
        }
    }

    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '绑定手机号',
        });
    }

    render() {
        return (
            <SafeAreaView>
                <View style={{paddingHorizontal: 20, backgroundColor: '#fff'}}>
                    <TextField
                        style={css.textField}
                        placeholder={"请输入你的手机号"}
                        onChangeText={(text) => this.setState({phone: text})}
                        keyboardType={"phone-pad"}
                    />
                </View>
                <View style={{marginTop: 20, paddingHorizontal: 20}}>
                    <Button
                        title={"提交"}
                        onPress={this.submit}
                        disabled={this.state.disabled}
                        buttonStyle={ButtonStyles.primary}/>
                </View>
            </SafeAreaView>
        );
    }

    submit = () => {
        const {phone} = this.state;
        if (!phone) {
            Toast.fail('请输入你的手机号码');
            return false;
        }

        if (!Validate.isMobile(phone)) {
            Toast.fail('手机号码输入错误');
            return false;
        }

        this.setState({disabled: true});
        ApiClient.post('/user/phone.bind', {phone}).then(response => {
            Toast.success('手机号绑定成功', {
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

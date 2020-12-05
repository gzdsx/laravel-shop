import React from 'react';
import {View, StyleSheet} from 'react-native';
import {Button} from "react-native-elements";
import {TextField, Toast} from "react-native-gzdsx-elements";
import {Validate, ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles/ButtonStyles";

export default class EditPass extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            oldpassword: null,
            newpassword: null,
            saveing: false
        };
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '修改密码',
        });
    }

    render() {
        return (
            <View style={{padding: 20}}>
                <TextField
                    placeholder={"请输入当前密码"}
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
                <View style={{marginTop: 20}}>
                    <Button title={"提交"} onPress={this.submit} buttonStyle={ButtonStyles.primary}/>
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    submit = () => {
        const {oldpassword, newpassword} = this.state;

        if (this.state.saveing) return false;
        if (!oldpassword) {
            this.refs.toast.show('请输入当前密码');
            return false;
        }

        if (!Validate.IsPassword(oldpassword)) {
            this.refs.toast.show('当前密码输入错误，至少6位');
            return false;
        }

        if (!newpassword) {
            this.refs.toast.show('请输入新密码');
            return false;
        }

        if (!Validate.IsPassword(newpassword)) {
            this.refs.toast.show('新密码输入错误，至少6位');
            return false;
        }

        this.setState({saveing: true});
        ApiClient.post('/security/editpass', {
            oldpassword,
            newpassword
        }).then(response => {
            this.setState({saveing: false});
            this.refs.toast.show('密码修改成功', {
                onHide: () => this.props.navigation.goBack()
            });
        }).catch(error => {
            this.setState({saveing: false});
            if (error.data.errmsg) {
                this.refs.toast.show(error.data.errmsg);
            }
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

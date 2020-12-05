import React from 'react';
import {View, StyleSheet} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import {Button} from "react-native-elements";
import {ApiClient, Validate} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles/ButtonStyles";

export default class EditEmail extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '绑定邮箱',
    });

    constructor(props) {
        super(props);
        this.state = {
            email: null,
            saveing: false
        };
    }

    render() {
        return (
            <View style={{padding: 20}}>
                <TextField
                    style={css.textField}
                    placeholder={"请输入邮箱地址"}
                    onChangeText={(text) => this.setState({email: text})}
                    keyboardType={"email-address"}
                />
                <View style={{height: 10}}/>
                <View style={css.row}>
                    <Button title={"提交"} onPress={this.submit} buttonStyle={ButtonStyles.primary}/>
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    submit = () => {
        const {email} = this.state;
        if (this.state.saveing) return false;
        if (!email) {
            this.refs.toast.show('请输入邮箱地址');
            return false;
        }

        if (!Validate.IsEmail(email)) {
            this.refs.toast.show('邮箱地址输入错误');
            return false;
        }

        this.setState({saveing: true});
        ApiClient.post('/security/bindemail', {email}).then(response => {
            this.setState({saveing: false});
            this.refs.toast.show('邮箱绑定成功', {
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
        paddingHorizontal:0
    }
});

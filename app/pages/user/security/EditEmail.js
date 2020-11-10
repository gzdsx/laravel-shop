import React from 'react';
import {View, StyleSheet} from 'react-native';
import {Toast, ApiClient, Validate} from "../../../utils";
import {CustomTextInput, CustomButton} from "../../../components";
import {defaultNavigationConfigure} from "../../../base/navconfig";

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
                <View style={css.row}>
                    <CustomTextInput
                        style={css.textInput}
                        placeholder={"请输入邮箱地址"}
                        onChangeText={(text) => this.setState({email: text})}
                        keyboardType={"email-address"}
                    />
                </View>
                <View style={{height: 10}}/>
                <View style={css.row}>
                    <CustomButton text={"提交"} onPress={this.submit}/>
                </View>
            </View>
        );
    }

    submit = () => {
        const {email} = this.state;
        if (this.state.saveing) return false;
        if (!email) {
            Toast.show('请输入邮箱地址');
            return false;
        }

        if (!Validate.IsEmail(email)) {
            Toast.show('邮箱地址输入错误');
            return false;
        }

        this.setState({saveing: true});
        ApiClient.post('/security/bindemail', {email}).then(response => {
            this.setState({saveing: false});
            Toast.show('邮箱绑定成功', {
                onHidden: () => this.props.navigation.goBack()
            });
        }).catch(error => {
            this.setState({saveing: false});
            if (error.data.errmsg) {
                Toast.show(error.data.errmsg);
            }
        });
    }
}

const css = StyleSheet.create({
    row: {
        marginBottom: 20
    },
    textInput: {
        borderWidth: 0,
        height: 40,
        borderRadius: 20,
        textAlign: 'center',
        textAlignVertical: 'center',
        backgroundColor: '#fff',
        fontSize: 16
    }
});

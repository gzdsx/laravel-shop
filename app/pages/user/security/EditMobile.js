import React from 'react';
import {View, StyleSheet, TextInput} from 'react-native';
import {CustomTextInput, CustomButton} from "../../../components";
import {ApiClient, Toast, Validate} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";

export default class EditMobile extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '绑定手机号',
    });

    constructor(props) {
        super(props);
        this.state = {
            mobile: null,
            saveing: false
        }
    }

    render() {
        return (
            <View style={{padding: 20}}>
                <View style={css.row}>
                    <CustomTextInput
                        style={css.textInput}
                        placeholder={"请输入你的手机号"}
                        onChangeText={(text) => this.setState({mobile: text})}
                        keyboardType={"phone-pad"}
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
        const {mobile} = this.state;
        if (this.state.saveing) return false;
        if (!mobile) {
            Toast.show('请输入你的手机号码');
            return false;
        }

        if (!Validate.IsMobile(mobile)) {
            Toast.show('手机号码输入错误');
            return false;
        }

        this.setState({saveing: true});
        ApiClient.post('/security/bindmobile', {mobile}).then(response => {
            this.setState({saveing: false});
            Toast.show('手机号绑定成功', {
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

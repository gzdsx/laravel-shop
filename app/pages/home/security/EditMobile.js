import React from 'react';
import {View, StyleSheet} from 'react-native';
import {Toast, TextField} from 'react-native-gzdsx-elements';
import {Button} from "react-native-elements";
import Validate from "gzdsx-validate";
import {ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles} from "../../../styles/ButtonStyles";

export default class EditMobile extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            mobile: null,
            saveing: false
        }
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '绑定手机号',
        });
    }

    render() {
        return (
            <View style={{padding: 20}}>
                <TextField
                    style={css.textField}
                    placeholder={"请输入你的手机号"}
                    onChangeText={(text) => this.setState({mobile: text})}
                    keyboardType={"phone-pad"}
                />
                <View style={{height: 10}}/>
                <View style={{marginTop: 20}}>
                    <Button title={"提交"} onPress={this.submit} buttonStyle={ButtonStyles.primary}/>
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    submit = () => {
        const {mobile} = this.state;
        if (this.state.saveing) return false;
        if (!mobile) {
            this.refs.toast.show('请输入你的手机号码');
            return false;
        }

        if (!Validate.isMobile(mobile)) {
            this.refs.toast.show('手机号码输入错误');
            return false;
        }

        this.setState({saveing: true});
        ApiClient.post('/security/update_mobile', {mobile}).then(response => {
            this.setState({saveing: false});
            this.refs.toast.show('手机号绑定成功', {
                onHidden: () => this.props.navigation.goBack()
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
        paddingHorizontal: 0
    }
});

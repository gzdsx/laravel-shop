import React from 'react';
import {View, StyleSheet} from 'react-native';
import {CustomTextInput,CustomButton} from "../../../components";
import {Validate,ApiClient,Toast} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";

export default class EditPass extends React.Component{
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle:'修改密码',
    });

    constructor(props) {
        super(props);
        this.state = {
            oldpassword : null,
            newpassword : null,
            saveing : false
        };
    }

    render() {
        return (
            <View style={{padding:20}}>
                <View style={css.row}>
                    <CustomTextInput
                        placeholder={"请输入当前密码"}
                        underlineColorAndroid={"transparent"}
                        secureTextEntry={true}
                        onChangeText={(text)=>this.setState({oldpassword:text})}
                        style={css.textInput}
                    />
                </View>
                <View style={css.row}>
                    <CustomTextInput
                        placeholder={"请输入新密码"}
                        underlineColorAndroid={"transparent"}
                        secureTextEntry={true}
                        onChangeText={(text)=>this.setState({newpassword:text})}
                        style={css.textInput}
                    />
                </View>
                <View style={css.row}>
                    <CustomButton text={"提交"} onPress={this.submit}/>
                </View>
            </View>
        );
    }

    submit = () => {
        const {oldpassword,newpassword} = this.state;

        if (this.state.saveing) return false;
        if (!oldpassword) {
            Toast.show('请输入当前密码');
            return false;
        }

        if (!Validate.IsPassword(oldpassword)) {
            Toast.show('当前密码输入错误，至少6位');
            return false;
        }

        if (!newpassword) {
            Toast.show('请输入新密码');
            return false;
        }

        if (!Validate.IsPassword(newpassword)) {
            Toast.show('新密码输入错误，至少6位');
            return false;
        }

        this.setState({saveing : true});
        ApiClient.post('/security/editpass',{
            oldpassword,
            newpassword
        }).then(response=>{
            this.setState({saveing : false});
            Toast.show('密码修改成功', {
                onHidden : ()=>this.props.navigation.goBack()
            });
        }).catch(error=>{
            this.setState({saveing : false});
            if (error.data.errmsg) {
                Toast.show(error.data.errmsg);
            }
        });
    }
}

const css = StyleSheet.create({
    row:{
        marginBottom:20
    },
    textInput:{
        borderWidth:0,
        height:40,
        borderRadius:20,
        textAlign:'center',
        textAlignVertical:'center',
        backgroundColor:'#fff',
        fontSize:16
    }
});

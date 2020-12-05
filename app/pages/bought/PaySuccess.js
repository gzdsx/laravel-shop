import React from 'react';
import {View, ScrollView, Text} from 'react-native';
import {Ticon} from "react-native-gzdsx-elements";
import {Utils} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CustomButton} from "../../components";

export default class PaySuccess extends React.Component{
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle:'支付结果',
    });


    render() {
        const result = JSON.parse(this.props.navigation.getParam('result', {}));
        return (
            <ScrollView style={{flex:1}}>
                <View style={{
                    padding:30,
                    backgroundColor:'#fff',
                }}>
                    <View style={{
                        alignItems:'center',
                        alignSelf:'center',
                    }}>
                        <Ticon name={"round-check-fill"} color={"#23C55D"} size={50}/>
                        <Text style={{
                            color:'#23C55D',
                            fontWeight:'600',
                            textAlign:'center',
                            marginTop:8,
                            fontSize:18
                        }}>支付成功</Text>

                        <Text style={{
                            fontSize:28,
                            color:'#333',
                            fontWeight:'400',
                            textAlign:'center',
                            marginTop:20
                        }}>{result.alipay_trade_app_pay_response.total_amount}元</Text>
                    </View>
                </View>
                <View style={{padding:20}}>
                    <CustomButton text={"完成"} onPress={()=>{
                        this.props.navigation.goBack();
                    }}/>
                </View>
            </ScrollView>
        );
    }


    componentDidMount() {
        this.listener = this.props.navigation.addListener('willFocus', () => Utils.setStatusBarStyle());
    }


    componentWillUnmount() {
        this.listener.remove();
    }

}

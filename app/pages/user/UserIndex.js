import React from 'react';
import {connect} from 'react-redux';
import {View, Text, Image, TouchableOpacity, ScrollView, StyleSheet} from 'react-native';
import {Ticon} from "react-native-ticon";
import {TableCellGroup, TableCell} from "react-native-dsxui";
import AboutUs from "./AboutUs";
import {Colors} from "../../styles";

class UserView extends React.Component {

    render() {
        const {navigation, auth} = this.props;
        return (
            <ScrollView showsVerticalScrollIndicator={false}>
                {this.renderHeader()}
                {this.renderOrderMenus()}
                <View style={{height: 10}}/>
                <TableCellGroup>
                    <TableCell
                        title={"账号安全"}
                        icon={<Ticon name={"safe"} color={"#23C55D"} size={25}/>}
                        isLink={true}
                        onPress={() => this.showView('Security')}
                    />
                    <TableCell
                        title={"收货地址"}
                        icon={<Ticon name={"address-book"} color={"#666666"} size={25}/>}
                        isLink={true}
                        onPress={() => this.showView('AddressList')}
                    />
                    <TableCell
                        title={"我的收藏"}
                        icon={<Ticon name={"favor"} color={"#FD932B"} size={25}/>}
                        isLink={true}
                        onPress={() => this.showView('Favorite')}
                    />
                    <TableCell
                        title={"消息及提醒"}
                        icon={<Ticon name={"notification"} color={"#FC461E"} size={25}/>}
                        isLink={true}
                        onPress={() => this.showView('NoticeSet')}
                    />
                    <TableCell
                        title={"关于我们"}
                        icon={<Ticon name={"info"} color={"#1998E0"} size={25}/>}
                        isLink={true}
                        onPress={() => navigation.navigate('AboutUs')}
                    />
                    <TableCell
                        title={"帮助与反馈"}
                        icon={<Ticon name={"write"} color={"#d4237a"} size={25}/>}
                        isLink={true}
                        onPress={() => this.showView('FeedBack')}
                    />
                </TableCellGroup>
            </ScrollView>
        );
    }


    componentDidMount() {
        this.props.navigation.setOptions({
            headerShown: false
        });
    }

    renderHeader = () => {
        const {auth, navigation} = this.props;
        let avatar, username;
        if (auth.isSignined) {
            avatar = {uri: auth.userinfo.avatar};
            username = auth.userinfo.username;
        } else {
            avatar = require('../../images/common/qiuzhenxiang.png');
            username = "登录/注册";
        }
        return (
            <View style={{
                backgroundColor: Colors.primary,
                paddingTop: 54,
                paddingBottom: 30,
                paddingHorizontal: 15,
            }}>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{flexDirection: 'row'}}
                    onPress={() => this.showView('MyProfile')}
                >
                    <Image source={avatar} style={{
                        width: 70,
                        height: 70,
                        borderRadius: 35,
                        marginRight: 15,
                        borderWidth: 3,
                        borderColor: '#fff'
                    }}/>
                    <View style={{
                        alignContent: 'flex-start',
                        alignSelf: 'center',
                    }}>
                        <Text style={{
                            color: '#fff',
                            fontSize: 20,
                            textAlignVertical: 'center',
                            fontWeight: '600'
                        }}>{username}</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    };

    renderOrderMenus = () => {
        const {navigate} = this.props.navigation;
        const styles = StyleSheet.create({
            button: {
                alignContent: 'center',
                alignItems: 'center',
                flex: 1
            },
            buttonText: {
                fontSize: 12,
                textAlign: 'center',
                color: '#333',
                marginTop: 5
            }
        });
        return (
            <View style={{
                backgroundColor: '#fff'
            }}>
                <TableCell
                    title={"我的订单"}
                    detail={"全部订单"}
                    isLink={true}
                    onPress={() => this.showOrderView('all')}
                />
                <View style={{flexDirection: 'row', paddingTop: 15, paddingBottom: 15}}>
                    <View style={styles.button}>
                        <Ticon name={"wait-pay"} size={30} color={Colors.primary}
                               onPress={() => this.showOrderView('waitPay')}/>
                        <Text style={styles.buttonText}>待付款</Text>
                    </View>

                    <View style={styles.button}>
                        <Ticon name={"wait-send"} size={30} color={Colors.primary}
                               onPress={() => this.showOrderView('waitSend')}/>
                        <Text style={styles.buttonText}>待发货</Text>
                    </View>

                    <View style={styles.button}>
                        <Ticon name={"wait-delivery"} size={30} color={Colors.primary}
                               onPress={() => this.showOrderView('waitConfirm')}/>
                        <Text style={styles.buttonText}>待收货</Text>
                    </View>

                    <View style={styles.button}>
                        <Ticon name={"wait-rate"} size={30} color={Colors.primary}
                               onPress={() => this.showOrderView('waitRate')}/>
                        <Text style={styles.buttonText}>待评价</Text>
                    </View>

                    <View style={styles.button}>
                        <Ticon name={"refund"} size={30} color={Colors.primary}
                               onPress={() => this.showOrderView('refunding')}/>
                        <Text style={styles.buttonText}>退款/售后</Text>
                    </View>
                </View>
            </View>
        );
    };

    showOrderView = (tab) => {
        const {auth} = this.props;
        if (auth.isSignined) {
            this.props.navigation.navigate('OrderList', {tab});
        } else {
            this.props.navigation.navigate('Signin');
        }
    };

    showView = (view, params = {}) => {
        const {auth} = this.props;
        if (auth.isSignined) {
            this.props.navigation.navigate(view, params);
        } else {
            this.props.navigation.navigate('Signin');
        }
    }
}

const mapStateToProps = (store) => {
    return {...store};
};

export default connect(mapStateToProps)(UserView);

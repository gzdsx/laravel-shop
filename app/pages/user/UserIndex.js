import React from 'react';
import {connect} from 'react-redux';
import {View, Text, Image, TouchableOpacity, ScrollView, StyleSheet} from 'react-native';
import {Ticon, TableView, TableCell} from "react-native-gzdsx-elements";
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
                <TableView>
                    <TableCell onPress={() => this.showView('Security')}>
                        <TableCell.Icon name={"safe"} color={"#23C55D"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"账号安全"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => this.showView('AddressList')}>
                        <TableCell.Icon name={"address-book"} color={"#666666"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"收货地址"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => this.showView('Favorite')}>
                        <TableCell.Icon name={"favor"} color={"#FD932B"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"我的收藏"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => this.showView('NoticeSet')}>
                        <TableCell.Icon name={"notification"} color={"#FC461E"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"消息及提醒"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => navigation.navigate('AboutUs')}>
                        <TableCell.Icon name={"info"} color={"#1998E0"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"关于我们"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => this.showView('FeedBack')}>
                        <TableCell.Icon name={"write"} color={"#d4237a"} size={25}/>
                        <TableCell.Content>
                            <TableCell.Title title={"帮助与反馈"}/>
                        </TableCell.Content>
                        <TableCell.Accessory/>
                    </TableCell>
                </TableView>
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
                <TableCell onPress={() => this.showOrderView('all')}>
                    <TableCell.Content>
                        <TableCell.Title title={"我的订单"}/>
                    </TableCell.Content>
                    <TableCell.Detail text={"全部订单"}/>
                    <TableCell.Accessory/>
                </TableCell>
                <View style={{flexDirection: 'row', paddingTop: 15, paddingBottom: 15}}>
                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitPay')}
                    >
                        <Ticon name={"wait-pay"} size={30} color={Colors.primary}/>
                        <Text style={styles.buttonText}>待付款</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitSend')}
                    >
                        <Ticon name={"wait-send"} size={30} color={Colors.primary}/>
                        <Text style={styles.buttonText}>待发货</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitConfirm')}
                    >
                        <Ticon name={"wait-delivery"} size={30} color={Colors.primary}/>
                        <Text style={styles.buttonText}>待收货</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitRate')}
                    >
                        <Ticon name={"wait-rate"} size={30} color={Colors.primary}/>
                        <Text style={styles.buttonText}>待评价</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('refunding')}
                    >
                        <Ticon name={"refund"} size={30} color={Colors.primary}/>
                        <Text style={styles.buttonText}>退款/售后</Text>
                    </TouchableOpacity>
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

import React from 'react';
import {connect} from 'react-redux';
import {Animated, View, Text, TouchableOpacity, ScrollView, StyleSheet} from 'react-native';
import {Colors, StatusBarStyles} from "../../styles";
import {SafeHeader} from "../../components/SafeView";
import FastImage from "react-native-fast-image";
import {ListItem} from "react-native-elements";
import ImageIcon from "../../components/ImageIcon";

class HomeIndex extends React.Component {
    constructor() {
        super();
        this.state = {
            scrollY: new Animated.Value(0)
        }
    }

    componentDidMount() {
        this.props.navigation.setOptions({
            headerShown: false
        });
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToLightStyle();
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    renderTopView = () => {
        return (
            <Animated.View
                style={[
                    {
                        backgroundColor: Colors.primary,
                        height: 200
                    },
                    {
                        transform: [
                            {
                                translateY: this.state.scrollY.interpolate({
                                    inputRange: [-200, 0, 200],
                                    outputRange: [0, 0, -200]
                                })
                            },
                            {
                                scale: this.state.scrollY.interpolate({
                                    inputRange: [-200, 0, 200],
                                    outputRange: [2, 1, 1]
                                }),
                            },
                        ]
                    }
                ]}
            />
        )
    }

    render() {
        const {navigation, oauth} = this.props;
        return (
            <View style={{flex: 1}}>
                {this.renderTopView()}
                <ScrollView
                    style={styles.scrollView}
                    showsVerticalScrollIndicator={false}
                    scrollEventThrottle={16}
                    onScroll={event => {
                        Animated.event([
                            {
                                nativeEvent: {contentOffset: {y: this.state.scrollY}}
                            }
                        ], {
                            useNativeDriver: false
                        }).call(this, event)
                    }}
                >
                    <SafeHeader/>
                    {this.renderHeader()}
                    {this.renderOrderMenus()}
                    <View style={{height: 10}}/>
                    <View style={styles.navContainer}>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>账号安全</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>收货地址</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>我的收藏</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>消息及提醒</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>关于我们</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                        <ListItem containerStyle={styles.navRow}>
                            <ListItem.Content>
                                <ListItem.Title>问题反馈</ListItem.Title>
                            </ListItem.Content>
                            <ListItem.Chevron/>
                        </ListItem>
                    </View>
                </ScrollView>
            </View>
        );
    }

    renderHeader = () => {
        const {oauth, userInfo, navigation} = this.props;
        let avatar, nickname;
        if (oauth.isAuthenticated) {
            avatar = {uri: userInfo.avatar};
            nickname = userInfo.nickname;
        } else {
            avatar = require('../../images/common/qiuzhenxiang.png');
            nickname = "登录/注册";
        }
        return (
            <View style={{
                backgroundColor: Colors.primary,
                paddingHorizontal: 15,
                paddingVertical: 30
            }}>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{flexDirection: 'row'}}
                    onPress={() => this.showView('MyProfile')}
                >
                    <FastImage
                        source={avatar}
                        style={{
                            width: 70,
                            height: 70,
                            borderRadius: 35,
                            marginRight: 15,
                            borderWidth: 3,
                            borderColor: '#fff'
                        }}
                    />
                    <View style={{
                        alignContent: 'flex-start',
                        alignSelf: 'center',
                    }}>
                        <Text style={{
                            color: '#fff',
                            fontSize: 20,
                            textAlignVertical: 'center',
                            fontWeight: '600'
                        }}>{nickname}</Text>
                    </View>
                </TouchableOpacity>
            </View>
        );
    };

    renderOrderMenus = () => {
        const {navigate} = this.props.navigation;
        return (
            <View style={{backgroundColor: '#fff'}}>
                <ListItem containerStyle={styles.row} onPress={() => this.showOrderView()}>
                    <ListItem.Content>
                        <ListItem.Title>我的订单</ListItem.Title>
                    </ListItem.Content>
                    <ListItem.Subtitle>全部订单</ListItem.Subtitle>
                    <ListItem.Chevron/>
                </ListItem>
                <View style={{flexDirection: 'row', paddingTop: 15, paddingBottom: 15}}>
                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitPay')}
                    >
                        <ImageIcon
                            source={require('../../images/trade/wait-pay.png')}
                            size={30}
                            color={Colors.primary}
                        />
                        <Text style={styles.buttonText}>待付款</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitSend')}
                    >
                        <ImageIcon
                            source={require('../../images/trade/wait-send.png')}
                            size={30}
                            color={Colors.primary}
                        />
                        <Text style={styles.buttonText}>待发货</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitConfirm')}
                    >
                        <ImageIcon
                            source={require('../../images/trade/wait-delivery.png')}
                            size={30}
                            color={Colors.primary}
                        />
                        <Text style={styles.buttonText}>待收货</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showOrderView('waitRate')}
                    >
                        <ImageIcon
                            source={require('../../images/trade/wait-rate.png')}
                            size={30}
                            color={Colors.primary}
                        />
                        <Text style={styles.buttonText}>待评价</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        activeOpacity={1}
                        style={styles.button}
                        onPress={() => this.showView('RefundList')}
                    >
                        <ImageIcon
                            source={require('../../images/trade/refund.png')}
                            size={30}
                            color={Colors.primary}
                        />
                        <Text style={styles.buttonText}>退款/售后</Text>
                    </TouchableOpacity>
                </View>
            </View>
        );
    };

    showOrderView = (tab) => {
        const {oauth, navigation} = this.props;
        if (oauth.isAuthenticated) {
            navigation.navigate('order-list', {tab});
        } else {
            navigation.navigate('signin');
        }
    };

    showView = (view, params = {}) => {
        const {oauth} = this.props;
        if (oauth.isAuthenticated) {
            this.props.navigation.navigate(view, params);
        } else {
            this.props.navigation.navigate('signin');
        }
    }
}

const mapStateToProps = state => {
    return state;
};

export default connect(mapStateToProps)(HomeIndex);


const styles = StyleSheet.create({
    scrollView: {
        position: 'absolute',
        left: 0,
        top: 0,
        right: 0,
        bottom: 0,
        zIndex: 10,
        flex: 1
    },
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0'
    },
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
    },
    navRow: {
        paddingVertical: 15
    },
    navContainer: {
        paddingVertical: 10,
        backgroundColor: '#fff'
    }
})

import React from 'react';
import {connect} from 'react-redux';
import {View, ScrollView, Image, Text} from 'react-native';
import {TableCellGroup, TableCell} from 'react-native-dsxui';
import {defaultNavigationConfigure} from '../../base/navconfig';

class UserIndex extends React.Component {
    static navigationOptions({navigation, route}) {
        return {
            ...defaultNavigationConfigure(navigation),
            headerTitle: '个人中心',
            headerLeft: () => null,
            headerRight: () => null,
        };
    }

    constructor(props) {
        super(props);
        this.state = {};
    }

    render(): React.ReactNode {
        return (
            <ScrollView style={{backgroundColor: '#f5f5f5'}}>
                <TableCellGroup>
                    {this.renderHeader()}
                </TableCellGroup>

                <TableCellGroup>
                    <TableCell
                        icon={() => {
                            return <Image
                                source={require('../../images/user/anquan.png')}
                                style={{
                                    width: 25,
                                    height: 25,
                                }}
                            />;
                        }}
                        isLink={true}
                        title={'账号安全'}
                        onPress={() => this.showView('Security')}
                    />
                    <TableCell
                        icon={() => {
                            return <Image
                                source={require('../../images/user/favorite.png')}
                                style={{
                                    width: 25,
                                    height: 25,
                                }}
                            />;
                        }}
                        isLink={true}
                        title={'我的收藏'}
                        onPress={() => this.showView('Favorite')}
                    />
                    <TableCell
                        icon={() => {
                            return <Image
                                source={require('../../images/user/video.png')}
                                style={{
                                    width: 25,
                                    height: 25,
                                }}
                            />;
                        }}
                        isLink={true}
                        title={'我的视频'}
                        onPress={() => this.showView('MyVideo')}
                    />
                    <TableCell
                        icon={() => {
                            return <Image
                                source={require('../../images/user/about.png')}
                                style={{
                                    width: 25,
                                    height: 25,
                                }}
                            />;
                        }}
                        isLink={true}
                        title={'关于我们'}
                        onPress={() => {
                            this.props.navigation.navigate('AboutUs');
                        }}
                    />
                    <TableCell
                        icon={() => {
                            return <Image
                                source={require('../../images/user/help.png')}
                                style={{
                                    width: 25,
                                    height: 25,
                                }}
                            />;
                        }}
                        isLink={true}
                        title={'帮助与反馈'}
                        onPress={() => this.showView('FeedBack')}
                    />
                </TableCellGroup>
            </ScrollView>
        );
    }

    componentDidMount(): void {

    }

    renderHeader = () => {
        const {isLoggedIn, userinfo} = this.props.auth;
        if (isLoggedIn) {
            return (
                <TableCell
                    icon={() => {
                        return (
                            <Image
                                source={{uri: userinfo.avatar}}
                                style={{
                                    width: 60,
                                    height: 60,
                                    borderRadius: 30,
                                    marginRight: 15,
                                }}
                            />
                        );
                    }}
                    isLink={true}
                    onPress={() => this.showView('MyProfile')}
                >
                    <View style={{flex: 1, paddingTop: 10}}>
                        <Text style={{
                            fontSize: 18,
                            color: '#000',
                            fontWeight: '500',
                        }}>{userinfo.username}</Text>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '300',
                            color: '#666',
                            marginTop: 5,
                        }}>会员ID:{userinfo.uid}</Text>
                    </View>
                </TableCell>
            );
        } else {
            return (
                <TableCell
                    icon={() => {
                        return (
                            <Image
                                source={require('../../images/common/qiuzhenxiang.png')}
                                style={{
                                    width: 60,
                                    height: 60,
                                    borderRadius: 30,
                                    marginRight: 15,
                                }}
                            />
                        );
                    }}
                    isLink={true}
                    onPress={() => {
                        this.props.navigation.navigate('Signin');
                    }}
                >
                    <View style={{flex: 1, paddingTop: 10}}>
                        <Text style={{
                            fontSize: 18,
                            color: '#000',
                            fontWeight: '500',
                        }}>未登录</Text>
                        <Text style={{
                            fontSize: 14,
                            fontWeight: '300',
                            color: '#666',
                            marginTop: 5,
                        }}>登录即可享受更多个性服务</Text>
                    </View>
                </TableCell>
            );
        }
    };

    showView = (url, param = {}) => {
        if (this.props.auth.isLoggedIn) {
            this.props.navigation.navigate(url, param);
        } else {
            this.props.navigation.navigate('Signin');
        }
    };
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth,
    };
};

export default connect(mapStateToProps)(UserIndex);

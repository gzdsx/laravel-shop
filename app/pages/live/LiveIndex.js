import React from 'react';
import {Text, TouchableOpacity, View} from 'react-native';
import {connect} from 'react-redux';
import ScrollableTabView, {ScrollableTabBar} from 'react-native-scrollable-tab-view';
import {LoadingView} from 'react-native-dsxui';
import {defaultNavigationConfigure} from '../../base/navconfig';
import {Colors, Styles} from '../../styles';
import {ApiClient} from '../../utils';
import LiveListComponent from './LiveListComponent';

class LiveIndex extends React.Component {
    static navigationOptions({navigation, route}) {
        return {
            ...defaultNavigationConfigure(navigation),
            headerTitle: '在线课程',
            headerRight: () => (
                <View style={Styles.headerRight}>
                    {
                        route.params.canLive ?
                            <TouchableOpacity
                                activeOpacity={1}
                                onPress={() => navigation.navigate('LivePush')}
                            >
                                <Text style={{fontSize: 16, color: '#fff'}}>开启直播</Text>
                            </TouchableOpacity>
                            : null
                    }
                </View>
            ),
        };
    }

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            types: [],
        };
    }

    render(): React.ReactNode {
        if (this.state.isLoading) {
            return <LoadingView/>;
        }
        let contents = this.state.types.map((item, index) => {
            return <LiveListComponent
                typeid={item.channel_id}
                onPressItem={(live) => {
                    this.props.navigation.navigate('LivePlay', live);
                }}
                tabLabel={item.name}
                key={index.toString()}/>;
        });
        return (
            <ScrollableTabView
                renderTabBar={() => <ScrollableTabBar
                    style={{
                        height: 44,
                        borderBottomWidth: 0.5,
                        backgroundColor: '#fff',
                        borderBottomColor: '#e0e0e0',
                    }}
                    tabStyle={{
                        paddingLeft: 5,
                        paddingRight: 5,
                        paddingTop: 15,
                        paddingBottom: 15,
                    }}
                />}
                tabBarActiveTextColor={Colors.primary}
                tabBarInactiveTextColor="#222"
                tabBarUnderlineStyle={{
                    backgroundColor: Colors.primary,
                    height: 3,
                    bottom: -1,
                }}
                tabBarTextStyle={{fontSize: 15}}
                initialPage={0}
                style={{
                    backgroundColor: '#f2f2f2',
                }}
            >
                {contents}
            </ScrollableTabView>
        );
    }

    componentDidMount(): void {
        const userinfo = this.props.auth.userinfo;
        if (userinfo.type === 1 || userinfo.type === 2) {
            this.props.navigation.setParams({
                canLive: true,
            });
        } else {
            this.props.navigation.setParams({
                canLive: true,
            });
        }
        ApiClient.get('/live/channel/batchget').then(response => {
            const types = response.data.items;
            this.setState({
                isLoading: false,
                types,
            });
        });
    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth,
    };
};

export default connect(mapStateToProps)(LiveIndex);

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {DeviceEventEmitter, AppState, Linking, Alert} from 'react-native';
import AsyncStorage from "@react-native-async-storage/async-storage";
import JPush from 'jpush-react-native';
import CodePush from 'react-native-code-push';
import GeoLocation from '@react-native-community/geolocation';
import {NavigationContainer} from '@react-navigation/native';
import {authActionCreators, locationActionCreators} from '../actions';
import {ApiClient, Utils} from '../utils';
import {LaunchScreen} from "../components";
import AppContainer from "./AppContainer";
import {
    AccessToken,
    AppUrl,
    AppVersion,
    CodePushDeploymentKey,
    isAndroid,
    UserDidSigninedNotification,
    UserDidSignoutedNotification,
} from "../base/constants";

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            showLaunch: isAndroid
        };
    }

    render() {
        if (this.state.showLaunch) return <LaunchScreen/>;
        return (
            <NavigationContainer>
                <AppContainer/>
            </NavigationContainer>
        );
    }

    UNSAFE_componentWillMount(): void {
        this.checkUserStatus();
        Utils.setStatusBarStyle('light');
        AppState.addEventListener('change', this.onAppStateChange);
    }

    componentDidMount() {
        const {authActions, locationActions} = this.props;
        DeviceEventEmitter.addListener(UserDidSigninedNotification, (userinfo) => {
            authActions.userDidSignIn(userinfo);
            AsyncStorage.getItem('RegistrationID').then(registrationid => {
                this.registerJpushToken(registrationid, userinfo.uid);
            });
        });

        DeviceEventEmitter.addListener(UserDidSignoutedNotification, () => {
            authActions.userDidSignOut();
            AsyncStorage.removeItem(AccessToken);
        });

        //获取位置信息
        GeoLocation.getCurrentPosition(position => {
            //console.log(position);
            locationActions.userLocationDidChanged(position);
            GeoLocation.watchPosition(position => {
                locationActions.userLocationDidChanged(position);
            }, error => {
                console.log(error);
            }, {
                maximumAge: 600000
            });
        }, error => {
            console.log(error);
        });

        setTimeout(() => {
            this.setState({
                showLaunch: false
            });
        }, 2000);

        //注册通知
        this.setupJPush();
    }

    onAppStateChange = (appState) => {
        if (Platform.OS === 'ios') {
            //PushNotificationIOS.setApplicationIconBadgeNumber(0);
            JPush.setBadge({badge: 0});
        }
        //console.log('appState:'+appState);
        if (appState === 'active') {
            //检测新版本
            this.checkVersion();
        }
    };

    checkUserStatus = () => {
        const {authActions} = this.props;
        ApiClient.get('/user/info').then(response => {
            //console.log(response.data);
            authActions.userDidSignIn(response.data.userinfo);
        }).catch(reason => {

        });
    };

    setupJPush = () => {
        JPush.init();
        JPush.addNotificationListener((message) => {
            // console.log('ReceiveNotification');
            // console.log(message);
        });

        JPush.addNotificationListener((message) => {
            //console.log(message);
            let extras = message.extras;
            if (isAndroid) {
                extras = JSON.parse(extras);
            } else {
                JPush.setBadge({badge: 0});
            }
            if (extras.action === 'upgrade') {
                Linking.openURL(AppUrl);
            }
        });

        JPush.addCustomMessagegListener((message) => {
            // console.log('addReceiveCustomMsgListener');
            // console.log(message);
        });

        JPush.getRegistrationID(res => {
            //console.log(res);
            AsyncStorage.setItem('RegistrationID', res.registerID).then(() => {
                this.registerJpushToken(res.registerID);
            });
        });
    };

    checkVersion = () => {
        //检测新版本
        ApiClient.get('/getversion', {platform: Platform.OS}).then(response => {
            //console.log(response.data);
            if (response.data.version > AppVersion) {
                Alert.alert(null, 'APP已有新的版本,是否现在升级?', [
                    {text: '取消'},
                    {text: '确定', onPress: () => Linking.openURL(AppUrl)},
                ]);
            }
        });
    };

    registerJpushToken = (registrationid, uid = 0) => {
        ApiClient.post('/apns/jpush', {
            platform: Platform.OS,
            registrationid,
            uid
        }).then((response => {
            //console.log(response.data);
        })).catch(reason => {
            console.log(reason);
        });
    }
}

const mapStateToProps = (store) => {
    return {...store};
};

const mapDispatchToProps = (dispatch) => {
    const authActions = bindActionCreators(authActionCreators, dispatch);
    const locationActions = bindActionCreators(locationActionCreators, dispatch);
    return {
        authActions,
        locationActions
    }
};

const codePushOptions = {
    checkFrequency: CodePush.CheckFrequency.ON_APP_RESUME,
    updateDialog: false,
    installMode: CodePush.InstallMode.IMMEDIATE,
    deploymentKey: CodePushDeploymentKey
};

App = CodePush(codePushOptions)(App);
export default connect(mapStateToProps, mapDispatchToProps)(App);

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {
    DeviceEventEmitter,
    AppState,
    Platform,
    Linking,
    Alert,
    InteractionManager
} from 'react-native';
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
    CodePushAndroidKey,
    CodePushIosKey,
    UserDidLoggedInNotification,
    UserDidLogoutNotification,
    UserInfoStoreKey
} from "../base/constants";

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            showLaunch: Platform.OS !== 'ios'
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
    }

    componentDidMount() {
        AppState.removeEventListener('change', this.onAppStateChange);
        const {authActions, locationActions} = this.props;
        DeviceEventEmitter.addListener(UserDidLoggedInNotification, (userinfo) => {
            AsyncStorage.setItem(UserInfoStoreKey, JSON.stringify(userinfo)).then(() => {
                authActions.userDidLoggedIn(userinfo);
            });
            AsyncStorage.getItem('RegistrationID').then(registrationid => {
                this.registerJpushToken(registrationid);
            });
        });

        DeviceEventEmitter.addListener(UserDidLogoutNotification, () => {
            AsyncStorage.removeItem(UserInfoStoreKey).then(() => {
                authActions.userDidLogout();
            });
            AsyncStorage.removeItem(AccessToken);
        });

        //注册通知
        this.setupJPush();

        InteractionManager.runAfterInteractions(() => {
            AppState.addEventListener('change', this.onAppStateChange);
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
            })
        }, 2000);
        //更新版本
        this.checkUpdates();
    }

    onAppStateChange = (appState) => {
        if (Platform.OS === 'ios') {
            //PushNotificationIOS.setApplicationIconBadgeNumber(0);
            JPush.setBadge({badge: 0});
        }
        //console.log('appState:'+appState);
        if (appState === 'active') {
            //this.checkLogin();
            //检测新版本
            this.checkVersion();
            this.checkUpdates();
        }
    };

    checkUpdates = () => {
        //热更新
        if (!__DEV__) {
            // CodePush.sync({
            //     updateDialog: false,
            //     installMode: CodePush.InstallMode.IMMEDIATE,
            //     deploymentKey: Platform.OS === 'ios' ? CodePushIosKey : CodePushAndroidKey,
            // });
        }
    };

    checkUserStatus = () => {
        const {authActions} = this.props;
        AsyncStorage.getItem(UserInfoStoreKey).then(userinfo => {
            if (userinfo) {
                authActions.userDidLoggedIn(JSON.parse(userinfo));
            } else {
                authActions.userDidLogout();
            }
        }).catch(error => {
            authActions.userDidLogout();
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
            if (Platform.OS === 'ios') {
                JPush.setBadge({badge: 0});
            } else {
                extras = JSON.parse(extras);
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
            if (response.data.version > AppVersion) {
                Alert.alert(null, 'APP已有新的版本,是否现在升级?', [
                    {text: '取消'},
                    {text: '确定', onPress: () => Linking.openURL(AppUrl)},
                ]);
            }
        });
    };

    registerJpushToken = (registrationid) => {
        ApiClient.post('/jpush', {
            platform: Platform.OS,
            registrationid
        }).then((response => {
            console.log(response.data);
        })).catch(reason => {
            console.log(reason);
        });
    }
}

const mapStateToProps = (store) => {
    const {auth, location} = store;
    return {
        auth,
        location
    };
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
    deploymentKey: Platform.OS === 'ios' ? CodePushIosKey : CodePushAndroidKey
};

App = CodePush(codePushOptions)(App);
export default connect(mapStateToProps, mapDispatchToProps)(App);

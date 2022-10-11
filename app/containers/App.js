import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {DeviceEventEmitter, AppState, Linking, Alert} from 'react-native';
import AsyncStorage from "@react-native-async-storage/async-storage";
import JPush from 'jpush-react-native';
import CodePush from 'react-native-code-push';
import Geolocation from '@react-native-community/geolocation';
import {oauthActionCreators, locationActionCreators, userActionCreators} from '../actions';
import {ApiClient} from '../utils';
import AppContainer from "./AppContainer";
import {
    AccessToken,
    AppUrl,
    AppVersion,
    isAndroid,
    UserDidSigninedNotification,
    UserDidSignoutedNotification,
    UserDidChangedNotification
} from "../base/constants";

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <AppContainer/>
        );
    }

    componentDidMount() {
        this.addListeners();
        this.watchPosition();
        this.setupJPush();
    }

    componentWillUnmount() {
        DeviceEventEmitter.removeAllListeners();
        this.setState = (state, callback) => {
        };
    }

    addListeners = () => {
        const {oauthActions, userActions} = this.props;
        AppState.addEventListener('change', this.onAppStateChange);
        DeviceEventEmitter.addListener(UserDidSigninedNotification, (res) => {
            oauthActions.userDidSignIn();
            AsyncStorage.getItem('RegistrationID').then(registrationid => {
                this.registerJpushToken(registrationid);
            });
        });

        DeviceEventEmitter.addListener(UserDidSignoutedNotification, _ => {
            AsyncStorage.removeItem(AccessToken);
            oauthActions.userDidSignOut();
        });

        DeviceEventEmitter.addListener(UserDidChangedNotification, userInfo => {
            userActions.userDidChanged(userInfo);
        });
    };

    watchPosition = () => {
        //获取位置信息
        const {locationActions} = this.props;
        Geolocation.requestAuthorization(() => {
            Geolocation.watchPosition(position => {
                locationActions.userLocationDidChanged(position);
            }, error => {
                console.log(error);
            }, {
                maximumAge: 600000,
            });
        }, error => {
            console.log(error);
        });
    };

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

        JPush.getRegistrationID(res => {
            //console.log(res);
            AsyncStorage.setItem('RegistrationID', res.registerID).then(() => {
                this.registerJpushToken(res.registerID);
            });
        });
    };

    checkVersion = () => {
        //检测新版本
        ApiClient.get('/app/getversion', {platform: Platform.OS}).then(response => {
            //console.log(response.result);
            if (response.result.version > AppVersion) {
                Alert.alert(null, 'APP已有新的版本,是否现在升级?', [
                    {text: '取消'},
                    {text: '确定', onPress: () => Linking.openURL(AppUrl)},
                ]);
            }
        });
    };

    registerJpushToken = (registrationid) => {
        ApiClient.post('/apns/jpush', {
            platform: Platform.OS,
            registrationid
        }).then((response => {
            //console.log(response.result);
        })).catch(reason => {
            console.log(reason);
        });
    };
}

const mapStateToProps = state => {
    return state;
};

const mapDispatchToProps = (dispatch) => {
    const userActions = bindActionCreators(userActionCreators, dispatch);
    const oauthActions = bindActionCreators(oauthActionCreators, dispatch);
    const locationActions = bindActionCreators(locationActionCreators, dispatch);
    return {
        userActions,
        oauthActions,
        locationActions,
    };
};

const codePushOptions = {
    updateDialog: false,
    checkFrequency: CodePush.CheckFrequency.ON_APP_RESUME,
    installMode: CodePush.InstallMode.IMMEDIATE
};

App = CodePush(codePushOptions)(App);
export default connect(mapStateToProps, mapDispatchToProps)(App);

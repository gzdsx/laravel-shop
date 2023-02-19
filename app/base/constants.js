import {Platform} from 'react-native';

export const isAndroid = Platform.OS === 'android';
export const AppVersion = 1.2;
export const BaseApi = 'https://shop.gzdsx.cn/api';
export const BaseUri = 'https://shop.gzdsx.cn/h5';
export const OAuthApi = 'https://shop.gzdsx.cn/oauth';
export const OAuthClientID = 2;
export const OAuthClientSecret = 'RIBklHvmIpQAje6RYw9Pd7r8HkAPnj5jkPWswCiK';
export const AppUrl = Platform.select({
    ios: 'https://apps.apple.com/cn/app/id1544829486?l=zh&ls=1',
    android: 'http://apps.gzdsx.cn/apk/shopapp.apk'
});

export const AccessToken = 'AccessToken';
export const UserDidSigninedNotification = 'UserDidSigninedNotification';
export const UserDidSignoutedNotification = 'UserDidSignoutedNotification';
export const UserDidChangedNotification = 'UserDidChangedNotification';

export const WeChatAppId = "wxd061fe9e48e8c5f1";
export const WeChatUniversalLink = "https://shop.gzdsx.cn/app/ios/";

export const CartDidChangedNotification = "CartDidChangedNotification";

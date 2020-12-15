import {Platform} from 'react-native';

export const isAndroid = Platform.OS === 'android';
export const AppVersion = 1.0;
export const BaseApi = 'https://shop.gzdsx.cn/api';
export const BaseUri = 'https://shop.gzdsx.cn/h5';
export const OauthApi = 'https://shop.gzdsx.cn/oauth';
export const AppUrl = isAndroid ? 'https://shop.gzdsx.cn/apk/aipei.apk' : 'https://apps.apple.com/cn/app/id1479643354?l=zh&ls=1';

export const AccessToken = 'AccessToken';
export const UserDidSigninedNotification = 'UserDidSigninedNotification';
export const UserDidSignoutedNotification = 'UserDidSignoutedNotification';

export const WeChatAppId = "wxd061fe9e48e8c5f1";
export const CodePushDeploymentKey = isAndroid ? 'yPBpd4qGGSHToFcrQo3ERY2ZQ76SDFpdKI7159' : 'MVr7Qot9tWdxvjobG_vB9070CsMhqvx3FeCcC';

export const CartDidChangedNotification = "CartDidChangedNotification";

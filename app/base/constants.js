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
export const CodePushDeploymentKey = isAndroid ? 'B9BCLp6ssgLQYydPPoGE9fvsTy3oeee33286-146b-4d77-84a8-e25677b0c8e8' : 'Xv9MGBKI6RIuNlsOzdHdOr49k5Z8eee33286-146b-4d77-84a8-e25677b0c8e8';

export const CartDidChangedNotification = "CartDidChangedNotification";

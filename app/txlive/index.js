import React,{ReactPropTypes} from 'react';
import {NativeModules,requireNativeComponent} from 'react-native';

export const TXLive = NativeModules.TXLiveModule;
export const TXPush = NativeModules.TXPushModule;
export const TXPlayView = requireNativeComponent('TXLivePlayer');
export const TXPushView = requireNativeComponent('TXLivePusher');

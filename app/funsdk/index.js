import React from 'react';
import {NativeModules, requireNativeComponent} from 'react-native';

const FunModule = NativeModules.FunModule;
const FunPlayer = requireNativeComponent('FunPlayer');

export {
    FunModule,
    FunPlayer
}

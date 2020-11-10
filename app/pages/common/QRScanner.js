import React from 'react';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {RNCamera as Camera} from 'react-native-camera';

export default class QRScanner extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '扫一扫'
    });

    render() {
        return (
            <Camera style={{flex:1}}/>
        );
    }

}

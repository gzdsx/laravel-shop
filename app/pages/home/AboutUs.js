import React from 'react';
import {View} from 'react-native';
import {WebView} from 'react-native-webview';
import {LoadingView} from "react-native-gzdsx-elements";
import {BaseUri} from "../../base/constants";
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class AboutUs extends React.Component {

    constructor(props) {
        super(props);
        this.state = {}
    }

    componentDidMount() {
        const {navigation,route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '关于我们'
        });
    }

    render() {
        const uri = BaseUri + '/page/33.html';
        return (
            <WebView
                style={{flex: 1, backgroundColor: '#fff'}}
                source={{uri: uri}}
                renderError={() => <View/>}
                renderLoading={() => <LoadingView/>}
                decelerationRate={"normal"}
            />
        );
    }
}

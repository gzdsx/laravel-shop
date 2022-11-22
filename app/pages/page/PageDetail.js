import React from 'react';
import {View} from 'react-native';
import WebView from "react-native-webview";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {LoadingView} from "react-native-gzdsx-elements";
import {StatusBarStyles} from "../../styles";

export default class PageDetail extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '详情',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            page: {}
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        let {route, navigation} = this.props;
        let {id} = route.params;
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        ApiClient.get('/page/page.getInfo', {id}).then(response => {
            let page = response.result;
            this.setState({page});
            this.props.navigation.setOptions({title: page.title});
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        return <WebView
            source={{uri: this.state.page.m_url}}
            renderError={() => <View/>}
            renderLoading={() => <LoadingView/>}
            decelerationRate={"normal"}
        />;
    }

}

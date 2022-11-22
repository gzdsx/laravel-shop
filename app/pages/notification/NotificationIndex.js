import React from 'react';
import {View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {StatusBarStyles} from "../../styles";

export default class NotificationIndex extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '消息',
            headerLeft: () => null
        })
    }

    constructor(props) {
        super(props);
        this.state = {};
    }

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        })
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        return <View/>;
    }

}

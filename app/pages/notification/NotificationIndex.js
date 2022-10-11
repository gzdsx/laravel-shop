import React from 'react';
import {View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class NotificationIndex extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '消息',
        })
    }

    constructor(props) {
        super(props);
        this.state = {};
    }

    componentDidMount(): void {
        this.setNavigation();
    }

    render(): React.ReactNode {
        return <View/>;
    }

}

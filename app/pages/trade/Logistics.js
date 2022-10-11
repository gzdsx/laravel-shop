import React from 'react';
import {View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class Logistics extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '物流信息',
        })
    }

    constructor(props) {
        super(props);
        this.state = {};
    }


    render(): React.ReactNode {
        return <View/>;
    }

    componentDidMount(): void {
        this.setNavigationOptions();
    }
}

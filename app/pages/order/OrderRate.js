import React from 'react';
import {View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class OrderRate extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '评价订单',
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

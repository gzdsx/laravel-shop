import React from 'react';
import {View} from 'react-native';

export default class PageIndex extends React.Component {

    setNavigation() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            title: 'title',
            headerStyle: {},
            headerTitleStyle: {},
            headerTintColor: '#333',
            headerLeft: () => null,
            headerRight: () => null
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

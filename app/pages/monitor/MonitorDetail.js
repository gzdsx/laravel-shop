import React from 'react';
import {Text, View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";

export default class MonitorDetail extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '监控视频',
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            monitor: null
        };
    }


    render(): React.ReactNode {
        return (
            <View style={{flex:1}}>
                <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                    <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>此栏目下还没有内容</Text>
                </View>
            </View>
        );
    }

    componentDidMount(): void {
        const id = this.props.navigation.getParam('id', 0);
        ApiClient.get('/monitor', {id}).then(response => {
            this.setState({
                isLoading: false,
                monitor: response.data.monitor
            });
        });
    }
}

import React from 'react';
import {View, FlatList, Text} from 'react-native';
import {LoadingView, TableCell} from "react-native-dsxui";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";

export default class MonitorList extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '监控设备列表',
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            items: []
        };
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <FlatList
                keyExtractor={(item) => item.id.toString()}
                data={this.state.items}
                renderItem={({item}) => {
                    return (
                        <TableCell
                            isLink={true}
                            title={item.title}
                            onPress={() => {
                                this.props.navigation.navigate('MonitorDetail', {id: item.id});
                            }}
                        />
                    )
                }}
                ListEmptyComponent={() => {
                    return (
                        <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                            <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>此学校暂无设备</Text>
                        </View>
                    );
                }}
            />
        );
    }

    componentDidMount(): void {
        const school_id = this.props.navigation.getParam('school_id', 0);
        ApiClient.get('/monitor/batchget', {school_id}).then(response => {
            console.log(response.data);
            this.setState({
                isLoading: false,
                items: response.data.items
            });
        });
    }
}

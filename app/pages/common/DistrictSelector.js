import React from 'react';
import {FlatList, Text, View, TouchableHighlight, DeviceEventEmitter} from 'react-native';
import {LoadingView} from 'react-native-dsxui';
import {Utils, ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class DistrictSelector extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '选择区域',
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            items: [],
        };
        this.district = {
            province: null,
            city: null,
            district: null
        };
    }


    render() {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <FlatList
                style={{flex: 1, backgroundColor: '#fff'}}
                data={this.state.items}
                renderItem={({item}) => {
                    return (
                        <TouchableHighlight onPress={() => this.onPickedDistrict(item)} underlayColor={"#f0f0f0"}
                                            style={{backgroundColor: '#fff'}}>
                            <Text style={{fontSize: 16, padding: 15}}>{item.name}</Text>
                        </TouchableHighlight>
                    );
                }}
                keyExtractor={(item) => item.id.toString()}
                ItemSeparatorComponent={() => <View style={{height: 0.5, backgroundColor: '#e5e5e5'}}/>}
            />
        );
    }


    componentDidMount() {
        this.fetchDatasource(0);
        //this.listener = this.props.navigation.addListener('willFocus', () => Utils.setStatusBarStyle());
    }


    componentWillUnmount() {
        //this.listener.remove();
    }


    fetchDatasource = (fid) => {
        ApiClient.get('/district/batchget', {fid})
            .then(response => {
                this.setState({
                    isLoading: false,
                    items: response.data.items
                });
            });
    };

    onPickedDistrict = (item) => {
        if (item.level === 1) {
            this.district.province = item.name;
            this.fetchDatasource(item.id);
        }

        if (item.level === 2) {
            this.district.city = item.name;
            this.fetchDatasource(item.id);
        }

        if (item.level === 3) {
            this.district.district = item.name;
            DeviceEventEmitter.emit('onPickedDistrict', this.district);
            this.props.navigation.goBack();
        }
    }
}

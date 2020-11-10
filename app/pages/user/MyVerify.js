import React from 'react';
import {View, Image, Text, FlatList} from 'react-native';
import {TableCell} from "react-native-dsxui";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";

export default class MyVerify extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '我的审核',
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            items: []
        };
    }


    render(): React.ReactNode {
        return (
            <FlatList
                keyExtractor={(item) => item.uid.toString()}
                data={this.state.items}
                renderItem={({item}) => {
                    return (
                        <TableCell
                            icon={() => {
                                return <Image
                                    source={{uri: item.avatar}}
                                    style={{
                                        width: 50,
                                        height: 50,
                                        borderRadius: 25
                                    }}
                                />
                            }}
                            title={item.username}
                            isLink={true}
                            onPress={() => this.props.navigation.navigate('VerifyUser', {
                                uid: item.uid, callback: () => {
                                    this.fetchData();
                                }
                            })}
                        />
                    );
                }}
                ListEmptyComponent={()=>{
                    return (
                        <View style={{padding: 50, alignItems: 'center', alignContent: 'center'}}>
                            <Text style={{fontSize: 16, color: '#666', textAlign: 'center'}}>没有需要审核的用户</Text>
                        </View>
                    );
                }}
            />
        );
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = () => {
        ApiClient.get('/user/verify/batchget').then(response => {
            const items = response.data.items;
            this.setState({
                items,
                isLoading: false
            });
        });
    }
}

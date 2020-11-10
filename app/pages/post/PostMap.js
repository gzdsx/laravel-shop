import React from 'react';
import {View, ScrollView, Text, TouchableOpacity} from 'react-native';
import {LoadingView} from "react-native-dsxui";
import {Colors, Size, Styles} from "../../styles";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class PostMap extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '文章分类'
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            catlogs: []
        };
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        let contents = this.state.catlogs.map((item, index) => {
            let childs = item.childs.map((child) => {
                return (
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{
                            paddingTop: 15,
                            paddingBottom: 15,
                            alignContent: 'center',
                            justifyContent: 'center',
                            width: Size.screenWidth * 0.33
                        }}
                        key={child.catid.toString()}
                        onPress={() => {
                            this.props.navigation.navigate('PostList', {catid: child.catid, title: child.name});
                        }}
                    >
                        <Text style={{fontSize: 16, textAlign: 'center'}}>{child.name}</Text>
                    </TouchableOpacity>
                );
            });
            return (
                <View style={{marginTop: 10, marginBottom: 10}} key={item.catid.toString()}>
                    <TouchableOpacity
                        style={{padding: 15}}
                        activeOpacity={1}
                        onPress={() => {
                            this.props.navigation.navigate('PostList', {catid: item.catid, title: item.name});
                        }}
                    >
                        <Text style={{
                            fontSize: 20,
                            fontWeight: '600',
                            color: '#333',
                            textAlign: 'center'
                        }}>{item.name}</Text>
                    </TouchableOpacity>
                    <View style={{
                        flexDirection: 'row',
                        flexWrap: 'wrap'
                    }}>
                        {childs}
                    </View>
                </View>
            );
        });
        return (
            <ScrollView>{contents}</ScrollView>
        );
    }

    componentDidMount(): void {
        ApiClient.get('/post/catlog/tree').then(response => {
            let catlogs = response.data.items;
            this.setState({
                isLoading: false,
                catlogs
            });
        });
    }
}

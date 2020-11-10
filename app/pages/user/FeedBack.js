import React from 'react';
import {View, TextInput, StyleSheet} from 'react-native';
import {ApiClient, Toast} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CustomButton} from "../../components";

export default class FeedBack extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '意见反馈',
    });

    constructor(props) {
        super(props);
        this.state = {
            title: null,
            message: null
        }
    }


    render() {
        return (
            <View style={css.container}>
                <View style={css.row}>
                    <TextInput
                        style={css.text}
                        placeholder="请输入你要反馈的问题"
                        underlineColorAndroid="transparent"
                        onChangeText={(title) => {
                            this.setState({title});
                        }}
                        returnKeyType={"done"}
                    />
                </View>
                <View style={css.row}>
                    <TextInput
                        style={[css.text, {height: 200}]}
                        placeholder="请描述一下你的问题，不少于10个字"
                        multiline={true}
                        underlineColorAndroid="transparent"
                        onChangeText={(message) => {
                            this.setState({message});
                        }}
                    />
                </View>
                <View style={css.row}>
                    <CustomButton text="提交" onPress={this.submit}/>
                </View>
            </View>
        );
    }

    submit = () => {
        if (!this.state.title) {
            Toast.show('请输入你要反馈的问题');
            return false;
        }

        if (!this.state.message) {
            Toast.show('请描述一下你的问题，不少于10个字');
            return false;
        }

        ApiClient.post('/feedback/save', this.state)
            .then(response => {
                Toast.show('你的问题已提交', {
                    onHidden: () => this.props.navigation.goBack()
                });
            });
    }
}

const css = StyleSheet.create({
    container: {
        padding: 20,
        flex: 1,
        backgroundColor: '#f8f8f8'
    },
    row: {
        marginBottom: 20
    },
    text: {
        fontSize: 16,
        backgroundColor: '#fff',
        borderBottomColor: '#e0e0e0',
        borderRadius: 3,
        padding: 10,
        textAlignVertical: 'top'
    }
});

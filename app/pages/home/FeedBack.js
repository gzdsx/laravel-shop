import React from 'react';
import {View, TextInput, StyleSheet} from 'react-native';
import {Button} from 'react-native-elements';
import {Toast} from 'react-native-gzdsx-elements';
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors} from "../../styles";

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
                    <Button
                        buttonStyle={{backgroundColor: Colors.primary, height: 45}}
                        title="提交"
                        onPress={this.submit}
                        activeOpacity={0.8}
                    />
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    submit = () => {
        if (!this.state.title) {
            this.refs.toast.show('请输入你要反馈的问题');
            return false;
        }

        if (!this.state.message) {
            this.refs.toast.show('请描述一下你的问题，不少于10个字');
            return false;
        }

        ApiClient.post('/feedback/save', this.state).then(response => {
            this.refs.toast.show('你的问题已提交', {
                onHide: () => this.props.navigation.goBack()
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

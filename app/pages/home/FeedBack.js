import React from 'react';
import {View, TextInput, StyleSheet} from 'react-native';
import {Button} from 'react-native-elements';
import {Toast} from 'react-native-gzdsx-elements';
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ButtonStyles, StatusBarStyles} from "../../styles";

export default class FeedBack extends React.Component {

    setNavigationOptions = () => {
        let {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '意见反馈',
        });
    };

    constructor(props) {
        super(props);
        this.state = {
            title: null,
            message: null
        }
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
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
                        title="提交"
                        onPress={this.submit}
                        activeOpacity={0.8}
                        buttonStyle={ButtonStyles.primary}
                    />
                </View>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    submit = () => {
        let {title, message} = this.state;
        if (!title) {
            Toast.fail('请输入你要反馈的问题');
            return false;
        }

        if (!message) {
            Toast.fail('请描述一下你的问题，不少于10个字');
            return false;
        }

        ApiClient.post('/common/feedback.create', {title, message}).then(response => {
            Toast.success('你的问题已提交', {
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

import React from 'react';
import {View, Text, TouchableOpacity} from 'react-native';
import {Colors} from "../styles";

export class CustomButton extends React.Component{
    static defaultProps = {
        onPress: () => null,
        text: '提交',
        type: 'primary',
        style: {}
    };

    render(): React.ReactNode {
        return (
            <TouchableOpacity
                style={{
                    flexDirection: 'row',
                    backgroundColor: Colors[this.props.type],
                    borderRadius: 10,
                    height: 45,
                    ...this.props.style
                }}
                activeOpacity={0.8}
                onPress={this.props.onPress}
            >
                <View
                    style={{
                        flex: 1,
                        alignSelf: 'center',
                    }}
                >
                    <Text style={{
                        fontSize: 16,
                        color: '#fff',
                        textAlign: 'center',
                    }}>{this.props.text}</Text>
                </View>
            </TouchableOpacity>
        );
    }
}

export class PlainButton extends React.Component{

    static defaultProps = {
        onPress: () => null,
        text: '提交',
        type: 'primary'
    };

    render(): React.ReactNode {
        return (
            <TouchableOpacity
                style={{
                    borderWidth: 0.5,
                    borderColor: '#C8161D',
                    flexDirection: 'row',
                    height: 45
                }}
                activeOpacity={0.8}
                onPress={this.props.onPress}
            >
                <View
                    style={{
                        flex: 1,
                        alignSelf: 'center',
                    }}
                >
                    <Text style={{
                        fontSize: 16,
                        color: '#C8161D',
                        textAlign: 'center',
                    }}>{this.props.text}</Text>
                </View>
            </TouchableOpacity>
        );
    }
}

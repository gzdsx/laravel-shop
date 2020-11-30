import React from 'react';
import {View, Text, TouchableOpacity, TextInput} from 'react-native';
import PropTypes from 'prop-types';

export class NumberControl extends React.Component {

    static propTypes = {
        defaultValue: PropTypes.number,
        maxValue: PropTypes.number,
        onValueChange: PropTypes.func
    };

    static defaultProps = {
        defaultValue: 1,
        maxValue: 99999,
        onValueChange: () => null
    };

    constructor(props) {
        super(props);
        this.state = {
            value: props.defaultValue
        }
    }

    render() {
        return (
            <View style={{
                flexDirection: 'row',
                height: 30,
                ...this.props.style
            }}>
                <TouchableOpacity
                    style={{backgroundColor: '#f2f2f2'}}
                    activeOpacity={1}
                    onPress={this.decrease}
                >
                    <Text style={{
                        width: 30,
                        height: 30,
                        lineHeight: 30,
                        textAlign: 'center',
                        fontSize: 16,
                        color: '#333'
                    }}>-</Text>
                </TouchableOpacity>
                <TextInput
                    defaultValue={this.state.value.toString()}
                    keyboardType={"numeric"}
                    onChangeText={(text) => {
                        if (isNaN(text)) return;
                        let value = Math.abs(parseInt(text));
                        if (value > this.props.maxValue) value = this.props.maxValue;
                        if (value < 1) value = 1;
                        this.setState({value});
                        this.props.onValueChange(value);
                    }}
                    returnKeyType={"done"}
                    underlineColorAndroid={"transparent"}
                    style={{
                        width: 40,
                        height: 30,
                        borderWidth: 0,
                        padding: 0,
                        fontSize: 14,
                        color: '#333',
                        backgroundColor: '#f2f2f2',
                        marginHorizontal: 1,
                        textAlign: 'center',
                        textAlignVertical: 'center',
                    }}
                />
                <TouchableOpacity
                    style={{backgroundColor: '#f2f2f2'}}
                    activeOpacity={1}
                    onPress={this.increase}
                >
                    <Text style={{
                        width: 30,
                        height: 30,
                        lineHeight: 30,
                        textAlign: 'center',
                        fontSize: 16,
                        color: '#333'
                    }}>+</Text>
                </TouchableOpacity>
            </View>
        );
    }


    increase = () => {
        let {value} = this.state;
        const {maxValue} = this.props;
        value++;
        if (maxValue) {
            if (value > maxValue) {
                value = maxValue;
            }
        }
        this.setState({value});
        this.props.onValueChange(value);
    };

    decrease = () => {
        let {value} = this.state;
        value--;
        if (value < 1) value = 1;
        this.setState({value});
        this.props.onValueChange(value);
    };
}

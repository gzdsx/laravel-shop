import React from 'react';
import {View, Text, TouchableOpacity, TextInput, StyleSheet} from 'react-native';
import PropTypes from 'prop-types';

export class NumberControl extends React.Component{

    static propTypes = {
        defaultValue:PropTypes.number,
        maxValue:PropTypes.number,
        onValueChange:PropTypes.func
    };

    static defaultProps = {
        defaultValue:1,
        maxValue:0,
        onValueChange:()=>null
    };

    constructor(props) {
        super(props);
        this.state = {
            numberValue:1
        };
    }


    render() {
        return (
            <View style={{
                flexDirection:'row',
                height:30,
                ...this.props.style
            }}>
                <TouchableOpacity
                    style={{
                        backgroundColor:'#f2f2f2'
                    }}
                    activeOpacity={1}
                    onPress={this.decrease}
                >
                    <Text style={{
                        width:30,
                        height:30,
                        lineHeight:30,
                        textAlign:'center',
                        fontSize:16,
                        color:'#333'
                    }}>-</Text>
                </TouchableOpacity>
                <TextInput
                    value={this.state.numberValue.toString()}
                    keyboardType={"numeric"}
                    onChangeText={(text)=>{
                        this.state.numberValue = parseInt(text);
                        this.props.onValueChange(this.state.numberValue);
                    }}
                    returnKeyType={"done"}
                    underlineColorAndroid={"transparent"}
                    style={{
                        width:40,
                        height:30,
                        borderWidth:0,
                        padding:0,
                        textAlignVertical:'center',
                        fontSize:14,
                        color:'#333',
                        backgroundColor:'#f2f2f2',
                        marginLeft:1,
                        marginRight:1,
                        textAlign:'center'
                    }}
                />
                <TouchableOpacity
                    style={{
                        backgroundColor:'#f2f2f2'
                    }}
                    activeOpacity={1}
                    onPress={this.increase}
                >
                    <Text style={{
                        width:30,
                        height:30,
                        lineHeight:30,
                        textAlign:'center',
                        fontSize:16,
                        color:'#333'
                    }}>+</Text>
                </TouchableOpacity>
            </View>
        );
    }


    componentDidMount() {
        const {defaultValue} = this.props;
        if (defaultValue > 0) this.setState({numberValue:defaultValue});
    }


    increase = () => {
        let {numberValue} = this.state;
        const {maxValue, onValueChange} = this.props;

        numberValue++;
        if (maxValue) {
            if (numberValue > maxValue) {
                numberValue = maxValue;
            }
        }

        this.setState({
            numberValue
        });
        onValueChange(numberValue);
    };

    decrease = () => {
        let {numberValue} = this.state;

        numberValue--;
        if (numberValue < 1) numberValue = 1;

        this.setState({
            numberValue
        });
        this.props.onValueChange(numberValue);
    };
}

const css = StyleSheet.create({

});
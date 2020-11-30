import React from 'react';
import {TouchableOpacity, Image, Text} from 'react-native';
import PropTypes from 'prop-types';

export default class CheckBox extends React.Component {
    static propTypes = {
        checked: PropTypes.bool,
        color: PropTypes.string,
        activeColor: PropTypes.string,
        size: PropTypes.number,
        title: PropTypes.string,
        titleStyle: PropTypes.object,
        onPress: PropTypes.func
    }

    static defaultProps = {
        checked: false,
        color: '#bbb',
        activeColor: '#FF4101',
        size: 22,
        title: null,
        titleStyle: {},
        onPress: () => null
    }

    render() {
        let {size, color, activeColor, checked} = this.props;
        return (
            <TouchableOpacity
                activeOpacity={1}
                style={{
                    flexDirection: 'row',
                    alignItems: 'center',
                    justifyContent: 'center',
                    alignSelf: 'center',
                    ...this.props.style
                }}
                onPress={() => {
                    this.props.onPress();
                }}
            >
                <Image
                    source={checked ? require('../images/controls/round_check_fill.png') : require('../images/controls/round.png')}
                    style={{
                        width: size,
                        height: size,
                        tintColor: checked ? activeColor : color
                    }}
                />
                {
                    this.props.title ?
                        <Text style={{
                            fontSize: 14,
                            marginLeft: 5,
                            color: '#333',
                            ...this.props.titleStyle
                        }}>{this.props.title}</Text>
                        : null
                }
            </TouchableOpacity>
        );
    }
}

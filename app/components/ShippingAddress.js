import React from 'react';
import {TableCell, TableCellGroup} from "react-native-dsxui";
import {Text, View} from "react-native";
import {Ticon} from "react-native-ticon";
import PropTypes from 'prop-types';

export default class ShippingAddress extends React.Component<{
    onPress?: PropTypes.func,
    data: PropTypes.object
}> {

    static defaultProps = {
        onPress: () => null
    };

    render() {
        const {data, onPress} = this.props;
        return (
            <TableCellGroup>
                <TableCell isLink={true} onPress={onPress}>
                    <View style={{alignItems: 'center', alignSelf: 'center', marginRight: 10}}>
                        <Ticon name={"location"} size={28} color={"#666"}/>
                    </View>
                    <View style={{flex: 1}}>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{
                                flex: 1,
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333'
                            }}>收货人: {data.consignee}</Text>
                            <Text style={{
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333',
                                textAlign: 'right'
                            }}>收货人: {data.phone}</Text>
                        </View>
                        <Text
                            style={{
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333',
                                marginTop: 5
                            }}
                            numberOfLines={2}
                        >收货地址: {data.province}{data.city}{data.district}{data.street}</Text>
                    </View>
                </TableCell>
            </TableCellGroup>
        );
    }

}

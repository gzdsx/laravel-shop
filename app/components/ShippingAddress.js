import React from 'react';
import {Text, View} from "react-native";
import {Ticon, TableView, TableCell} from "react-native-gzdsx-elements";
import PropTypes from 'prop-types';

export default class ShippingAddress extends React.Component {

    static propTypes = {
        onPress: PropTypes.func,
        data: PropTypes.object,
        isLink: PropTypes.bool
    }

    static defaultProps = {
        onPress: () => null,
        isLink: true
    };

    render() {
        const {data, onPress, isLink} = this.props;
        return (
            <TableView>
                <TableCell style={{paddingHorizontal: 10, paddingVertical: 20}} onPress={onPress}>
                    <View style={{alignItems: 'center', alignSelf: 'center', marginRight: 10}}>
                        <Ticon name={"location"} size={24} color={"#666"}/>
                    </View>
                    <View style={{flex: 1, paddingRight: 10}}>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{
                                flex: 1,
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333'
                            }}>收货人: {data.name}</Text>
                            <Text style={{
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333',
                                textAlign: 'right'
                            }}>{data.tel}</Text>
                        </View>
                        <Text
                            style={{
                                fontSize: 14,
                                fontWeight: '400',
                                color: '#333',
                                marginTop: 5
                            }}
                            numberOfLines={2}
                        >收货地址: {data.full_address}</Text>
                    </View>
                    <TableCell.Accessory/>
                </TableCell>
            </TableView>
        );
    }
}

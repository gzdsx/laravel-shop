import React from 'react';
import {StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {CacheImage} from "react-native-gzdsx-cache-image";
import PropTypes from 'prop-types';
import {Size} from "../../../styles";

export default class ProductColumnItem extends React.Component {

    static displayName = "ProductColumnItem";
    static propTypes = {
        product: PropTypes.object,
        onPress: PropTypes.func,
        style: PropTypes.object
    }

    render(): React.ReactNode {
        let {product, onPress} = this.props;
        return (
            <TouchableOpacity
                style={[style.item, {...this.props.style}]}
                activeOpacity={1}
                onPress={() => {
                    onPress && onPress(product)
                }}
            >
                <View style={style.content}>
                    <CacheImage source={{uri: product.thumb}} style={style.image}/>
                    <Text style={style.title} numberOfLines={2}>{product.title}</Text>
                    <View style={style.meta}>
                        <Text style={style.price}>￥{product.price}</Text>
                        <Text style={style.sold}>已售{product.sold}</Text>
                    </View>
                </View>
            </TouchableOpacity>
        );
    }

}

const boxWidth = (Size.screenWidth - 30) / 2;
const style = StyleSheet.create({
    item: {
        width: boxWidth,
        marginHorizontal: 5
    },
    content: {
        backgroundColor: '#fff',
        borderRadius: 2
    },
    image: {
        width: boxWidth,
        height: boxWidth,
        resizeMode: 'cover'
    },
    title: {
        fontSize: 14,
        color: '#000',
        height: 60,
        padding: 10,
        fontWeight: '400'
    },
    meta: {
        flexDirection: 'row',
        paddingLeft: 10,
        paddingRight: 10,
        paddingBottom: 10
    },
    price: {
        flex: 1,
        color: '#f40',
        fontSize: 16,
        fontWeight: '600',
    },
    sold: {
        color: '#888',
        textAlign: 'right',
        fontSize: 14,
        fontWeight: '300',
        paddingTop: 2
    }
});

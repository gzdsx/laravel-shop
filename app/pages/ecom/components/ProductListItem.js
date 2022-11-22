import {StyleSheet, Text, TouchableOpacity, View} from "react-native";
import {useNavigation} from '@react-navigation/native';
import FastImage from "react-native-fast-image";
import React from "react";
import {Size} from "../../../styles";

export default function ({product = {}, style = {}}) {
    let navigation = useNavigation();
    return (
        <TouchableOpacity
            style={[styles.item, {...style}]}
            activeOpacity={1}
            onPress={() => {
                navigation.navigate('product-detail', {itemid: product.itemid});
            }}
        >
            <View style={styles.content}>
                <FastImage source={{uri: product.thumb}} style={styles.image}/>
                <Text style={styles.title} numberOfLines={2}>{product.title}</Text>
                <View style={styles.meta}>
                    <Text style={styles.price}>￥{product.price}</Text>
                    <Text style={styles.sold}>已售{product.sold}</Text>
                </View>
            </View>
        </TouchableOpacity>
    )
}

const styles = StyleSheet.create({
    item: {
        width: Size.screenWidth / 2 - 3,
        paddingHorizontal: 5
    },
    content: {
        backgroundColor: '#fff',
        borderRadius: 2
    },
    image: {
        width: Size.screenWidth / 2 - 9,
        height: Size.screenWidth / 2 - 9,
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

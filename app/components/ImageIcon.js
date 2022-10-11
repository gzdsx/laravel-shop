import React from "react";
import {Image, TouchableOpacity} from "react-native";

export default ({color = "#333", size = 20, source, style = {}, onPress = () => null}) => {
    return (
        <TouchableOpacity
            activeOpacity={1}
            onPress={onPress}
            style={{
                justifyContent: 'center',
                ...style
            }}
        >
            <Image
                source={source}
                style={{
                    width: size,
                    height: size,
                    tintColor: color
                }}/>
        </TouchableOpacity>
    )
}

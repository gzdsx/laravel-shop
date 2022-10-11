import {Text, TouchableOpacity} from "react-native";
import React from "react";

const OrderActionButton = ({title, show = true, onPress = () => null}) => {
    if (!show) return null;
    return (
        <TouchableOpacity
            activeOpacity={1}
            style={{
                paddingHorizontal: 12,
                borderRadius: 10,
                borderWidth: 0.5,
                borderColor: '#ccc',
                marginLeft: 10,
            }}
            onPress={onPress}
        >
            <Text style={{
                flex: 1,
                color: '#333',
                fontSize: 12,
                textAlign: 'center',
                lineHeight: 28,
                height: 28
            }}>
                {title}
            </Text>
        </TouchableOpacity>
    );
};

export default OrderActionButton;

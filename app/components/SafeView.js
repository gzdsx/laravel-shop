import {useSafeAreaInsets} from "react-native-safe-area-context";
import {View} from "react-native";
import React from "react";

export function SafeHeader() {
    const insets = useSafeAreaInsets();
    return <View style={{
        paddingTop: insets.top
    }}/>;
}

export function SafeFooter() {
    const insets = useSafeAreaInsets();
    return <View style={{
        paddingTop: insets.bottom
    }}/>;
}

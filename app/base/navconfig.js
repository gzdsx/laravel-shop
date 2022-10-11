import React from 'react';
import {View} from 'react-native';
import {Colors, HeaderStyles} from '../styles';
import Icon from "react-native-vector-icons/Entypo";

const defaultNavigationConfigure = (navigation) => {
    return {
        title: 'title',
        headerTitleAlign: 'center',
        headerStyle: HeaderStyles.headerStyle,
        headerTitleStyle: HeaderStyles.headerTitleStyle,
        headerTintColor: Colors.headerTintColor,
        headerLeft: () => (
            <View style={HeaderStyles.headerLeft}>
                {
                    navigation.canGoBack() ?
                        <Icon
                            name={'chevron-thin-left'}
                            color={Colors.headerTintColor}
                            size={22}
                            suppressHighlighting={true}
                            onPress={() => {
                                navigation.goBack();
                            }}
                        />
                        : null
                }
            </View>
        ),
        headerRight: () => null,
        headerShadowVisible: false
    };
};

const lightNavigationConfigure = (navigation) => {
    return {
        title: 'title',
        headerTitleAlign: 'center',
        headerStyle: {
            backgroundColor: Colors.primary,
        },
        headerTitleStyle: {
            fontSize: 18
        },
        headerTintColor: '#fff',
        headerLeft: () => (
            <View>
                {
                    navigation.canGoBack() ?
                        <Icon
                            name={'chevron-thin-left'}
                            color={'#fff'}
                            size={22}
                            suppressHighlighting={true}
                            onPress={() => {
                                navigation.goBack();
                            }}
                        />
                        : null
                }
            </View>
        ),
        headerRight: () => null,
        headerShadowVisible: false
    };
};

export {
    defaultNavigationConfigure,
    lightNavigationConfigure
};

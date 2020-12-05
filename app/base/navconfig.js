import React from 'react';
import {View, TouchableOpacity} from 'react-native';
import {Ticon} from 'react-native-gzdsx-elements';
import {Colors, Styles} from '../styles';

const defaultNavigationConfigure = (navigation) => {
    return {
        headerStyle: Styles.headerStyle,
        headerTitle: 'title',
        headerTitleAlign: 'center',
        headerTitleStyle: Styles.headerTitleStyle,
        headerTintColor: Colors.headerTintColor,
        headerLeft: () => (
            <TouchableOpacity activeOpacity={1} onPress={() => navigation.goBack()} style={Styles.headerLeft}>
                <Ticon name={'back-light'} size={28} color={'#fff'}/>
            </TouchableOpacity>
        ),
        headerRight: () => (<View style={Styles.headerRight}/>),
    };
};

export {
    defaultNavigationConfigure,
};

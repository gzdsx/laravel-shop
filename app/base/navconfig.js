import React from 'react';
import {View,Image} from 'react-native';
import {Ticon} from 'react-native-ticon';
import {Colors, Styles} from '../styles';

const defaultNavigationConfigure = (navigation) => {
    return {
        headerStyle: Styles.headerStyle,
        headerTitle: 'title',
        headerTitleAlign: 'center',
        headerTitleStyle: Styles.headerTitleStyle,
        headerTintColor: Colors.headerTintColor,
        headerLeft: () => (
            <View style={Styles.headerLeft}>
                <Ticon name={'back-light'} size={28} color={'#fff'} onPress={() => navigation.goBack()}/>
            </View>
        ),
        headerRight: () => (<View style={Styles.headerRight}/>),
        headerBackImage: ()=> <Image source={require('../images/common/launchimage.png')}/>
    };
};

export {
    defaultNavigationConfigure,
};

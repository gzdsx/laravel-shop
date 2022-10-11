import React from 'react';
import {Image,View,StyleSheet,Dimensions, StatusBar} from 'react-native';

const WIN_WIDTH = Dimensions.get("window").width,
    WIN_HEIGHT = Dimensions.get("window").height;

const css = StyleSheet.create({
    view:{
        flex:1
    } ,
    image:{
        position:'absolute',
        left:0,
        top:0,
        resizeMode: "cover",
        width:WIN_WIDTH,
        height:WIN_HEIGHT
    }
});

export default function LaunchScreen (){
    return (
        <View style={css.view}>
            <StatusBar barStyle={"light-content"} hidden={true} translucent={true}/>
            <Image
                source={require('../images/common/launchimage.png')}
                style={css.image}
            />
        </View>
    );
}

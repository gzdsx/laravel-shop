import {createNativeStackNavigator} from '@react-navigation/native-stack';
import {NavigationContainer, DefaultTheme} from '@react-navigation/native';
import React from "react";
import Signin from "./Signin";
import Signup from "./Signup";

const Stack = createNativeStackNavigator();

export default function OAuthApp() {
    return (
        <NavigationContainer theme={DefaultTheme}>
            <Stack.Navigator defaultScreenOptions={{
                animation: 'slide_from_right'
            }}>
                <Stack.Group screenOptions={{}}>
                    <Stack.Screen name={"signin"} component={Signin} navigationKey={'signin'}/>
                    <Stack.Screen name={"signup"} component={Signup} navigationKey={'signup'}/>
                </Stack.Group>
            </Stack.Navigator>
        </NavigationContainer>
    );
}

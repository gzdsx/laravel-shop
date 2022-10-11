import React from 'react';
import {DefaultTheme, NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';
import {Platform} from "react-native";
import router from "./router";

const Stack = createNativeStackNavigator();

export default function AppContainer() {
    return (
        <NavigationContainer theme={DefaultTheme}>
            <Stack.Navigator
                mode={'card'}
                header={() => null}
                screenOptions={{
                    animation: Platform.select({
                        ios: 'default',
                        android: 'slide_from_right'
                    })
                }}
            >
                {
                    router.screens.map((screen, index) => (
                        <Stack.Screen
                            name={screen.name}
                            component={screen.component}
                            options={screen.options}
                            key={index.toString()}
                        />
                    ))
                }
            </Stack.Navigator>
        </NavigationContainer>
    );
};

import React from 'react';
import {DefaultTheme} from '@react-navigation/native';
import {createStackNavigator} from '@react-navigation/stack';
import routers from "./routers";

const Stack = createStackNavigator();

export default function AppContainer() {
    const screens = routers.map((screen, index) => {
        return <Stack.Screen name={screen.name} component={screen.component} options={screen.options} key={screen.name}/>;
    });
    return (
        <Stack.Navigator
            mode={'card'}
            header={() => null}
            screenOptions={{}}
            theme={DefaultTheme}
        >
            {screens}
        </Stack.Navigator>
    );
};

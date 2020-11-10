import React from 'react';
import {createAppContainer} from 'react-navigation';
import {createStackNavigator} from 'react-navigation-stack';
import Signin from "./Signin";
import Signup from "./Signup";

const Stack = createStackNavigator({
    Signin,
    Signup
});

export default createAppContainer(Stack);

import React from 'react';
import {Image} from 'react-native';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import {Colors} from "../styles";
import EcomIndex from '../pages/ecom/EcomIndex';
import Cart from "../pages/ecom/Cart";
import PostIndex from "../pages/post/PostIndex";
import HomeIndex from "../pages/home/HomeIndex";
import NotificationIndex from "../pages/notification/NotificationIndex";

function iconStyle(tintColor) {
    return {
        width: 25,
        height: 25,
        tintColor: tintColor,
    };
}

const Tab = createBottomTabNavigator();

class TabBar extends React.Component {
    render() {
        return (
            <Tab.Navigator
                screenOptions={{
                    tabBarActiveTintColor: Colors.primary,
                    tabBarInactiveTintColor: '#777',
                    tabBarLabelStyle: {
                        height: 14
                    },
                }}
            >
                <Tab.Screen
                    name="EcomIndex"
                    component={EcomIndex}
                    options={{
                        tabBarLabel: '首页',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/home-fill.png') : require('../images/tabbar/home.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}

                />
                <Tab.Screen
                    name="PostIndex"
                    component={PostIndex}
                    options={{
                        tabBarLabel: '发现',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/compass-fill.png') : require('../images/tabbar/compass.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}
                />
                <Tab.Screen
                    name="NotificationIndex"
                    component={NotificationIndex}
                    options={{
                        tabBarLabel: '消息',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/message-fill.png') : require('../images/tabbar/message.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}
                />
                <Tab.Screen
                    name="CartView"
                    component={Cart}
                    options={{
                        tabBarLabel: '购物车',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/cart-fill.png') : require('../images/tabbar/cart.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}
                />
                <Tab.Screen
                    name="HomeIndex"
                    component={HomeIndex}
                    options={{
                        tabBarLabel: '我的',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/mine-fill.png') : require('../images/tabbar/mine.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}
                />
            </Tab.Navigator>
        );
    }
}

// TabBar.navigationOptions = () => ({
//     headerShown: false,
//     header: () => null
// })

export default TabBar;

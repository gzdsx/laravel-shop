import React from 'react';
import {Image} from 'react-native';
import {createStackNavigator} from '@react-navigation/stack';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import HomeIndex from '../pages/home/HomeIndex';
import Category from "../pages/shop/Category";
import UserIndex from '../pages/user/UserIndex';
import {Colors} from "../styles";
import Cart from "../pages/cart/Cart";
import PostIndex from "../pages/post/PostIndex";

function iconStyle(tintColor) {
    return {
        width: 25,
        height: 25,
        tintColor: tintColor,
    };
}

const HomeStack = createStackNavigator();
const HomeScreen = () => (
    <HomeStack.Navigator>
        <HomeStack.Screen name={"Home"} component={HomeIndex} options={HomeIndex.navigationOptions}/>
    </HomeStack.Navigator>
)

const CategoryStack = createStackNavigator();
const CategoryScreen = () => (
    <CategoryStack.Navigator>
        <CategoryStack.Screen name={"Category"} component={Category} options={Category.navigationOptions}/>
    </CategoryStack.Navigator>
)

const PostStack = createStackNavigator();
const PostScreen = () =>(
    <PostStack.Navigator>
        <PostStack.Screen name={"PostIndex"} component={PostIndex} options={PostIndex.navigationOptions}/>
    </PostStack.Navigator>
)

const CartStack = createStackNavigator();
const CartScreen = () => (
    <CartStack.Navigator>
        <CartStack.Screen name={"Cart"} component={Cart} options={Cart.navigationOptions}/>
    </CartStack.Navigator>
)

const UserStack = createStackNavigator();
const UserScreen = () => (
    <UserStack.Navigator>
        <UserStack.Screen name={"User"} component={UserIndex} options={UserIndex.navigationOptions}/>
    </UserStack.Navigator>
)

const Tab = createBottomTabNavigator();

class TabBar extends React.Component {
    render() {
        return (
            <Tab.Navigator
                tabBarOptions={{
                    activeTintColor: Colors.primary,
                    inactiveTintColor: '#777',
                }}
            >
                <Tab.Screen
                    name="Home"
                    component={HomeScreen}
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
                    name="Post"
                    component={PostScreen}
                    options={{
                        tabBarLabel: '发现',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/we-fill.png') : require('../images/tabbar/we.png')}
                                style={iconStyle(color)}
                            />
                        ),
                    }}
                />
                <Tab.Screen
                    name="CartView"
                    component={CartScreen}
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
                    name="我的"
                    component={UserScreen}
                    options={{
                        tabBarLabel: '我的',
                        tabBarIcon: ({focused, color, size}) => (
                            <Image
                                source={focused ? require('../images/tabbar/my-fill.png') : require('../images/tabbar/my.png')}
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
